<?php

namespace Joshbrw\LaravelPermissions\Tests\Managers;

use Joshbrw\LaravelPermissions\Managers\SingletonPermissionManager;
use Joshbrw\LaravelPermissions\Permission;
use Joshbrw\LaravelPermissions\PermissionGroup;
use PHPUnit\Framework\TestCase;
use stdClass;

class SingletonPermissionManagerTest extends TestCase
{

    /** @test */
    public function can_register_permissions_and_retrieve_permission_groups()
    {
        $manager = new SingletonPermissionManager;

        $manager->register('Users', [
            new Permission('user.create', 'Create User', 'Create a User'),
            new Permission('user.list', 'List Users', 'List Users'),
        ]);

        $manager->register('Jobs', [
            new Permission('job.create', 'Create Job', 'Create a Job'),
            new Permission('job.list', 'List Jobs', 'List Jobs'),
        ]);

        $all = $manager->all();

        $this->assertCount(2, $all);

        /** @var PermissionGroup $jobs */
        $jobs = $all[0];

        $this->assertSame('Jobs', $jobs->getName());
        $this->assertCount(2, $jobs->getPermissions());

        $this->assertSame('job.create', $jobs->getPermissions()[0]->getKey());
        $this->assertSame('Create Job', $jobs->getPermissions()[0]->getName());
        $this->assertSame('Create a Job', $jobs->getPermissions()[0]->getDescription());

        $this->assertSame('job.list', $jobs->getPermissions()[1]->getKey());
        $this->assertSame('List Jobs', $jobs->getPermissions()[1]->getName());
        $this->assertSame('List Jobs', $jobs->getPermissions()[1]->getDescription());

        /** @var PermissionGroup $jobs */
        $users = $all[1];

        $this->assertSame('Users', $users->getName());
        $this->assertCount(2, $users->getPermissions());

        $this->assertSame('user.create', $users->getPermissions()[0]->getKey());
        $this->assertSame('Create User', $users->getPermissions()[0]->getName());
        $this->assertSame('Create a User', $users->getPermissions()[0]->getDescription());

        $this->assertSame('user.list', $users->getPermissions()[1]->getKey());
        $this->assertSame('List Users', $users->getPermissions()[1]->getName());
        $this->assertSame('List Users', $users->getPermissions()[1]->getDescription());
    }

    /** @test */
    public function throws_invalid_argument_exception_when_not_supplying_permission_array()
    {
        $this->expectException(\InvalidArgumentException::class);

        $manager = new SingletonPermissionManager;

        $manager->register('Fail', [
            new Permission('user.create', 'Create User', 'Create a User'),
            'This isnt a permission instance',
        ]);
    }

}
