<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->namespace('App\Http\Controllers')->group(function () {
    // Route::middleware(['auth:api', 'verified'])->group(function () {
    //     // Comments
    //     Route::apiResource('comments', 'CommentController')->only('destroy');

    // });
    
    Route::post('/logout', 'AuthController@logout')->name('logout');
    Route::post('/authenticate', 'AuthController@authenticate')->name('authenticate');
    Route::post('/register', 'AuthController@register')->name('register');

    Route::get('/tenants', 'TenantController@index')->name('fetchAllTenants');
    Route::post('/tenant/store', 'TenantController@store')->name('storeTenant');
    Route::post('/tenant/delete', 'TenantController@destroy')->name('deleteTenant');
    Route::post('/tenant/update', 'TenantController@update')->name('updateTenant');
    Route::get('/tenant/{id}', 'TenantController@show')->name('showTenant');

    Route::get('/meter-readings', 'MeterReadingController@index')->name('fetchAllMeterReadings');
    Route::post('/meter-reading/update', 'MeterReadingController@update')->name('updateMeterReading');
    Route::post('/meter-reading/store', 'MeterReadingController@store')->name('storeMeterReading');
    Route::post('/meter-reading/delete', 'MeterReadingController@destroy')->name('deleteMeterReading');
    //Route::get('/meter-reading/{id}', 'MeterReadingController@show')->name('showMeterReading');
});