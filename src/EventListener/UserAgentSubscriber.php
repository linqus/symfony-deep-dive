<?php

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class UserAgentSubscriber implements EventSubscriberInterface
{
    public $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;

    }

    public function onKernelRequest(RequestEvent $event) 
    {
        $request = $event->getRequest();
        $useragent = $request->headers->get('user-agent');
        $this->logger->info(sprintf('User-Agent is: "%s"',$useragent));
    }

    public static function getSubscribedEvents() {
        return [
            RequestEvent::class => 'onKernelRequest'
        ];
    }
}