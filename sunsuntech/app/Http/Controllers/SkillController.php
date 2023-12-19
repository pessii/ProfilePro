<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\SkillRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\SkillRepository;

class SkillController extends Controller
{
    private $skill_repository;

    public function __construct(
        SkillRepository $skill_repository
    )
    {
        $this->skill_repository = $skill_repository;
    }

    /**
     * 表示側のスキル表示
     *
     * @return void
     */
    public function index()
    {
        $loginUser = Auth::user();

        // 既存スキルと登録したスキルを抽出
        $skillList = $this->skill_repository->getSkillList($loginUser->id);

        // ログインユーザーのスキルを抽出
        $userSkillList = $this->skill_repository->getUserSkillList($loginUser->id);

        return view('skills.index', 
        compact(
            'skillList',
            'userSkillList',
        ));
    }

    /**
     * 管理側のスキル編集画面
     *
     * @param SkillRequest $request
     * @return void
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        // 選択されたスキルのIDを配列に取得
        $selectedSkillId = $request->input('selected_skills');

        $setUserSkillTypes = [];
        foreach ($selectedSkillId as $skillId) {
            $setUserSkillTypes[] = [
                'user_id' => $user->id,
                'skill_id' => $skillId,
            ];
        }

        // 新しいスキルを配列で取得
        $createSkillName = $request->input('skill');
        // 新しいスキル画像を配列で取得
        $createSkillFilePath = $request->input('skill_file_path');

        DB::beginTransaction();
        try{
            // 物理削除する処理
            $this->skill_repository->deleteUserSkillTypeList($user->id);

            // スキル情報を登録する
            $this->skill_repository->registerUserSkillTypeList($setUserSkillTypes);

            // 新しいスキルを登録して変数に格納
            $newSkill = $this->skill_repository->createSkill($createSkillName, $createSkillFilePath);

            // 新しいスキル情報を登録する
            $this->skill_repository->createUserSkillType($user->id, $newSkill->id);

            DB::commit();
            return redirect(route('skill'))->with('success', 'スキルが更新されました');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect(route('skill'))->with('success', 'スキルが更新されませんでした');
        }
    }
}
