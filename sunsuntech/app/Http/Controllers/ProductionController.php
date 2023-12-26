<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepository;

class ProductionController extends Controller
{
    private $user_repository;

    public function __construct(
        UserRepository $user_repository
    )
    {
        $this->user_repository = $user_repository;
    }

    /**
     * 表示側のトップページを表示
     *
     * @return void
     */
    public function index($id)
    {
        $user = $this->user_repository->getUser($id);
        

        return view('productions.index');
    }
}
