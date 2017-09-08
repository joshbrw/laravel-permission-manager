<?php

namespace Joshbrw\LaravelPermissions\Facades;

use Illuminate\Support\Facades\Facade;
use Joshbrw\LaravelPermissions\Contracts\PermissionManager;

class Permissions extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public static function getFacadeAccessor()
    {
        return PermissionManager::class;
    }
}
