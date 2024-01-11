<?php  

namespace App\Http\Requests;  

use Illuminate\Foundation\Http\FormRequest;  
use Illuminate\Support\Facades\Auth;

class PortfolioRequest extends FormRequest  
{
    public function rules()
    {
        $user = Auth::user();
        return [
            'site_file_path' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'serbice_name' => 'required|max:191',
            'site_url' => 'required|url',
            'project_overview' => 'required|min:8',
            'coding' => 'nullable|url',
            'design' => 'nullable|url',
            'responsibilities' => 'nullable',
            'explanation' => 'nullable',
        ];
    }

    public function attributes()  
    {
        return [
            'site_file_path' => "サービス画像",
            'serbice_name' => "サービス名",
            'site_url' => "サービスURL",
            'project_overview' => "プロジェクト概要",
            'coding' => "コーディング",
            'design' => "デザイン",
            'responsibilities' => "担当内容",
            'explanation' => "その他",
        ];  
    }  
}