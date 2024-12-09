<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ResponseHeadersSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::RESPONSE => 'onKernelResponse'];
    }

    public function onKernelResponse(ResponseEvent $responseEvent): void
    {
        $headers = $responseEvent->getResponse()->headers;

        $headers->add([
            'Access-Control-Allow-Origin'  => '*',
            'Access-Control-Allow-Methods' => 'POST, GET, PUT, OPTIONS',
            'Access-Control-Allow-Headers' => 'Accept, Authorization, Content-Length, Content-Type, ETag, Last-Modified, Status, X-Experience-API-Version, X-Experience-API-Consistent-Through',
        ]);
    }
}