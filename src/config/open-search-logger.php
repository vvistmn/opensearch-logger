<?php

return [
    'endpoint' => env('OPENSEARCH_ENDPOINT', 'http://localhost:9200'),
    'index' => env('OPENSEARCH_INDEX', 'opensearch-logging'),
];
