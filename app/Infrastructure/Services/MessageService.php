<?php

namespace App\Infrastructure\Services;

use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Factories\MessageFactory;
use App\Infrastructure\Interfaces\MessageInterface;

class MessageService
{
    /**
     * LogInterface implementation
     *
     * @var object
     */
    protected $logger;

    /**
     * messageFactory
     *
     * @var object
     */
    protected $messageFactory;

    /**
     * __construct
     *
     * @param MessageFactory $messageFactory
     * @param LogInterface $logger
     * 
     */
    public function __construct(
        MessageFactory $messageFactory,
        LogInterface $logger
    ) {
        $this->logger = $logger;
        $this->messageFactory = $messageFactory;
    }
    /**
     * getMessage
     *
     * @param  string $type Тип сообщения ("success", "failure", "warning")
     * @return string|null
     */
    public function getMessage(string $type): ?string
    {
        try {
            $message = $this->messageFactory::create($type);
            return $message->getMessage();
        } catch (\Exception $e) {
            $this->logger->error('Error when generate message: ' . $e->getMessage());
            return null;
        }
    }
}
