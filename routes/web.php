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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('translation/{id}', 'Api\TranslationController@show')->name('translation.show')->middleware('checkPassword');
Route::get('translation/{id}/check_password', 'Api\TranslationController@checkPasswordView')->name('translation.checkPasswordView');
Route::post('translation/check_password', 'Api\TranslationController@checkPassword')->name('translation.checkPassword');