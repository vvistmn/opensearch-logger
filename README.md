### Установить пакет можно с помощью команды 
> composer require istmn/opensearch-logger

### Необохдимо добавить в *config/app.php*
> \Istmn\OpenSearchLogger\Providers\OpenSearchLoggerServiceProvider::class,

### Для публикации файла конфигурации *config/open-search-logger.php*, необходимо выполнить команду
> php artisan vendor:publish --tag=config

### Переменные .env
* OPENSEARCH_SCHEME - схема подключения к OpenSearch. *http/https*
* OPENSEARCH_HOST - айпишник подключения к OpenSearch. *localhost*
* OPENSEARCH_PORT - порт для подключения к OpenSearch. *9200*
* OPENSEARCH_USER - логин пользователя для подключения к OpenSearch. *null*
* OPENSEARCH_PASS - пароль для подключения к OpenSearch. *null*
* OPENSEARCH_INDEX - индекс для хранения логов. *log_index*
* OPENSEARCH_VIA_NAMESPACE - создание канала логирования. *\Istmn\OpenSearchLogger\OpenSearchLogger.php*
* OPENSEARCH_TAP_NAMESPACE - формат логов. *\Istmn\OpenSearchLogger\OpenSearchLoggerFormatter.php*

