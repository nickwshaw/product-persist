<?php

namespace Willshaw\Event;

use Willshaw\Log\FileRequestLogger;

class RequestProductListener
{

    /**
     * @var \Willshaw\Log\FileRequestLogger
     */
    private $logger;

    /**
     * RequestProductListener constructor.
     * @param \Willshaw\Log\FileRequestLogger $logger
     */
    public function __construct(FileRequestLogger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param \Willshaw\Event\RequestProductEvent $event
     */
    public function onProductRequest(RequestProductEvent $event)
    {
        $this->logger->logRequest($event->getProduct());
    }
}