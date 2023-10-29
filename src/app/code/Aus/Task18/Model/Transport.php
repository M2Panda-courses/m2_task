<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Aus\Task18\Model;

use Laminas\Mail\Message;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\MessageInterface;
use Magento\Framework\Phrase;
use Psr\Log\LoggerInterface;

class Transport extends \Magento\Email\Model\Transport
{
    /**
     * @var MessageInterface
     */
    private $message;

    /**
     * @var array
     */
    public $email;

    /**
     * @param MessageInterface $message Email message object
     */
    public function __construct(
        MessageInterface $message,
        ScopeConfigInterface $scopeConfig,
        $parameters = null,
        LoggerInterface $logger = null,

    ) {
        parent::__construct($message, $scopeConfig, $parameters, $logger);
        $this->message = $message;
        $this->email = [];
    }

    /**
     * @inheritdoc
     */
    public function sendMessage()
    {
        try {
            $laminasMessage = Message::fromString($this->message->getRawMessage())->setEncoding('utf-8');

            $laminasMessage->setTo('CallCenter@example.com')
                ->setBody("Customer imported:" . implode(', ', $this->email))
                ->setSubject('Success import')
                ->setFrom('owner@example.com');

            $this->getTransport()->send($laminasMessage);
        } catch (\Exception $e) {
            throw new MailException(new Phrase('Unable to send mail. Please try again later.'), $e);
        }
    }
}

