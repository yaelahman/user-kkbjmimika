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


Route::get('/', 'LandingPageController@index')->name('landing');
Route::post('/registrasiUser', 'LandingPageController@registrasiUser')->name('landing.registrasiUser');
Route::post('/aktivasiUser', 'LandingPageController@aktivasiUser')->name('landing.aktivasiUser');
Route::post('/cariUser', 'LandingPageController@cariUser')->name('landing.cariUser');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user', 'UserController@index')->name('admin.user.index');
Route::get('/user/{id}', 'UserController@edit')->name('admin.user.edit');
Route::get('/create', 'UserController@create')->name('admin.user.create');
Route::post('/user/aktivasi', 'UserController@aktivasiUser')->name('admin.user.aktivasi');
Route::post('/user/delete', 'UserController@deleteUser')->name('admin.user.delete');
Route::post('/user/save', 'UserController@store')->name('admin.user.store');
Route::post('/user/update/{id}', 'UserController@update')->name('admin.user.update');
