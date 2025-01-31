<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


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


Auth::routes(['verify' => true]);

//会員登録の表示
Route::get('/register',  [RegisterController::class, 'showRegistrationForm']);

//会員登録のデータ送信
Route::post('/register',  [RegisterController::class, 'register']);

// ログイン画面の表示
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// ログイン処理
Route::post('/login', [LoginController::class, 'login']);

//認証あり
Route::middleware('auth')->group(function () {
    //プロフィール編集画面
    Route::get('/mypage/profile', [ItemController::class, 'getProfile']);

    //プロフィールデータ送信
    Route::post('/profile/upload', [ItemController::class, 'upload']);

    //商品一覧画面
    Route::get('/?tab=mylist', [ItemController::class, 'index']);

    //商品詳細画面のいいね機能
    Route::post('/item/{item_id}/like', [ItemController::class, 'like']);

    //商品詳細画面のコメント機能
    Route::post('/item/{item_id}/comment', [ItemController::class, 'comment']);

    //商品出品画面
    Route::get('/sell', [CategoryController::class, 'getSell']);

    //商品データ送信
    Route::post('/item/create', [ItemController::class, 'create']);

    //商品購入画面
    Route::get('/purchase/{item_id}', [ItemController::class, 'purchase']);

    //住所変更画面
    Route::get('/purchase/address/{item_id}', [ItemController::class, 'address']);

    //変更住所送信
    Route::post('/address/upload/{item_id}', [ItemController::class, 'uploadTemporaryAddress']);

    //商品購入データ送信
    Route::post('/item/purchase', [ItemController::class, 'uploadPurchase']);

    //プロフィール画面表示
    Route::get('/mypage', [ItemController::class, 'mypage']);
});

//認証なし
//商品一覧画面
Route::get('/', [ItemController::class, 'index']);

//商品詳細画面
Route::get('/item/{item_id}', [ItemController::class, 'show']);

//検索機能
Route::get('/search', [ItemController::class, 'search']);







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
