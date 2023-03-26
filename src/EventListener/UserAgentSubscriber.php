<?php

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
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
        if (!$event->isMasterRequest()) {
            return;
        } 

        $request = $event->getRequest();

        // $request->attributes->set('_controller', function ($slug=null) {
        //     dd($slug);
        //     return new Response('Ive just took over a controller!');
        // });

        //dd($request->attributes);

        $useragent = $request->headers->get('user-agent');
        $this->logger->info(sprintf('User-Agent is: "%s"',$useragent));

        $request->attributes->set('_isMac', $this->isMac($request));
    }

    public static function getSubscribedEvents() {
        return [
            RequestEvent::class => ['onKernelRequest',0],
        ];
    }

    public function isMac(Request $request): bool {
                
        if ($request->query->has('mac')) {
            return $request->query->getBoolean('mac');
        }

        $userAgent = $request->headers->get('User-Agent');
        return stripos($userAgent, 'Mac') == false;
        //yield $request->headers->get('User-Agent');
    }
}