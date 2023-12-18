<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\AdminController;

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
Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

// 管理側のスキル編集画面
Route::get('/skill', [App\Http\Controllers\SkillController::class, 'index'])->name('skill');

