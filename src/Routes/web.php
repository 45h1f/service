<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'install',
    'as' => 'service::',
    'namespace' => 'Ashiful\\Service\Controllers',
    'middleware' => ['web', 'install']
], function () {

    Route::get('/', 'ServiceController@index')->name('welcome');
    // Route::get('/environment', 'ServiceController@environment')->name('environment');
    Route::get('/requirements', 'ServiceController@requirements')->name('requirements');
    Route::get('/permissions', 'ServiceController@permissions')->name('permissions');
    Route::get('/license', 'ServiceController@license')->name('license');
    Route::post('/license', 'ServiceController@licenseSave');
    Route::get('/database', 'ServiceController@database')->name('database');
    Route::post('/database', 'ServiceController@databaseSave');
    Route::get('/user', 'ServiceController@user')->name('user');
    Route::post('/user', 'ServiceController@userSave');
    Route::get('/final', 'ServiceController@final')->name('final');
});
