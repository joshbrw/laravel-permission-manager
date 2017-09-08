<?php

namespace Joshbrw\LaravelPermissions\Traits;

use Joshbrw\LaravelPermissions\Contracts\PermissionManager;
use Joshbrw\LaravelPermissions\Permission;

trait RegistersPermissions
{

    /**
     * Register a Permission
     * @param string $group The Group name, i.e. 'User'
     * @param string $key The key, i.e. 'auth.user.create'
     * @param string $name The name, i.e. 'Create User'
     * @param string $description The description, i.e. 'Create a User'
     * @return bool
     */
    public function registerPermission(string $group, string $key, string $name, string $description): bool
    {
        $permission = new Permission($key, $name, $description);

        app(PermissionManager::class)->register($group, [$permission]);

        return true;
    }

    /**
     * Register an array of Permissions
     * @param string $group
     * @param Permission[] $permissions
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function registerPermissions(string $group, array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if (!$permission instanceof Permission) {
                throw new \InvalidArgumentException('You may only pass Permission instances to RegisterPermissions@registerPermissions');
            }
        }

        app(PermissionManager::class)->register($group, $permissions);

        return true;
    }
}
