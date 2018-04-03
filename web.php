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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::group(['middleware'=>'auth'],function(){

	Route::get('myMails','MailController@index')->name('myMails');

	Route::post('getMailData','MailController@getData')->name('getMailData');

	Route::get('404','MailController@pageNotFound')->name('404');

	Route::get('compose','MailController@composeMail')->name('compose');

	Route::post('sendMail','MailController@create')->name('sendMail');

	Route::get('sentMails','MailController@sentMails')->name('sentMails');

	Route::post('sentMailData','MailController@sentData')->name('sentMailData');

	Route::get('default','HomeController@defaultPage')->name('default');
});



