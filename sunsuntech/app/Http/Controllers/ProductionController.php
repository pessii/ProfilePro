<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepository;
use App\Repositories\SocialMediaRepository;
use App\Repositories\SkillRepository;
use App\Repositories\PortfolioRepository;

class ProductionController extends Controller
{
    private $user_repository;
    private $social_media_repository;
    private $skill_repository;
    private $portfolio_repository;

    public function __construct(
        UserRepository $user_repository,
        SocialMediaRepository $social_media_repository,
        SkillRepository $skill_repository,
        PortfolioRepository $portfolio_repository
    )
    {
        $this->user_repository = $user_repository;
        $this->social_media_repository = $social_media_repository;
        $this->skill_repository = $skill_repository;
        $this->portfolio_repository = $portfolio_repository;
    }

    /**
     * 表示側のトップページを表示
     *
     * @return void
     */
    public function index($id)
    {
        $user = $this->user_repository->getUser($id);
        
        // 登録されてるソーシャルメディアを取得
        $userSocialMediaList = $this->social_media_repository->getUserSocialMediaList($id);

        // スキルを取得
        $SkillList = $this->skill_repository->getUserSkillList($id);

        // ユーザーのポートフォリオ一覧取得
        $portfolioList = $this->portfolio_repository->getUserPortfolioList($id);

        return view('productions.index',
        compact(
            'user',
            'userSocialMediaList',
            'SkillList',
            'portfolioList',
            'id'
        ));
    }

    public function indexportfolio($id)
    {
        $user = $this->user_repository->getUser($id);
        
        // 登録されてるソーシャルメディアを取得
        $userSocialMediaList = $this->social_media_repository->getUserSocialMediaList($id);

        // スキルを取得
        $SkillList = $this->skill_repository->getUserSkillList($id);

        // ユーザーのポートフォリオ一覧取得
        $portfolioList = $this->portfolio_repository->getUserPortfolioList($id);

        return view('productions.indexportfolio',
        compact(
            'user',
            'userSocialMediaList',
            'SkillList',
            'portfolioList',
            'id'
        ));
    }
}
