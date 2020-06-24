<?php

use Illuminate\Support\Facades\Route;

Route::get('login', 'LoginController@showLoginForm');
Route::post('login', 'LoginController@login')->name('admin.login');
Route::post('logout', 'LoginController@logout')->name('admin.logout');

Route::get('/', 'HomeController@index')->name('admin.home');

Route::view('users', 'admin::users.index')->name('admin.users');
Route::view('user/profile', 'admin::users.profile')->name('admin.user.profile');
Route::get('users/data', 'UserController@data')->name('admin.users.data');
Route::view('user/create', 'admin::users.create')->name('admin.user.create');
Route::post('user/create', 'UserController@store')->name('admin.user.store');
Route::get('user/{user}', 'UserController@edit')->name('admin.user.edit');
Route::put('user/{user}', 'UserController@update')->name('admin.user.update');
Route::delete('user/{user}', 'UserController@destroy')->name('admin.user.delete');

Route::view('roles', 'admin::roles.index')->name('admin.roles');