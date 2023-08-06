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
        $opensearchChannelConfig = $this->app['config']->get('opensearch-logger.channel');
        // Добавляем канал 'opensearch' в конфигурацию логирования
        $this->app['config']->set('logging.channels.opensearch', $opensearchChannelConfig);

    }

    public function register()
    {
        // Создаем экземпляр клиента OpenSearch и регистрируем его в контейнере
        $this->app->singleton('opensearch', function ($app) {
            $config = $app['config']['opensearch-logger'];
            unset($config['channel']);

            return ClientBuilder::create()
                ->setHosts(['http://127.0.0.1:9200']) // Укажите здесь адреса хостов OpenSearch
                ->build();
        });

        // Регистрируем кастомный канал логирования 'opensearch'
        $this->app->bind('log.opensearch', function ($app) {
            $client = $app['opensearch'];
            return new OpenSearchLogger($client);
        });

        Log::extend('open-search', function ($app, array $config) {
            return $app->make('open-search-logger');
        });
    }
}
