<?php

namespace Joshbrw\LaravelPermissions\Contracts;

use InvalidArgumentException;
use Joshbrw\LaravelPermissions\Permission;
use Joshbrw\LaravelPermissions\PermissionGroup;

interface PermissionManager
{
    /**
     * Register an array of permissions
     * @param string $group The permissions group, i.e 'User'.
     * @param array|Permission[] $permissions Array of Permission objects
     * @return PermissionManager
     * @throws InvalidArgumentException
     */
    public function register(string $group, array $permissions): PermissionManager;

    /**
     * Get all Permissions that have been registered, grouped by Permissions Group
     * @return PermissionGroup[]
     */
    public function all(): array;

}
