<?php

namespace Joshbrw\LaravelPermissions;

class PermissionGroup
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    private $permissions;

    /**
     * @param string $name The Permission Group name
     * @param Permission[] $permissions The permissions
     */
    public function __construct(string $name, array $permissions)
    {
        $this->name = $name;
        $this->permissions = $permissions;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the array of Permissions
     * @return Permission[]
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }
}
