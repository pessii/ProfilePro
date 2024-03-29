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

        // 既存スキルと登録したスキルを取得
        $skillList = $this->skill_repository->getSkillList($loginUser->id);

        // ログインユーザーのスキルを取得
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
    public function store(Request $request)
    {
        $user = Auth::user();
        // 選択されたスキルのIDを配列に取得
        $selectedSkillId = $request->input('selected_skills');

        $setUserSkillTypes = [];
        if($selectedSkillId !== null){
            foreach ($selectedSkillId as $skillId) {
                $setUserSkillTypes[] = [
                    'user_id' => $user->id,
                    'skill_id' => $skillId,
                ];
            }
        }

        // 新しいスキルを配列で取得
        $createSkillName = $request->input('skill');

        // 画像ファイルの処理
        $createSkillFilePath = request()->file('skill_file_path');
        if ($createSkillFilePath !== null) {
            // アップロードされたファイルのオリジナルのファイル名を取り出し
            $createSkillFilePath = request()->file('skill_file_path')->getClientOriginalName();
            // ディレクトリに保存
            request()->file('skill_file_path')->storeAs('public/skills', $createSkillFilePath);
        }

        DB::beginTransaction();
        try{
            // 物理削除する処理
            $this->skill_repository->deleteUserSkillTypeList($user->id);

            // スキル情報を登録する
            $this->skill_repository->registerUserSkillTypeList($setUserSkillTypes);

            if($createSkillName !== null && $createSkillFilePath !== null){
                // 新しいスキルを登録して変数に格納
                $newSkill = $this->skill_repository->createSkill($createSkillName, $createSkillFilePath);
                // 新しいスキル情報を登録する
                $this->skill_repository->createUserSkillType($user->id, $newSkill->id);
            }

            DB::commit();
            session()->flash('flashSuccess', 'スキルが更新されました');
            return redirect(route('skill'));
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flashError', 'スキルが更新されませんでした');
            return redirect(route('skill'));
        }
    }
}
