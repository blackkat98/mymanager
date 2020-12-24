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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'Home\HomeController@index')->name('home');

Route::group(['prefix' => 'me'], function () {
    Route::get('/', 'Home\MeController@index')->name('me');
    Route::post('/update_info', 'Home\MeController@updateInfo')->name('me-update-info');
    Route::post('/update_password', 'Home\MeController@updatePassword')->name('me-update-password');
    Route::post('/update_avatar', 'Home\MeController@updateAvatar')->name('me-update-avatar');
    Route::post('/update_lang', 'Home\MeController@updateLang')->name('me-update-lang');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'Home\UserController@index')->name('users');
    Route::get('/create', 'Home\UserController@create')->name('users-create');
    Route::post('/store', 'Home\UserController@store')->name('users-store');
    Route::post('/update/{id}', 'Home\UserController@update')->name('users-update');
    Route::post('/delete/{id}', 'Home\UserController@delete')->name('users-delete');
    Route::post('/restore/{id}', 'Home\UserController@restore')->name('users-restore');
});

Route::group(['prefix' => 'roles'], function () {
    Route::get('/', 'Home\RoleController@index')->name('roles');
    Route::get('/create', 'Home\RoleController@create')->name('roles-create');
    Route::post('/store', 'Home\RoleController@store')->name('roles-store');
    Route::get('/edit/{id}', 'Home\RoleController@edit')->name('roles-edit');
    Route::post('/update/{id}', 'Home\RoleController@update')->name('roles-update');
    Route::post('/delete/{id}', 'Home\RoleController@delete')->name('roles-delete');
});

Route::group(['prefix' => 'permissions'], function () {
    Route::get('/', 'Home\PermissionController@index')->name('permissions');
    Route::get('/create', 'Home\PermissionController@create')->name('permissions-create');
    Route::post('/store', 'Home\PermissionController@store')->name('permissions-store');
    Route::get('/edit/{id}', 'Home\PermissionController@edit')->name('permissions-edit');
    Route::post('/update/{id}', 'Home\PermissionController@update')->name('permissions-update');
    Route::post('/delete/{id}', 'Home\PermissionController@delete')->name('permissions-delete');
});

Route::group(['prefix' => 'notes'], function () {
    Route::get('/', 'Home\NoteController@index')->name('notes');
    Route::post('/store', 'Home\NoteController@store')->name('notes-store');
    Route::get('/show/{id}', 'Home\NoteController@show')->name('notes-show');
    Route::post('/delete/{id}', 'Home\NoteController@delete')->name('notes-delete');
});
