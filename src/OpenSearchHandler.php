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
            'message' => $record['message'],
            // Добавьте дополнительные поля, которые вы хотите отправить
            // 'timestamp' => $record['datetime']->format('Y-m-d H:i:s'),
            // 'level' => $record['level'],
            // ...
        ];

        // Отправьте данные в OpenSearch
        $this->client->index([
            'index' => 'new_test_inged', // Замените на имя вашего индекса в OpenSearch
            'type' => 'log', // Замените на тип вашего документа
            'body' => $data,
        ]);
    }
}
