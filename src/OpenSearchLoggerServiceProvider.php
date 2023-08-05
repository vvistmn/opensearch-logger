<?php

namespace Istmn\OpenSearchLogger;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class OpenSearchLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/opensearch-logger.php' => config_path('opensearch-logger.php'),
        ], 'config');
    }

    public function register()
    {
        $this->app->bind('open-search-logger', function ($app) {
            $config = $app['config']['opensearch-logger'];

            return new OpenSearchLogger($config);
        });

        Log::extend('open-search', function ($app, array $config) {
            return $app->make('open-search-logger');
        });
    }
}
