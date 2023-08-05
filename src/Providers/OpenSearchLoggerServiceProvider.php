<?php

namespace Istmn\OpenSearchLogger\Providers;

use Illuminate\Support\ServiceProvider;
use Istmn\OpenSearchLogger\OpenSearchLogger;

class OpenSearchLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Публикуем конфигурационный файл для пакета
        $this->publishes([
            __DIR__.'/../config/open-search-logger.php' => config_path('open-search-logger.php'),
        ], 'config');

        // Получаем настройки из конфигурационного файла
        $config = $this->app['config']['open-search-logger'];

        // Создаем новый канал для логирования в OpenSearch
        $this->app['config']->set('logging.channels.open-search', [
            'driver' => 'custom',
            'via' => OpenSearchLogger::class,
            'endpoint' => $config['endpoint'],
            'index' => $config['index'],
        ]);
    }

    public function register()
    {
        // Регистрируем класс сервиса OpenSearchLogger в контейнере
        $this->app->singleton(OpenSearchLogger::class, function ($app) {
            $config = $app['config']['open-search-logger'];
            return new OpenSearchLogger($config);
        });
    }
}
