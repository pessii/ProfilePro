<?php  

namespace App\Http\Requests;  

use Illuminate\Foundation\Http\FormRequest;  
use Illuminate\Support\Facades\Auth;

class ContactRequest extends FormRequest  
{
    public function rules()
    {
        return [
            'name' => 'required|string', // 名前は必須で文字列であること
            'email' => 'required|email', // メールアドレスは必須で正しいメール形式であること
            'category' => 'required',
            'content' => 'required|string', // 内容は必須で文字列であること
        ];
    }

    public function attributes()  
    {
        return [
            'name' => "ユーザー名",
            'email' => "メールアドレス",
            'category' => "カテゴリ",
            'content' => "内容",
        ];  
    }  
}