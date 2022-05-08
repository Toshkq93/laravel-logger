<?php

namespace Toshkq93\Logger\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Toshkq93\Logger\Contracts\Services\iLoggerDriverService;
use Toshkq93\Logger\Enums\DriverNamesLoggerEnum;
use Toshkq93\Logger\Exeptions\NotFoundDriverExeption;
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
        Paginator::useBootstrapFive();

        $this->bindDI();
        $this->bindMiddleware();

        $this->loadRoutesFrom(
            __DIR__ . '/../routes/web.php'
        );

        $this->loadViewsFrom(
            __DIR__ . '/../resources/views', 'logs'
        );

        $this->publishes([
            __DIR__ . '/../resource/views' => resource_path('views/vendor/logs'),
            __DIR__ . '/../config/logger.php' => config_path('logger.php')
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
}