<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\PortfolioRepository;

class PortfolioController extends Controller
{
    private $portfolio_repository;

    public function __construct(
        PortfolioRepository $portfolio_repository
    )
    {
        $this->portfolio_repository = $portfolio_repository;
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
        return view('portfolios.create');
    }

    /**
     * ポートフォリオ登録処理
     */
    public function store(Request $request)
    {
        $loginUser = Auth::user();

        DB::beginTransaction();
        try{
            // ポートフォリオモデルの作成と保存
            $this->portfolio_repository->createPortfolio($request, $loginUser->id);

            DB::commit();
            return redirect()->route('portfolio.admin')->with('success', 'ポートフォリオを作成しました');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
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

        return view('portfolios.edit', compact('portfolioData'));
    }

    /**
     * ポートフォリオ編集画面から更新処理
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, int $id)
    {
        $loginUser = Auth::user();

        DB::beginTransaction();
        try{
            // ポートフォリオの更新
            $this->portfolio_repository->updatePortfolio($request, $loginUser->id, $id);

            DB::commit();
            return redirect()->route('portfolio.edit', ['id' => $id])->with('success', 'ポートフォリオを更新しました');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->route('portfolio.edit', ['id' => $id])->with('error', 'ポートフォリオを更新できませんでした');
        }
    }
}
