<?php  

namespace App\Http\Requests;  

use Illuminate\Foundation\Http\FormRequest;  
use Illuminate\Support\Facades\Auth;

class SkillRequest extends FormRequest  
{
    public function rules()
    {
        $user = Auth::user();
        return [
            'name' => 'required|string|max:255',
            'self_introduction' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|string|min:8',
            'profile_path' => 'nullable|string',
        ];
    }

    public function attributes()  
    {  
        return [  
            "name" => "名前",  
            "self_introduction" => "自己紹介", 
            'email' => "メールアドレス",
            'password' => "パスワード",
            'profile_path' => "プロフィール画像",
        ];  
    }  
}