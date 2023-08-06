<?php

namespace Istmn\OpenSearchLogger;

use Monolog\Logger;

class OpenSearchLoggerFormatter
{
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->pushProcessor(new OpenSearchLoggerIntrospectionProcessor(Logger::DEBUG, ['Illuminate\\', 'App\\Services\\Logging\\']));
        }
    }
}
