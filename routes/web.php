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
    return view('site');
    // $homeController = new \App\Http\Controllers\HomeController();
    // return $homeController->content('/');
});

Auth::routes();

Route::prefix('dashboard')->middleware('auth.admin')->group(function(){
    Route::get('/', 'HomeController@index')->name('dashboard');

    Route::prefix('users')->group(function(){
        Route::get('/', 'Admin\UserController@index')->name('dashboard.user.index');
        Route::post('/', 'Admin\UserController@store')->name('dashboard.user.store');
        Route::get('/create', 'Admin\UserController@create')->name('dashboard.user.create');
        Route::get('/{id}', 'Admin\UserController@show')->name('dashboard.user.show');
        Route::put('/{id}', 'Admin\UserController@update')->name('dashboard.user.update');
        Route::delete('/{id}', 'Admin\UserController@destroy')->name('dashboard.user.destroy');
    });

    Route::prefix('contenttypes')->group(function(){
        Route::get('/', 'Admin\ContentTypeController@index')->name('dashboard.contenttype.index');
        Route::post('/', 'Admin\ContentTypeController@store')->name('dashboard.contenttype.store');
        Route::get('/create', 'Admin\ContentTypeController@create')->name('dashboard.contenttype.create');
        Route::get('/{id}', 'Admin\ContentTypeController@show')->name('dashboard.contenttype.show');
        Route::put('/{id}', 'Admin\ContentTypeController@update')->name('dashboard.contenttype.update');
        Route::delete('/{id}', 'Admin\ContentTypeController@destroy')->name('dashboard.contenttype.destroy');
    });

    Route::prefix('contents')->group(function(){
        Route::get('/', 'Admin\ContentController@index')->name('dashboard.content.index');
        Route::post('/', 'Admin\ContentController@store')->name('dashboard.content.store');
        Route::get('/create', 'Admin\ContentController@select')->name('dashboard.content.select');
        Route::post('/create', 'Admin\ContentController@selectAction')->name('dashboard.content.selectAction');
        Route::get('/create/{id}', 'Admin\ContentController@create')->name('dashboard.content.create');
        Route::get('/{id}', 'Admin\ContentController@show')->name('dashboard.content.show');
        Route::put('/{id}', 'Admin\ContentController@update')->name('dashboard.content.update');
        Route::delete('/{id}', 'Admin\ContentController@destroy')->name('dashboard.content.destroy');
    });
    
    Route::prefix('assets')->group(function(){
        Route::get('/', 'Admin\AssetsController@index')->name('assets');
        Route::post('/new-folder', 'Admin\AssetsController@newFolder')->name('assets.newFolder');
        Route::delete('/folder/{folder}', 'Admin\AssetsController@deleteFolder')->name('assets.deleteFolder');
        Route::post('/new-file', 'Admin\AssetsController@newFile')->name('assets.newFile');
        Route::delete('/file', 'Admin\AssetsController@deleteFile')->name('assets.deleteFile');
    });
});

Route::get('{slug}', 'HomeController@content')->name('content')->where('slug', '.*');;