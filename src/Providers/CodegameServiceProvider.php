<?php

namespace Ashiful\Service\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Ashiful\Service\Middleware\canInstall;
use Ashiful\Service\Middleware\canUpdate;
use Ashiful\Service\Middleware\IsInstalled;

class CodegameServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->publishFiles();
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'courier');
        require_once __DIR__ . '/../Helpers/functions.php';
        $this->mergeConfigFrom(
            __DIR__ . '/../config/service.php',
            'service'
        );
    }


    public function boot(Router $router)
    {
        $router->middlewareGroup('install', [CanInstall::class]);
        $router->middlewareGroup('update', [CanUpdate::class]);
        $router->pushMiddlewareToGroup('web', IsInstalled::class);

        $this->loadViewsFrom(__DIR__ . '/../views', 'service');
        $this->loadTranslationsFrom(__DIR__ . '/../Lang', 'service');
    }


    protected function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../assets' => public_path('service'),
        ], 'service');
    }
}
