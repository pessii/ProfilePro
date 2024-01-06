<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\PortfolioRepository;
use App\Repositories\SkillRepository;

use App\Http\Requests\PortfolioRequest;

class PortfolioController extends Controller
{
    private $portfolio_repository;

    public function __construct(
        PortfolioRepository $portfolio_repository,
        SkillRepository $skill_repository
    )
    {
        $this->portfolio_repository = $portfolio_repository;
        $this->skill_repository = $skill_repository;
    }

    /**
     * ポートフォリオ管理画面
     *
     * @return void
     */
    public function index()
    {
        $loginUser = Auth::user();

        // ユーザーのポートフォリオ一覧取得
        $portfolioList = $this->portfolio_repository->getUserPortfolioList($loginUser->id);

        return view('portfolios.index', compact('portfolioList'));
    }

    /**
     * ポートフォリオ作成画面
     *
     * @return void
     */
    public function create()
    {
        $loginUser = Auth::user();

        // ログインユーザーのスキルを取得
        $userSkillList = $this->skill_repository->getUserSkillList($loginUser->id);

        return view('portfolios.create', compact('userSkillList'));
    }

    /**
     * ポートフォリオ登録処理
     */
    public function store(PortfolioRequest $request)
    {
        $loginUser = Auth::user();

        // 最後のレコードを取得
        $lastSkillsPortfolio = $this->portfolio_repository->getSkillsPortfoliosLastId();
        // 最後のレコードにプラス１
        $lastSkillsPortfolioId = $lastSkillsPortfolio->id + 1;
        // 選択されたスキルのIDを配列に取得
        $selectedSkillId = $request->input('selected_skills');
        $setSkillPortfolios = [];
        if($selectedSkillId !== null){
            foreach ($selectedSkillId as $skillId) {
                $setSkillPortfolios[] = [
                    'skill_id' => $skillId,
                    'portfolio_id' => $lastSkillsPortfolioId,
                ];
            }
        }

        // 画像ファイルの処理
        $site_file_path = request()->file('site_file_path');
        if ($site_file_path !== null) {
            // アップロードされたファイルのオリジナルのファイル名を取り出し
            $site_file_path = request()->file('site_file_path')->getClientOriginalName();
            // ディレクトリに保存
            request()->file('site_file_path')->storeAs('public/portfolios', $site_file_path);
        }

        DB::beginTransaction();
        try{
            // ポートフォリオにスキルを登録
            $this->portfolio_repository->registerSkillsPortfoliosList($setSkillPortfolios);
            
            // ポートフォリオモデルの作成と保存
            $this->portfolio_repository->createPortfolio($request, $loginUser->id, $site_file_path);

            DB::commit();
            return redirect()->route('portfolio.admin')->with('success', 'ポートフォリオを作成しました');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('portfolio.create')->with('success', 'ポートフォリオを作成できませんでした');
        }
    }

    /**
     * ポートフォリオ編集画面
     *
     * @param int $portfolioId
     * @return void
     */
    public function edit($portfolioId)
    {
        // ポートフォリオIDから情報を取得
        $portfolioData = $this->portfolio_repository->getIdPortfolio($portfolioId);

        $loginUser = Auth::user();

        // ログインユーザーのスキルを取得
        $userSkillList = $this->skill_repository->getUserSkillList($loginUser->id);

        // チェック中のスキルを取得
        $checkSkillList = $this->portfolio_repository->getSkillPortfolio($portfolioId);
        
        return view('portfolios.edit', 
        compact(
            'portfolioData',
            'userSkillList',
            'checkSkillList'
        ));
    }

    /**
     * ポートフォリオ編集画面から更新処理
     *
     * @param PortfolioRequest $request
     * @param int $id
     * @return void
     */
    public function update(PortfolioRequest $request, int $id)
    {
        $loginUser = Auth::user();

        // 選択されたスキルのIDを配列に取得
        $selectedSkillId = $request->selected_skills;
        $setSkillPortfolios = [];
        if($selectedSkillId !== null){
            foreach ($selectedSkillId as $skillId) {
                $setSkillPortfolios[] = [
                    'skill_id' => $skillId,
                    'portfolio_id' => $id,
                ];
            }
        }

        // 画像ファイルの処理
        $site_file_path = $request->file('site_file_path');
        if ($site_file_path !== null) {
            // アップロードされたファイルのオリジナルのファイル名を取り出し
            $site_file_path = request()->file('site_file_path')->getClientOriginalName();
            // ディレクトリに保存
            request()->file('site_file_path')->storeAs('public/portfolios', $site_file_path);
        } else {
            // ポートフォリオIDから既存の画像情報を取得
            $portfolioData = $this->portfolio_repository->getIdPortfolio($id);
            $site_file_path = $portfolioData->site_file_path;
        }

        DB::beginTransaction();
        try{
            // ポートフォリオの更新
            $this->portfolio_repository->updatePortfolio($request, $loginUser->id, $id, $site_file_path);
            // ポートフォリオのスキルを更新
            $this->portfolio_repository->updateSkillsPortfoliosList($setSkillPortfolios);

            DB::commit();
            return redirect()->route('portfolio.edit', ['id' => $id])->with('success', 'ポートフォリオを更新しました');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->route('portfolio.edit', ['id' => $id])->with('error', 'ポートフォリオを更新できませんでした');
        }
    }
}
