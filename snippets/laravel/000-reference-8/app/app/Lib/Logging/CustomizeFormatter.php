<?php

namespace App\Lib\Logging;

use Monolog\Formatter\LineFormatter;

class CustomizeFormatter
{
    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {

            $format="[%datetime%] %emoji% %channel%.%level_name% %message% %context%\n";  // Look on the Monolog's Line formatter documentation
            $formatter= new LineFormatter($format,"Y-m-d H:i:s");

             $handler->pushProcessor(function ($record) {
                switch ($record['level_name']) {
                    case 'EMERGENCY':
                        $record['emoji']="⚡";
                        break;
                    case 'ALERT':
                        $record['emoji'] = "☝";
                        break;
                    case 'CRITICAL':
                        $record['emoji'] ="😱";
                        break;
                    case 'ERROR':
                        $record['emoji'] = "😡";
                        break;
                    case 'WARNING':
                        $record['emoji'] = "☔";
                        break;
                    case 'NOTICE':
                        $record['emoji'] = "🙈";
                        break;
                    case 'INFO':
                        $record['emoji'] = "☕";
                        break;
                    case 'DEBUG':
                        $record['emoji'] = "⛹";
                        break;
                }

                return $record;
            });

            $handler->setFormatter($formatter);
        }
    }
}
