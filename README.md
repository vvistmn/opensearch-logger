### Установить пакет можно с помощью команды 
> composer require istmn/opensearch-logger

### Необохдимо добавить в *config/app.php*
> \Istmn\OpenSearchLogger\Providers\OpenSearchLoggerServiceProvider::class,

### Для публикации файла конфигурации *config/open-search-logger.php*, необходимо выполнить команду
> php artisan vendor:publish --tag=config
