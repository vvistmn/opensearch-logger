<?php

return [
    'scheme' => env('OPENSEARCH_SCHEME', 'http'),
    'host' => env('OPENSEARCH_HOST', 'localhost'),
    'port' => env('OPENSEARCH_PORT', 9200),
    'user' => env('OPENSEARCH_USER', null),
    'pass' => env('OPENSEARCH_PASS', null),
    'index' => env('OPENSEARCH_INDEX', 'logging_index'),
    'channel' => [
        'driver' => 'custom',
        'via' => \Istmn\OpenSearchLogger\OpenSearchLogger::class,
    ],
];
