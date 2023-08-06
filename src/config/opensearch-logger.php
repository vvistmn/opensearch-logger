<?php

return [
    // Схема подключения к OpenSearch
    'scheme' => env('OPENSEARCH_SCHEME', 'http'),
    // Хост подключения к OpenSearch
    'host' => env('OPENSEARCH_HOST', 'localhost'),
    // Порт подключения к OpenSearch
    'port' => env('OPENSEARCH_PORT', 9200),
    // Логин подключения к OpenSearch
    'user' => env('OPENSEARCH_USER', null),
    // Пароль подключения к OpenSearch
    'pass' => env('OPENSEARCH_PASS', null),
    // Индекс для хранения логов в OpenSearch
    'index' => env('OPENSEARCH_INDEX', 'logging_index'),
    // Канал для логирования в OpenSearch
    'logging' => [
        'opensearch' => [
            'driver' => 'custom',
            'via' => \Istmn\OpenSearchLogger\OpenSearchLogger::class,
            'tap' => [\App\Services\Logging\CustomFormatter::class]
        ],
    ],
];
