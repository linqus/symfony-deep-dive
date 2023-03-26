<?php

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
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

        // $request->attributes->set('_controller', function ($slug=null) {
        //     dd($slug);
        //     return new Response('Ive just took over a controller!');
        // });

        //dd($request->attributes);

        $useragent = $request->headers->get('user-agent');
        $this->logger->info(sprintf('User-Agent is: "%s"',$useragent));

        //$request->attributes->set('isMac', true);
    }

    public static function getSubscribedEvents() {
        return [
            RequestEvent::class => ['onKernelRequest',0],
        ];
    }
}