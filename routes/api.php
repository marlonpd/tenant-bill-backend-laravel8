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

    Route::group([
        'middleware' => 'api',
    ], function ($router) {
    
        Route::post('/register', 'AuthController@register')->name('register');
        Route::get('/tenants', 'TenantController@index')->name('fetchAllTenants');
        Route::get('/tenants/{pageIndex}/get', 'TenantController@getLimitedList')->name('getLimitedList');
        Route::post('/tenant/store', 'TenantController@store')->name('storeTenant');
        Route::post('/tenant/delete', 'TenantController@destroy')->name('deleteTenant');
        Route::post('/tenant/update', 'TenantController@update')->name('updateTenant');
        Route::get('/tenant/{id}', 'TenantController@show')->name('showTenant');
    
        Route::get('/meter-readings/{tenantId}', 'MeterReadingController@index')->name('fetchAllMeterReadings');
        Route::post('/meter-reading/update', 'MeterReadingController@update')->name('updateMeterReading');
        Route::post('/meter-reading/store', 'MeterReadingController@store')->name('storeMeterReading');
        Route::post('/meter-reading/delete', 'MeterReadingController@destroy')->name('deleteMeterReading');
        Route::get('/meter-readings/$tenantId/{pageIndex}/get', 'MeterReadingController@getLimitedList')->name('getLimitedList');
        //Route::get('/meter-reading/{id}', 'MeterReadingController@show')->name('showMeterReading');
    
        Route::get('/power-rates', 'PowerRateController@index')->name('fetchAllPowerRates');
        Route::post('/power-rate/store', 'PowerRateController@store')->name('storePowerRate');
        Route::post('/power-rate/delete', 'PowerRateController@destroy')->name('deletePowerRate');
        Route::post('/power-rate/update', 'PowerRateController@update')->name('updatePowerRate');
        Route::get('/power-rate/{id}', 'PowerRateController@show')->name('showPowerRate');
        Route::get('/power-rates/{pageIndex}/get', 'PowerRateController@getLimitedList')->name('getLimitedList');
    });
});