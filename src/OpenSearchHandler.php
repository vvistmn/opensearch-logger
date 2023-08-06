<?php

namespace Istmn\OpenSearchLogger;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Elasticsearch\Client;

class OpenSearchHandler extends AbstractProcessingHandler
{
    protected $client;

    public function __construct(Client $client, $level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->client = $client;
    }

    protected function write(array $record): void
    {
        $data = [
            'timestamp' => $record['datetime']->format('Y-m-d H:i:s'),
            'level' => $record['level'],
            'message' => $record['message'],
        ];

        // Отправьте данные в OpenSearch
        $this->client->index([
            'index' => config('opensearch-logger.index'),
            'type' => 'log',
            'body' => $data,
        ]);
    }
}
