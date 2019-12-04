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
Route::post('/loginclient', 'LoginClientController@loginclient')->name('loginclient');

Route::get('/fitness', 'FitnessController@fitnessabout');
Route::get('/fitness/trainers', 'FitnessController@trainer');
Route::get('/price', 'FitnessController@price');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/fitness/trainers/privatetrainer', 'FitnessController@insertprivate');



Route::prefix('/admin')->group(function () {
    Route::get('/login', 'Auth\LoginAdminController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginAdminController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@welcome')->name('admin');
    Route::get('addweek', 'AdminController@handle');

    Route::post('/addvisit', 'AdminController@addvisit')->name('admin.addvisit.submit');
    Route::get('/clients', 'AdminController@showClients')->name('admin.clients');
    Route::get('/clients/add', 'AdminController@addClients');
    Route::post('/insertclient', 'AdminController@insertclient')->name('admin.insertclient.submit');
    Route::post('/inserteditclient/{id}', 'AdminController@inserteditclient')->name('admin.inserteditclient.submit');
    Route::get('/clients/{id}', 'AdminController@profileClients')->name('admin.clientprofile');
    Route::get('/clients/editprofile/{id}', 'AdminController@editprofile')->name('admin.clientedit');
    Route::get('/clients/private/{id}','AdminController@checkprivateclient');

    Route::get('/trainers', 'AdminController@showTrainers')->name('admin.trainers');
    Route::get('/trainers/add', 'AdminController@addTrainers')->name('admin.trainers.add');
    Route::post('/inserttrainer', 'AdminController@inserttrainer')->name('admin.inserttrainer.submit');
    Route::get('/trainers/editprofile/{id}', 'AdminController@editprofiletrainers')->name('admin.traineredit');
    Route::post('/insertedittrainer/{id}', 'AdminController@insertedittrainer')->name('admin.insertedittrainer.submit');
    Route::get('/trainers/{id}', 'AdminController@profileTrainers')->name('admin.trainerprofile');

    Route::get('/schedule/group', 'AdminController@schedulegroup')->name('admin.schedulegroup');
    Route::get('/schedule/child', 'AdminController@schedulechild');
    Route::post('/schedule/group', 'AdminController@schedulegroupupdate')->name('admin.schedulegroupupdate');
    Route::get('/schedule/private', 'AdminController@scheduleprivate')->name('admin.scheduleprivate');
    Route::post('/userabonnement', 'AdminController@userabonnement');
    Route::get('/statistic', 'ChartController@dashboard');
    Route::post('/privatechange/{id}', 'AdminController@privatechange')->name('admin.privatechange');
});
