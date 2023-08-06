<?php

namespace Istmn\OpenSearchLogger;

use Elasticsearch\Client;
use Monolog\Logger;

class OpenSearchLogger
{
    /**
     * Создайте единый метод для получения канала логирования
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        // Создайте новый логгер Monolog и верните его
        $logger = new Logger('opensearch');
        $logger->pushHandler(new OpenSearchHandler(app('opensearch')));

        return $logger;
    }
}
