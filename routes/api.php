<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MeterReadingController;
use App\Http\Controllers\PowerRateController;
use App\Http\Controllers\TenantController;


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
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::group([
        'middleware' => 'auth:api',
    ], function ($router) {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/refresh/token', [AuthController::class, 'refresh'])->name('refresh');
       
        Route::get('/tenants', [TenantController::class, 'index'])->name('fetchAllTenants');
        Route::get('/tenants/{pageIndex}/get', [TenantController::class, 'getLimitedList'])->name('getLimitedList');
        Route::post('/tenant/store', [TenantController::class, 'store'])->name('storeTenant');
        Route::delete('/tenant/delete', [TenantController::class, 'destroy'])->name('deleteTenant');
        Route::put('/tenant/update', [TenantController::class, 'update'])->name('updateTenant');
        Route::get('/tenant/{id}', [TenantController::class, 'show'])->name('showTenant');
    
        Route::get('/meter-readings/{tenantId}', [MeterReadingController::class, 'index'])->name('fetchAllMeterReadings');
        Route::put('/meter-reading/update', [MeterReadingController::class, 'update'])->name('updateMeterReading');
        Route::post('/meter-reading/store',[MeterReadingController::class, 'store'])->name('storeMeterReading');
        Route::delete('/meter-reading/delete', [MeterReadingController::class, 'destroy'])->name('deleteMeterReading');
        Route::get('/meter-readings/$tenantId/{pageIndex}/get', [MeterReadingController::class, 'getLimitedList'])->name('getLimitedList');
    
        Route::get('/power-rates', [PowerRateController::class, 'index'])->name('fetchAllPowerRates');
        Route::post('/power-rate/store', [PowerRateController::class, 'store'])->name('storePowerRate');
        Route::delete('/power-rate/delete', [PowerRateController::class, 'destroy'])->name('deletePowerRate');
        Route::put('/power-rate/update', [PowerRateController::class, 'update'])->name('updatePowerRate');
        Route::get('/power-rate/{id}', [PowerRateController::class, 'show'])->name('showPowerRate');
        Route::get('/power-rates/{pageIndex}/get', [PowerRateController::class, 'getLimitedList'])->name('getLimitedList');
    });
});