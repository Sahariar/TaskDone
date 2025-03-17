<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
         // Register middleware
         $router = $this->app['router'];

         $router->aliasMiddleware('role', RoleMiddleware::class);
         $router->aliasMiddleware('permission', PermissionMiddleware::class);
         $router->aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);
    }
}
