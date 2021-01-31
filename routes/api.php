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
    Route::get('/tenant/{id}', 'TenantController@show')->name('showTenant');
});