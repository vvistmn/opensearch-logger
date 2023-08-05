<?php

namespace Istmn\OpenSearchLogger\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Log\ParsesLogConfiguration;
use Istmn\OpenSearchLogger\OpenSearchLogger;
use Monolog\Handler\PsrHandler;

class OpenSearchLoggerServiceProvider extends ServiceProvider
{
    use ParsesLogConfiguration;

    public function register()
    {
        $this->app->singleton('open-search-logger', function ($app) {
            $config = $app['config']['logging.channels.open-search'];
            $logger = new OpenSearchLogger($config);

            // Регистрируем обработчик логов в Laravel LogManager
            $this->app['log']->getMonolog()->pushHandler(new PsrHandler($logger));

            return $logger;
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/open-search-logger.php' => config_path('open-search-logger.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../config/open-search-logger.php', 'logging.channels.open-search'
        );
    }

    protected function getFallbackChannelName()
    {
        return 'stack';
    }
}
