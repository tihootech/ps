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

// points & stars
Route::resource('point', 'PointController');
Route::resource('star', 'StarController')->except(['create', 'store']);

// quick actions
Route::post('quick/add', 'QuickActionsController@quick_add')->name('quick.add');
Route::post('quick/plus', 'QuickActionsController@quick_plus')->name('quick.plus');
Route::post('quick/master', 'QuickActionsController@quick_master')->name('quick.master');
Route::post('quick/kid', 'QuickActionsController@quick_kid')->name('quick.kid');
