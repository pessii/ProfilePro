<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * 表示側のプロフィール編集画面
     *
     * @return void
     */
    public function index()
    {
        $loginUser = Auth::user();
        return view('profiles.index', compact('loginUser'));
    }

    /**
     * 管理側のプロフィール更新処理
     *
     * @param ProfileRequest $request
     * @return void
     */
    public function store(ProfileRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->self_introduction = $request->input('self_introduction');
        $user->email = $request->input('email');
        $user->profile_path = $request->input('profile_path');

        // パスワードの処理
        if ($request->password !== null) {
            // バリデーション
            $validatedData = $request->validate([
                'password' => 'required|min:8',
            ]);
            // パスワードをハッシュ化
            $user->password = bcrypt($validatedData['password']);
        } else {
            $user->password = $user->password;
        }
        
        // 画像ファイルの処理
        $avatar = request()->file('avatar');
        if ($avatar !== null) {
            // アップロードされたファイルのオリジナルのファイル名を取り出し
            $avatar = request()->file('avatar')->getClientOriginalName();
            // ディレクトリに保存
            request()->file('avatar')->storeAs('public/images', $avatar);
        } else {
            // 既に登録されてたら既存の画像を登録
            $user->avatar = $user->avatar;
        }
        
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
