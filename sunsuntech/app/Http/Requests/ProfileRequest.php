<?php  

namespace App\Http\Requests;  

use Illuminate\Foundation\Http\FormRequest;  
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest  
{
    public function rules()
    {
        $user = Auth::user();
        return [
            'name' => 'required|string|max:255',
            'self_introduction' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6'
        ];
    }

    public function attributes()  
    {
        return [  
            "name" => "名前",  
            "self_introduction" => "自己紹介", 
            'email' => "メールアドレス",
            'password' => "パスワード"
        ];  
    }  
}