<?php

use Illuminate\Support\Facades\Route;

// laravel defaults
Route::redirect('/', 'home');
Auth::routes([
    'register' => false,
    'reset' => false,
    'confirm' => false,
]);
Route::get('home', 'HomeController@index')->name('home');

// settings
Route::get('settings', 'SettingsController@edit')->name('settings');
Route::put('settings', 'SettingsController@modify')->name('settings.modify');
