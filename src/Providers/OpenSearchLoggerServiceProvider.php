<?php

namespace Istmn\OpenSearchLogger\Providers;

use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Istmn\OpenSearchLogger\OpenSearchLogger;

class OpenSearchLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/opensearch-logger.php' => config_path('opensearch-logger.php'),
        ], 'config');

        // Получаем конфигурацию канала 'opensearch' из файла config/opensearch-logger.php
        $opensearchChannelConfig = $this->app['config']->get('opensearch-logger.logging');
        if (is_array($opensearchChannelConfig)) {
            foreach ($opensearchChannelConfig as $code => $config) {
                // Добавляем канал 'opensearch' в конфигурацию логирования
                $this->app['config']->set("logging.channels.{$code}", $config);
            }
        }
    }

    public function register()
    {
        // Создаем экземпляр клиента OpenSearch и регистрируем его в контейнере
        $this->app->singleton('opensearch', function ($app) {
            $config = $app['config']->get('opensearch-logger');
            return ClientBuilder::create()
                ->setHosts([$config])
                ->build();
        });
    }
}
