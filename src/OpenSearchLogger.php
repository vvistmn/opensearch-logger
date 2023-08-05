<?php

namespace Istmn\OpenSearchLogger;

use Elasticsearch\ClientBuilder;

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

    public function log($level, $message, array $context = [])
    {
        $logData = [
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s'),
            'level' => $level,
            'context' => $context,
        ];

        $params = [
            'index' => $this->index,
            'body' => $logData,
        ];

        $this->client->index($params);
    }
}
