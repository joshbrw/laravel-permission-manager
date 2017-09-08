# Laravel Permission Manager

This package provides a simple way of registering permissions, organising them by group and then retrieving all permissions. These permissions can then be assigned to User/Role entities and used for Access Control logic.

## Installation
1. Install the package using `composer require joshbrw/laravel-permission-manager`
2. **If you're using Laravel 5.5** this is all that is required, the package will automatically load its' own Providers and Facades. If you're using Laravel 5.4, read on.
2. Then register the Service Provider in `config/app.php` to ensure that the container bindings etc are loaded:
    ```
    'providers' => [
        ...
        Joshbrw\LaravelPermissions\LaravelPermissionManagerServiceProvider::class,
    ]
    ``` 
3. You can then optionally register the `Permissions` facade if you'd rather use `Permission::registerPermissions()` rather than using the `PermissionManager` directly:
    ```
    'aliases' => [
        ...
        'Permissions' => Joshbrw\LaravelPermissions\Facades\Permissions::class,
    ]
    ``` 
4. You are now installed!


## Registering Permissions
Permissions should usually be registered in the `boot()` method ophpuf a Service Provider - this ensures that this package has been able to register itself using it's own `register()` method first.

### Using the Facade
The simplest way of registering permissions is using the `Permissions` facade. The following example registers the `user.list` and `user.create` permissions within the `User` group:

```php
use Permissions;
use Joshbrw\LaravelPermissions\Permission;

class MyProvider extends ServiceProvider {
    public function boot()
    {
        Permissions::register('User', [
            new Permission('user.list', 'List Users', 'This allows a User to list other Users.'),
            new Permission('user.create', 'Create Users', 'This allows a User to create another User.'),
        ]);
    }
}
```

### Using the Trait
You can also use the `RegistersPermissions` trait if you're not a fan of Facades, for example:
```php
use Joshbrw\LaravelPermissions\Traits\RegistersPermissions;
use Joshbrw\LaravelPermissions\Permission;

class MyProvider extends ServiceProvider {
    use RegistersPermissions;
    
    public function boot()
    {
        $this->registerPermissions('User', [
            new Permission('user.list', 'List Users', 'This allows a User to list other Users.'),
            new Permission('user.create', 'Create Users', 'This allows a User to create another User.'),
        ]);
    }
}
```

