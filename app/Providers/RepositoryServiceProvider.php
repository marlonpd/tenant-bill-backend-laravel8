<?php

namespace App\Providers;

use App\Repositories\EloquentRepositoryInterface; 
use App\Repositories\TenantRepositoryInterface; 
use App\Repositories\Eloquent\TenantRepository; 
use App\Repositories\Eloquent\BaseRepository; 
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepositoryInterface; 
use App\Repositories\Eloquent\UserRepository; 
use App\Repositories\MeterReadingRepositoryInterface; 
use App\Repositories\Eloquent\MeterReadingRepository; 

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(TenantRepositoryInterface::class, TenantRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(MeterReadingRepositoryInterface::class, MeterReadingRepository::class);   
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}