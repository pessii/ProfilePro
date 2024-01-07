<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\SocialMediaRepository;
use App\Http\Requests\SocialMediaRequest;

class SocialMediaController extends Controller
{
    private $social_media_repository;

    public function __construct(
        SocialMediaRepository $social_media_repository
    )
    {
        $this->social_media_repository = $social_media_repository;
    }

    /**
     * ソーシャルメディア編集画面
     *
     * @return void
     */
    public function index()
    {
        $loginUser = Auth::user();

        // 登録されてるソーシャルメディアを取得
        $userSocialMediaList = $this->social_media_repository->getUserSocialMediaList($loginUser->id);

        return view('socialmedias.index', compact('userSocialMediaList'));
    }

    /**
     * ソーシャルメディア編集画面から更新処理
     *
     * @param SocialMediaRequest $request
     * @param int $id
     * @return void
     */
    public function update(SocialMediaRequest $request)
    {
        $user = Auth::user();
        // 選択されたソーシャルメディアのIDを配列に取得
        $selectedSocialMediaId = $request->input('selected_social_medias');

        // 新しいソーシャルメディアを配列で取得
        $createSocialMediaName = $request->input('social_media_name');
        // 新しいソーシャルメディアURLを配列で取得
        $createSkillUrl = $request->input('url');

        $setUserSocialMedia = [];
        $setSocialMediaIds = [];
        if ($selectedSocialMediaId !== null) {
            foreach ($selectedSocialMediaId as $socialMediaId) {
                $socialMediaId = intval($socialMediaId);
                // users_social_mediasテーブルのidからsocial_media_idを取得
                $usersSocialMediaId = $this->social_media_repository->getSocialMediaId($socialMediaId);
                $setUserSocialMedia[] = [
                    'user_id' => $user->id,
                    'social_media_id' => $usersSocialMediaId->social_media_id,
                ];
                // 既存のソーシャルメディア取得
                $existingSocialMedia = $this->social_media_repository->getExistingSocialMedia($usersSocialMediaId->social_media_id);
                $setSocialMediaIds[] = [
                    'user_id' => $user->id,
                    'social_media_name' => $existingSocialMedia->social_media_name,
                    'url' => $existingSocialMedia->url,
                    'social_media_file_path' => $existingSocialMedia->social_media_file_path,
                ];
            }
        }
        
        $socialMedia = null;

        // 画像ファイルの処理
        $createSocialMediaFilePath = request()->file('social_media_file_path');
        if ($createSocialMediaFilePath !== null) {
            // アップロードされたファイルのオリジナルのファイル名を取り出し
            $createSocialMediaFilePath = request()->file('social_media_file_path')->getClientOriginalName();
            // ディレクトリに保存
            request()->file('social_media_file_path')->storeAs('public/socialmedias', $createSocialMediaFilePath);
        }

        DB::beginTransaction();
        try{
            // 登録中のソーシャルメディアにチェックがあれば実行
            if($setSocialMediaIds){
                // ソーシャルメディア物理削除する処理
                $this->social_media_repository->deleteSocialMediaList($user->id);
                // ソーシャルメディアを登録
                $socialMedia = $this->social_media_repository->registerSocialMedia($setSocialMediaIds);
            }

            // ソーシャルメディア物理削除する処理
            $this->social_media_repository->deleteUserSocialMediaList($user->id);
            // ソーシャルメディア情報を登録する
            $this->social_media_repository->registerUserSocialMedia($user->id, $socialMedia);
            
            // ソーシャルメディア名とURLが入力されてたら実行
            if($createSocialMediaName !== NULL && $createSkillUrl !== NULL){
                // 新しいソーシャルメディアを登録して変数に格納
                $newSocialMedia = $this->social_media_repository->createSocialMedia($createSocialMediaName, $createSkillUrl, $user->id, $createSocialMediaFilePath);
                // 新しいソーシャルメディア情報を登録する
                $this->social_media_repository->createUserSocialMedia($user->id, $newSocialMedia->id);
            }

            DB::commit();
            return redirect(route('socialmedia.admin'))->with('success', 'ソーシャルメディアが更新されました');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect(route('socialmedia.admin'))->with('success', 'ソーシャルメディアが更新されませんでした');
        }
    }
}
