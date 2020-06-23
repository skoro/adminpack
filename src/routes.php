<?php

use Illuminate\Support\Facades\Route;

// Route::get('/admin/login', 'Skoro\AdminPack\Http\Controllers\LoginController@showLoginForm');
Route::namespace('Skoro\AdminPack\Http\Controllers')->group(function () {

    Route::get('/admin/login', 'LoginController@showLoginForm')->middleware('web');
    Route::post('/admin/login', 'LoginController@login')->name('admin.login')->middleware('web');

});