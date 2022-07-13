<?php

use App\Http\Controllers;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyCRUDController;
use App\Http\Middleware\CheckAdminLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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

Route::get('login', [AdminLoginController::class, 'getLogin'])->name('getLogin');
Route::post('login', [AdminLoginController::class, 'postLogin']);
Route::post('logout',[AdminLoginController::class, 'getLogout'])->name('logout');


Route::resource('companies', CompanyCRUDController::class)->middleware(CheckAdminLogin::class);


Route::prefix('greeting')->as('greeting.')->group(function () {

    // work for: /greeting/vn
    Route::get('vn', function () {
        return "Xin chào!";
    })->name('vn');

    // work for: /greeting/en
    Route::get('en', function () {
        return "Hello!";
    })->name('en');

    // work for: /greeting/cn
    Route::get('cn', function () {
        return "你好!";
    })->name('cn');

    // work for: /greeting/
    Route::get('/', function () {
        return "Hello!";
    });
});



// Route::get('admincp/login', ['as' => 'getLogin', 'uses' => 'AdminLoginController@getLogin']);
// Route::post('admincp/login', ['as' => 'postLogin', 'uses' => 'AdminLoginController@postLogin']);
// Route::get('admincp/logout', ['as' => 'getLogout', 'uses' => 'AdminLoginController@getLogout']);

// Route::group(['middleware' => 'login', 'prefix' => 'admincp'], function() {
// Route::get('login', function() {
// 		return view('login');
// 	});
// });