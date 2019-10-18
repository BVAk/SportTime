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
Route::get('/registerclient', function () {
    return view('auth/registerclient');
});
Route::post('/loginclient','LoginClientController@loginclient')->name('loginclient');

Route::get('/fitness', function () {
    return view('fitnessabout');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('/admin')->group(function () {
    Route::get('/login', 'Auth\LoginAdminController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginAdminController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@dashboard')->name('admin');
    Route::get('/clients', 'AdminController@showClients')->name('admin.clients');
    Route::get('/trainers', 'AdminController@showTrainers')->name('admin.trainers');
    Route::get('/trainers/add', 'AdminController@addTrainers')->name('admin.trainers.add');
    Route::post('/inserttrainer', 'AdminController@inserttrainer')->name('admin.inserttrainer.submit');
    Route::get('/clients/add', 'AdminController@addClients')->name('admin.clients.add');
    Route::post('/insertclient', 'AdminController@insertclient')->name('admin.insertclient.submit');
    Route::get('/schedule/group', 'AdminController@schedulegroup')->name('admin.schedulegroup');
    Route::post('/schedule/group', 'AdminController@schedulegroupupdate')->name('admin.schedulegroupupdate');
    Route::get('/schedule/private', 'AdminController@scheduleprivate')->name('admin.scheduleprivate');
});