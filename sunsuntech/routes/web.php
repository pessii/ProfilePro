<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SocialMediaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 表示側のトップページ画面
Route::get('/', [ProductionController::class, 'index'])->name('productions.index');

Auth::routes();

// 管理側のトップページ画面
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

// 管理側のプロフィール編集画面
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
// プロフィールの更新
Route::put('/profile/store', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');

// 管理側のスキル編集画面
Route::get('/skill', [App\Http\Controllers\SkillController::class, 'index'])->name('skill');
// スキルの更新
Route::post('/skill/store', [App\Http\Controllers\SkillController::class, 'store'])->name('skill.store');

// 管理側のポートフォリオ管理画面
Route::get('/portfolio/admin', [App\Http\Controllers\PortfolioController::class, 'index'])->name('portfolio.admin');
// 管理側のポートフォリオ作成画面
Route::get('/portfolio/create', [App\Http\Controllers\PortfolioController::class, 'create'])->name('portfolio.create');
// 管理側のポートフォリオの作成
Route::put('/portfolio/store', [App\Http\Controllers\PortfolioController::class, 'store'])->name('portfolio.store');
// 管理側のポートフォリオ編集画面
Route::get('/portfolio/edit/{id}', [App\Http\Controllers\PortfolioController::class, 'edit'])->name('portfolio.edit');
// 管理者側のポートフォリオの更新
Route::put('/portfolio/update/{id}', [App\Http\Controllers\PortfolioController::class, 'update'])->name('portfolio.update');

// 管理者側のソーシャルメディア編集画面
Route::get('/socialmedia/admin', [App\Http\Controllers\SocialMediaController::class, 'index'])->name('socialmedia.admin');
// 管理者側のソーシャルメディアの更新
Route::post('/socialmedia/update', [App\Http\Controllers\SocialMediaController::class, 'update'])->name('socialmedia.update');