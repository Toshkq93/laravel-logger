<?php

namespace Toshkq93\Logger\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Toshkq93\Logger\Contracts\Services\iLoggerDriverService;
use Toshkq93\Logger\Enums\DriverNamesLoggerEnum;
use Toshkq93\Logger\Exeptions\NotFoundDriverExeption;
use Toshkq93\Logger\Gates\LoggerGate;
use Toshkq93\Logger\Http\Middleware\Logger;
use Toshkq93\Logger\Http\Middleware\Login;
use Toshkq93\Logger\Services\FileService;

class LoggerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindGates();
        Paginator::useBootstrapFive();

        $this->registerRoute();

        $this->loadViewsFrom(
            __DIR__ . '/../resources/views', 'logs'
        );

        $this->mergeConfigFrom(
            __DIR__ . '/../config/logger.php', 'logger'
        );

        $this->bindDI();
        $this->bindMiddleware();

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/logs'),
            __DIR__ . '/../config/logger.php' => config_path('logger.php'),
            __DIR__ . '/../Enums/LoggerNameEnum.php' => app_path('/Enums/LoggerName.php'),
            __DIR__ . '/../Gates/LoggerGate.php' => app_path('/Gates')
        ]);
    }

    /**
     * @return void
     */
    private function bindDI(): void
    {
        switch (config('logger.driver')) {
            case DriverNamesLoggerEnum::FILE:
                $instance = FileService::class;
                break;
            default:
                throw new NotFoundDriverExeption();
        }

        $this->app->singleton(iLoggerDriverService::class, $instance);
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function bindMiddleware(): void
    {
        $router = $this->app->get('router');
        $router->aliasMiddleware('logger', Logger::class);
        $router->aliasMiddleware('loginLogger', Login::class);
    }

    /**
     * @return void
     */
    private function registerRoute(): void
    {
        Route::group([
            'prefix' => config('logger.prefix'),
            'middleware' => config('logger.middleware'),
        ], function () {
            $this->loadRoutesFrom(
                __DIR__ . '/../routes/web.php'
            );
        });
    }

    /**
     * @return void
     */
    private function bindGates(): void
    {
        Gate::define('view', [LoggerGate::class, 'check']);
    }
}
