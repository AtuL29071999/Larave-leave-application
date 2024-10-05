<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\LogoutMiddleware;
use App\Http\Middleware\Admin\LoginMiddleware as adminLoginMiddleware;
use App\Http\Middleware\Admin\LogoutMiddleware as adminLogoutMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'isLoginMiddleware' => LoginMiddleware::class,
            'isLogoutMiddleware' => LogoutMiddleware::class,
            'isAdminLogoutMiddleware' => adminLogoutMiddleware::class,
            'isAdminLoginMiddleware' => adminLoginMiddleware::class
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
