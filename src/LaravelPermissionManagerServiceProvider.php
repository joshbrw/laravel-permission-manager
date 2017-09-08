<?php

namespace Joshbrw\LaravelPermissions;

use Illuminate\Support\ServiceProvider;
use Joshbrw\LaravelPermissions\Contracts\PermissionManager;
use Joshbrw\LaravelPermissions\Managers\SingletonPermissionManager;

class LaravelPermissionManagerServiceProvider extends ServiceProvider
{

    /**
     * Register the Services
     */
    public function register()
    {
        $this->app->singleton(PermissionManager::class, SingletonPermissionManager::class);
    }
}
