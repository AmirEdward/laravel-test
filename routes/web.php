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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('login','AdminController@login')->name('login')->middleware('guest');
    Route::middleware('admin')->group(function() {
        Route::get('/', 'AdminController@index')->name('dashboard');
        Route::delete('user/{user}/delete', 'AdminController@delete_user')->name('user.delete');
        Route::get('user/{user}/edit', 'AdminController@edit_user')->name('user.edit');
        Route::put('user/{user}', 'AdminController@update_user')->name('user.update');
    });
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('billing', 'PlanController@index')->name('billing');
});


Route::get('/home', 'HomeController@index')->name('home')->middleware('subscribe');
Route::get('auth/{social}', 'SocialLoginController@redirectToProvider')->name('social_login');
Route::get('auth/{social}/callback', 'SocialLoginController@handleProviderCallback');
Route::get('payment/{plan}', 'PlanController@payment')->name('payment');
Route::post('subscribe', 'PlanController@subscribe')->name('subscribe');