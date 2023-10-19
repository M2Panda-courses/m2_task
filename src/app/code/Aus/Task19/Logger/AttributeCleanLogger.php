<?php

namespace Aus\Task19\Logger;

use DateTimeImmutable;
//use Magento\Tests\NamingConvention\true\string;
use Monolog\Logger;
use Magento\Framework\App\Config\ScopeConfigInterface;

class AttributeCleanLogger extends Logger
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param string $name
     * @param array $handlers
     * @param array $processors
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        $name,
        ScopeConfigInterface $scopeConfig,
        array $handlers = [],
        array $processors = []
    ) {
        parent::__construct($name, $handlers, $processors);
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Записати повідомлення в лог, якщо значення змінної task19/general/logger - 1
     *
     *
     * @param int $level
     * @param string $message
     * @param array $context
     * @param DateTimeImmutable|null $datetime
     * @return bool
     */
    public function addRecord(int $level, string $message, array $context = [], DateTimeImmutable $datetime = null): bool
    {
        $loggerEnabled = $this->scopeConfig->getValue('task19/general/logger');

        if ($loggerEnabled == 1) {
            return parent::addRecord($level, $message, $context);
        }

        return false;
    }
}
