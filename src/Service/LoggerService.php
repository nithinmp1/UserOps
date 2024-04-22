<?php

namespace App\Service;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerService
{
    private $logger;

    public function __construct(string $logFile)
    {
        // Create a logger instance
        $this->logger = new Logger('app_logger');

        // Add a stream handler to log messages to the specified file
        $this->logger->pushHandler(new StreamHandler($logFile, Logger::DEBUG));
    }

    public function getLogger(): Logger
    {
        return $this->logger;
    }

    function info($message) {
        $this->logger->info($message);
    }
}
