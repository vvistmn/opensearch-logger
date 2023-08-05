<?php

namespace Istmn\OpenSearchLogger;

use Elasticsearch\ClientBuilder;
use Illuminate\Log\Logger;
use Illuminate\Log\LogManager;

class OpenSearchLogger
{
    protected $client;
    protected $index;

    public function __construct(array $config)
    {
        $this->client = ClientBuilder::create()
            ->setHosts([$config['endpoint']])
            ->build();

        $this->index = $config['index'];
    }

    public function __invoke(array $config)
    {
        $handler = function ($level, $message, $context) {
            $logData = [
                'message' => $message,
                'timestamp' => date('Y-m-d H:i:s'),
                'level' => $level,
            ];

            $params = [
                'index' => $this->index,
                'body' => $logData,
            ];

            $this->client->index($params);
        };

        return new Logger(
            new LogManager(app()), app()->make('events')
        );
    }
}
