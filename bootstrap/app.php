<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders()
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api/v1',
        then: function () {
            Route::prefix('api/v2')->group(function() {
                require __DIR__.'/../routes/api_v2.php';
            });
        },
    )
    ->withMiddleware(function(Middleware $middleware): void {
        $middleware->prependToGroup('api', \App\Http\Middleware\AlwaysAcceptJson::class);
        $middleware->statefulApi();

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function(NotFoundHttpException $e, Request $request){
            if($request->wantsJson()){
            return response()->json(['message' => 'object not found'],'404');
            }
        });
    })->create();
