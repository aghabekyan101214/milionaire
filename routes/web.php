<?php

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

/**
 * Parent authentication
 */

Route::get('/', function(){
    return redirect("/player/login");
});
/**
 * Admin Login part
 */
Route::get('/admin/login', 'Auth\LoginController@showAdminLoginForm')->name("admin_login_get");
Route::post('/admin/login', 'Auth\LoginController@adminLogin')->name('admin_login');
Route::post('/admin/logout', 'Auth\LoginController@adminLogout')->middleware('auth:admin');

/**
 * Player Login part
 */
Route::get('/player/login', 'Auth\LoginController@showPlayerLoginForm')->name('player_login_get');
Route::post('/player/login', 'Auth\LoginController@playerLogin')->name('player_login');
Route::post('/player/logout', 'Auth\LoginController@playerLogout')->middleware('auth:player');
Route::get('/player/register', 'Auth\RegisterController@showPlayerRegisterForm');
Route::post('/player/register', 'Auth\RegisterController@createPlayer')->name("register_player");

/**
 * All admin route
 */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'DashboardController@index')->name("admin");
    Route::resource('/questions', 'QuestionController');
    Route::resource('/answers', 'AnswerController');
});

/**
 * all players route
 */
Route::group(['prefix' => 'player', 'namespace' => 'Player', 'middleware' => 'auth:player'], function () {
    Route::get("/", "PlayerController@index");
});

Route::group(['prefix' => 'game', 'namespace' => 'Game', 'middleware' => 'auth:player'], function () {
    Route::get("/", "GameController@index");
    Route::post("/answers", "GameController@manageAnswers");
});
