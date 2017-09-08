<?php

namespace Joshbrw\LaravelPermissions\Managers;

use InvalidArgumentException;
use Joshbrw\LaravelPermissions\Contracts\PermissionManager;
use Joshbrw\LaravelPermissions\Permission;
use Joshbrw\LaravelPermissions\PermissionGroup;

class SingletonPermissionManager implements PermissionManager
{
    /**
     * @var array
     */
    protected $permissionsByGroup = [];

    /**
     * Register an array of permissions
     * @param string $group The permissions group, i.e 'User'
     * @param array|Permission[] $permissions Array of Permission objects
     * @return PermissionManager
     * @throws InvalidArgumentException
     */
    public function register(string $group, array $permissions): PermissionManager
    {
        $this->ensurePermissionInstances($permissions);

        if (!array_key_exists($group, $this->permissionsByGroup)) {
            $this->permissionsByGroup[$group] = [];
        }

        $permissions = array_merge($this->permissionsByGroup[$group], $permissions);

        usort($permissions, function (Permission $a, Permission $b) {
            return $a->getName() <=> $b->getName();
        });

        $this->permissionsByGroup[$group] = $permissions;

        ksort($this->permissionsByGroup);

        return $this;
    }

    /**
     * Get all Permissions that have been registered, grouped by Permissions Group
     * @return PermissionGroup[]
     */
    public function all(): array
    {
        $return = [];

        foreach ($this->permissionsByGroup as $group => $permissions) {
            $return[] = new PermissionGroup($group, $permissions);
        }

        return $return;
    }

    /**
     * Ensure an array of $permissions are Permission instances
     * @param array $permissions
     * @throws \InvalidArgumentException
     */
    private function ensurePermissionInstances(array $permissions): void
    {
        foreach ($permissions as $permission) {
            if (!$permission instanceof Permission) {
                throw new InvalidArgumentException('Please pass an array of Permission instances.');
            }
        }
    }
}
