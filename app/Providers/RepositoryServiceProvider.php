<?php

namespace App\Providers;

use App\Repositories\EloquentRepositoryInterface; 
use App\Repositories\TenantRepositoryInterface; 
use App\Repositories\Eloquent\TenantRepository; 
use App\Repositories\Eloquent\BaseRepository; 
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepositoryInterface; 
use App\Repositories\Eloquent\UserRepository; 

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