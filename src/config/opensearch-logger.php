<?php

$index = mb_strtolower(env('OPENSEARCH_INDEX', 'log_index'));

$viaNamespace = env('OPENSEARCH_VIA_NAMESPACE', '\Istmn\OpenSearchLogger\OpenSearchLogger');
if (!class_exists($viaNamespace)) {
    throw new \Exception("Отсутствует класс - {$viaNamespace} в OPENSEARCH_VIA_NAMESPACE");
}

$tapsNamespaceString = env('OPENSEARCH_TAP_NAMESPACE', '\Istmn\OpenSearchLogger\OpenSearchLoggerFormatter');
$tapsNamespaceArray = explode(',', $tapsNamespaceString);
if (!is_array($tapsNamespaceArray)) {
    throw new \Exception("Не смогли распарсить строку - {$tapsNamespaceString}. Разделите строки - ','(только запятая без пробелов!)");
}
$tapsNamespace = [];
foreach ($tapsNamespaceArray as $tap) {
    if (!class_exists($tap)) {
        throw new \Exception("Отсутствует класс - {$tap} в OPENSEARCH_TAP_NAMESPACE");
    }

    $tapsNamespace[] = $tap;
}

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
    'index' => $index,
    // Канал для логирования в OpenSearch
    'logging' => [
        'opensearch' => [
            'driver' => 'custom',
            'via' => $viaNamespace,
            'tap' => $tapsNamespace
        ],
    ],
];
