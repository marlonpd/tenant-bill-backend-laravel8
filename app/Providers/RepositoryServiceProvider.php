<?php

namespace App\Providers;

use App\Repositories\EloquentRepositoryInterface; 
use App\Repositories\UserRepositoryInterface; 
use App\Repositories\Eloquent\UserRepository; 
use App\Repositories\TenantRepositoryInterface; 
use App\Repositories\Eloquent\TenantRepository; 
use App\Repositories\Eloquent\BaseRepository; 
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TenantRepositoryInterface::class, TenantRepository::class);
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