<?php
namespace App\Repositories;

use App\Models\Portfolio;
use App\Models\SkillsPortfolio;
use Illuminate\Database\Eloquent\Collection;

class PortfolioRepository
{
    /**
     * ユーザーのポートフォリオ一覧取得
     *
     * @param int $userId
     * @return Portfolio
     */
    public function getUserPortfolioList($userId)
    {
        return Portfolio::where('user_id', $userId)->get();
    }

    /**
     * 新しいポートフォリオを登録
     *
     * @param string[] $request
     * @return Portfolio
     */
    public function createPortfolio($request, $userId, $site_file_path)
    {
        return Portfolio::create([
            'user_id' => $userId,
            'site_file_path' => $site_file_path,
            'serbice_name' => $request->serbice_name,
            'site_url' => $request->site_url,
            'project_overview' => $request->project_overview,
            'coding' => $request->coding,
            'design' => $request->design,
            'responsibilities' => $request->responsibilities,
            'explanation' => $request->explanation,
        ]);
    }

    /**
     * ポートフォリオIDから情報を取得
     *
     * @param int $portfolioId
     * @return Portfolio
     */
    public function getIdPortfolio($portfolioId)
    {
        return Portfolio::where('id', $portfolioId)->first();
    }

    /**
     * ポートフォリオの更新
     *
     * @param string[] $portfolioData
     * @return void
     */
    public function updatePortfolio($request, $loginUserId, $id, $site_file_path)
    {
        return Portfolio::where('user_id', $loginUserId)
            ->where('id', $id)
            ->update([
                'user_id' => $loginUserId,
                'serbice_name' => $request->serbice_name,
                'site_url' => $request->site_url,
                'site_file_path' => $site_file_path,
                'explanation' => $request->explanation,
                'project_overview' => $request->project_overview,
                'coding' => $request->coding,
                'design' => $request->design,
                'responsibilities' => $request->responsibilities,
            ]);
    }

    /**
     * 最後のレコードを取得
     *
     * @return SkillsPortfolio
     */
    public function getSkillsPortfoliosLastId()
    {
        return Portfolio::latest()->first();
    }

    /**
     * ポートフォリオにスキルの登録
     *
     * @return void
     */
    public function registerSkillsPortfoliosList($setSkillPortfolios)
    {
        return SkillsPortfolio::insert($setSkillPortfolios);
    }

    /**
     * ポートフォリオのスキルを更新
     *
     * @param array $setSkillPortfolios
     * @return void
     */
    public function updateSkillsPortfoliosList($setSkillPortfolios)
    {
        foreach ($setSkillPortfolios as $portfolioData) {
            $skillsPortfolio = new SkillsPortfolio();
            $skillsPortfolio->skill_id = $portfolioData['skill_id'];
            $skillsPortfolio->portfolio_id = $portfolioData['portfolio_id'];
            $skillsPortfolio->save();
        }
    }

    /**
     * チェック中のポートフォリオを取得
     *
     * @param int $portfolioId
     * @return SkillsPortfolio
     */
    public function getSkillPortfolio($portfolioId)
    {
        return SkillsPortfolio::where('portfolio_id', $portfolioId)->get();
    }
}