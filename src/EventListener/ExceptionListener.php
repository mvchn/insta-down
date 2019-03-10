<?php

namespace App\EventListener;

use Http\Client\Exception\NetworkException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        $code = $exception instanceof NetworkException ? 500 : 400;

        $responseData = [
            'error' => [
                'code' => $code,
                'message' => $exception->getMessage()
            ]
        ];

        $this->logger->warning($exception->getMessage());
        
        $event->setResponse(new JsonResponse($responseData, $code));
    }
}
