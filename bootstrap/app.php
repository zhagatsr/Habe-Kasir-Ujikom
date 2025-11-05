<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    // Routing: file web & console kamu
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        // Endpoint health-check bawaan Laravel 11
        health: '/up',
    )

    // Registrasi middleware (Laravel 11 tidak memakai app/Http/Kernel.php)
    ->withMiddleware(function (Middleware $middleware) {
        // Alias middleware kustom kamu
        $middleware->alias([
            'auth.kasir' => \App\Http\Middleware\AuthKasir::class,
        ]);

        // (Opsional) contoh menambah ke group web/api:
        // $middleware->appendToGroup('web', [
        //     \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        // ]);
        // $middleware->appendToGroup('api', [
        //     // middleware API tambahan
        // ]);
    })

    // Penanganan exception (biarkan default kecuali perlu kustom)
    ->withExceptions(function (Exceptions $exceptions) {
        // Contoh kustomisasi (opsional):
        // $exceptions->renderable(function (\Throwable $e, $request) {
        //     return null;
        // });
    })

    ->create();
