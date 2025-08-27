<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;


Route::get('/',[ContactController::class, 'index']);             //問い合わせフォーム入力ページ
Route::post('/confirm',[ContactController::class, 'confirm']);   //問い合わせフォーム確認ページ
Route::get('/back', [ContactController::class, 'back']);        //修正ボタンでフォームに戻る
Route::post('/contacts', [ContactController::class, 'store']);  //DB保存用
Route::get('/thanks',[ContactController::class, 'thanks']);    //サンクスページ


//Fortify（ユーザー認証）認証できていないとログインページへ
Route::middleware('auth')->group(function () {
    Route::get('/admin',[AdminController::class,'admin']);                  //管理画面
    Route::get('/admin/search',[AdminController::class,'search']);          //検索
    Route::delete('/contacts/delete',[AdminController::class,'destroy']);   //データの削除
});

