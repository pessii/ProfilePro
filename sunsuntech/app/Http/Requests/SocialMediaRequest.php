<?php  

namespace App\Http\Requests;  

use Illuminate\Foundation\Http\FormRequest;  
use Illuminate\Support\Facades\Auth;

class SocialMediaRequest extends FormRequest  
{
    public function rules()
    {
        $user = Auth::user();
        return [
            'social_media_name' => 'nullable|string|max:255',
            'url' => 'nullable|url',
            'social_media_file_path' => 'nullable|string',
        ];
    }

    public function attributes()  
    {  
        return [  
            'social_media_name' => "ソーシャルメディア名",
            'url' => "url",
            'social_media_file_path' => "ソーシャルメディア画像",
        ];  
    }  
}