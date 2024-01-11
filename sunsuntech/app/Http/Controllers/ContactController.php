<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\ContactFormMail;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index');
    }

    public function submit(ContactRequest $request)
    {
        $loginUser = Auth::user();

        $contact = new Contact();
        $contact->user_id = $loginUser->id;
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->content = $request->input('content');
        $contact->type = $request->input('category');

        DB::beginTransaction();
        try{
            $contact->save();

            // メールを送信
            Mail::to('cnoeko@gmail.com')->send(new ContactFormMail($contact));

            DB::commit();
            session()->flash('flashSuccess', 'お問い合わせありがとうございます');
            return redirect()->route('contact.index');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flashError', 'お問い合わせに失敗しました');
            return redirect()->route('contact.index');
        }
    }
}
