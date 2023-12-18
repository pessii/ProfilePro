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

        // 既存スキルのみ抽出
        $skillList = $this->skill_repository->getSkillList($loginUser->id);

        return view('skills.index', compact('skillList'));
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

        DB::beginTransaction();
        try{
            //物理削除する処理
            $this->skill_repository->deleteUserSkillTypeList($user->id);

            // スキル情報を登録する
            $this->skill_repository->registerUserSkillTypeList($setUserSkillTypes);

            DB::commit();
            return redirect(route('skill'))->with('success', 'スキルが更新されました');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect(route('skill'))->with('success', 'スキルが更新されませんでした');
        }
    }
}
