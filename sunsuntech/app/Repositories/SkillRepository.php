<?php
namespace App\Repositories;

use App\Models\Skill;
use App\Models\UsersSkillsType;
use Illuminate\Database\Eloquent\Collection;

class SkillRepository
{
    /**
     * 既存スキルのみ抽出
     *
     * @return void
     */
    public function getSkillList($userId)
    {
        return Skill::leftJoin('users_skills_types', 'skills.id', '=', 'users_skills_types.skill_id')
            ->where('skills.id', '>=', 1)
            ->where('skills.id', '<=', 13)
            ->orWhere('users_skills_types.user_id', $userId)
            ->select(
                'skills.*',
                'users_skills_types.user_id',
                'users_skills_types.skill_id',
            )
            ->get();
    }

    /**
     * ログインユーザーのスキルを抽出
     *
     * @param int $userId
     * @return void
     */
    public function getUserSkillList($userId)
    {
        return Skill::join('users_skills_types', 'skills.id', '=', 'users_skills_types.skill_id')
            ->where('users_skills_types.user_id', $userId)
            ->get();
    }

    /**
     * 新しいスキルを作成
     *
     * @return void
     */
    public function createSkill($createSkillName, $createSkillFilePath)
    {
        return Skill::create([
            'skill_name' => $createSkillName,
            'skill_file_path' => $createSkillFilePath,
        ]);
    }

    /**
     * スキルの物理削除
     *
     * @return void
     */
    public function deleteUserSkillTypeList($userId)
    {
        return UsersSkillsType::where('user_id', $userId)->delete();
    }

    /**
     * スキルの登録
     *
     * @return void
     */
    public function registerUserSkillTypeList($setUserSkillTypes)
    {
        return UsersSkillsType::insert($setUserSkillTypes);
    }

    /**
     * 新しいスキル情報を登録する
     *
     * @param int $userId
     * @param int $newSkillId
     * @return void
     */
    public function createUserSkillType($userId, $newSkillId)
    {
        return UsersSkillsType::create([
            'user_id' => $userId,
            'skill_id' => $newSkillId,
        ]);
    }
}
