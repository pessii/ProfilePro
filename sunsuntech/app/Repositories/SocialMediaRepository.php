<?php
namespace App\Repositories;

use App\Models\SocialMedia;
use App\Models\UsersSocialMedia;
use Illuminate\Database\Eloquent\Collection;

class SocialMediaRepository
{
    /**
     * ソーシャルメディアの抽出
     *
     * @param int $userId
     * @return void
     */
    public function getUserSocialMediaList($userId)
    {
        return SocialMedia::join('users_social_medias', 'social_medias.id', '=', 'users_social_medias.social_media_id')
            ->where('users_social_medias.user_id', $userId)    
            ->get();
    }

    /**
     * ソーシャルメディアの物理削除
     *
     * @param int $userId
     * @return void
     */
    public function deleteSocialMediaList($userId)
    {
        return SocialMedia::where('user_id', $userId)->delete();
    }

    /**
     * 新しいソーシャルメディアを作成
     *
     * @param string $createSkillName
     * @param string $createSkillFilePath
     * @param int $userId
     * @return void
     */
    public function createSocialMedia($createSkillName, $createSkillFilePath, $userId, $createSocialMediaFilePath)
    {
        return SocialMedia::create([
            'user_id' => $userId,
            'social_media_name' => $createSkillName,
            'url' => $createSkillFilePath,
            'social_media_file_path' => $createSocialMediaFilePath
        ]);
    }

    /**
     * ソーシャルメディアを登録
     *
     * @param array $setSocialMediaIds
     * @return void
     */
    public function registerSocialMedia($setSocialMediaIds)
    {
        $socialMediaArray = [];

        foreach ($setSocialMediaIds as $socialMediaData) {
            $socialMedia = SocialMedia::create([
                'user_id' => $socialMediaData['user_id'],
                'social_media_name' => $socialMediaData['social_media_name'],
                'url' => $socialMediaData['url'],
                'social_media_file_path' => $socialMediaData['social_media_file_path'],
            ]);

            $socialMediaArray[] = $socialMedia;
        }

        return $socialMediaArray;
    }

    /**
     * 既存のソーシャルメディア取得
     *
     * @param int $socialMediaId
     * @return SocialMedia
     */
    public function getExistingSocialMedia($socialMediaId)
    {
        return SocialMedia::where('id', $socialMediaId)
            ->first();
    }

    /**
     * users_social_mediasテーブルのidからsocial_media_idを取得
     *
     * @param int $socialMediaId
     * @return void
     */
    public function getSocialMediaId($socialMediaId)
    {
        return UsersSocialMedia::where('id', $socialMediaId)
            ->first();
    }

    /**
     * ソーシャルメディアの物理削除
     *
     * @param int $userId
     * @return void
     */
    public function deleteUserSocialMediaList($userId)
    {
        return UsersSocialMedia::where('user_id', $userId)->delete();
    }

    /**
     * ソーシャルメディアの登録
     *
     * @param string $setUserSocialMedia
     * @return void
     */
    public function registerUserSocialMedia($userId, $socialMedia)
    {
        $usersSocialMediaArray = [];
        if ($socialMedia !== null) {
            foreach ($socialMedia as $socialMediaData) {
                $usersSocialMedia = UsersSocialMedia::create([
                    'user_id' => $userId,
                    'social_media_id' => $socialMediaData['id'],
                ]);

                $usersSocialMediaArray[] = $usersSocialMedia;
            }
        }
        
        return $usersSocialMediaArray;
    }

    /**
     * 新しいソーシャルメディアの登録
     *
     * @param string[] $request
     * @param int $loginUserId
     * @return void
     */
    public function createUserSocialMedia($userId, $newSocialMediaId)
    {
        return UsersSocialMedia::create([
            'user_id' => $userId,
            'social_media_id' => $newSocialMediaId,
        ]);
    }
}