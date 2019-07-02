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

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/siswa', 'SiswaController@index')->name('siswa.index');
    Route::get('/siswa/create', 'SiswaController@create')->name('siswa.create');
    Route::post('/siswa/store', 'SiswaController@store')->name('siswa.store');
    Route::get('/siswa/delete/{id}', 'SiswaController@delete')->name('siswa.delete');
    Route::get('/siswa/edit/{id}', 'SiswaController@edit')->name('siswa.edit');
    Route::post('/siswa/update/{id}', 'SiswaController@update')->name('siswa.update');
    
    Route::resource('guru', 'GuruController');
});

Route::resource('buku', 'BukuController');

<<<<<<< HEAD
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
=======
Route::get('/buku/search', 'BukuController@search')->name('search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Items
Route::get('manage-item-ajax', 'ItemAjaxController@manageItemAjax');
Route::resource('item-ajax', 'ItemAjaxController');
>>>>>>> 2b936cdf5c7dd97d5a17f77142fd9bf4fc8d5ee9
