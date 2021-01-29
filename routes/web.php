<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
//定义展示页面路由
Route::get('index','ArticleController@index');
Route::get('create','ArticleController@create');
//图片异步上传的路由
Route::post('upfile','ArticleController@upfile');
//保存入库路由
Route::post('save','ArticleController@save');
//定义删除的路由
Route::delete('del','ArticleController@del');
