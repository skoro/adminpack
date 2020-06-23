<?php

use Illuminate\Support\Facades\Route;

Route::get('login', 'LoginController@showLoginForm');
Route::post('login', 'LoginController@login')->name('admin.login');
