<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * 表示側のプロフィール表示
     *
     * @return void
     */
    public function index()
    {
        $loginUser = Auth::user();
        return view('profiles.index', compact('loginUser'));
    }

    /**
     * 管理側のプロフィール編集画面
     *
     * @param ProfileRequest $request
     * @return void
     */
    public function update(ProfileRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->self_introduction = $request->input('self_introduction');
        $user->email = $request->input('email');
        // パスワードをハッシュ化
        $user->password = bcrypt($request->input('password'));
        $user->profile_path = $request->input('profile_path');
        
        DB::beginTransaction();
        try{
            // ユーザー情報を保存する
            $user->save();

            DB::commit();

            return redirect(route('profile'))->with('success', 'プロフィールが更新されました');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect(route('profile'))->with('success', 'プロフィールが更新されませんでした');
        }
    }
}
