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
//------------------------ Users -----------------------------
Route::get('/users/add','UsersController@add')->name('addUser');
Route::post('/users/store','UsersController@store');
Route::get('/users/all','UsersController@all')->name('allUsers');
Route::post('/users/delete','UsersController@delete');
Route::get('/users/edit/{item}','UsersController@edit');
Route::post('/users/update/{item}','UsersController@update');

//------------------------ Companies -----------------------------
Route::get('/companies/add','CompaniesController@add')->name('addCompany');
Route::post('/companies/store','CompaniesController@store');
Route::get('/companies/all','CompaniesController@all')->name('allCompanies');
Route::post('/companies/delete','CompaniesController@delete');
Route::get('/companies/edit/{item}','CompaniesController@edit');
Route::post('/companies/update/{item}','CompaniesController@update');