<?php
namespace App\Repositories;

use App\Models\Portfolio;
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
    public function createPortfolio($request, $userId)
    {
        return Portfolio::create([
            'user_id' => $userId,
            'site_file_path' => $request->site_file_path,
            'serbice_name' => $request->serbice_name,
            'site_url' => $request->site_url,
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
    public function updatePortfolio($request, $loginUserId, $id)
    {
        return Portfolio::where('user_id', $loginUserId)
            ->where('id', $id)
            ->update([
                'user_id' => $loginUserId,
                'serbice_name' => $request->input('serbice_name'),
                'site_url' => $request->input('site_url'),
                'site_file_path' => $request->input('site_file_path'),
                'explanation' => $request->input('explanation'),
            ]);
    }
}