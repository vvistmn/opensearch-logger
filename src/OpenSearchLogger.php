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
    public function __invoke(Client $client)
    {
        // Создайте новый логгер Monolog и верните его
        $logger = new Logger('opensearch');
        $logger->pushHandler(new OpenSearchHandler($client));

        return $logger;
    }
}
