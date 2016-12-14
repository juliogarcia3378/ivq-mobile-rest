<?php

namespace Core\ComunBundle\EventListener;

use Core\ComunBundle\Exception\PublishedMessageException;
use Core\ComunBundle\Exception\UserInputException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class PublishedMessageExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!$exception instanceof PublishedMessageException) {
            return;
        }

        $code = $exception instanceof UserInputException ? 400 : 500;

        $responseData = [
            'error' => [
                'code' => $code,
                'message' => $exception->getMessage()
            ]
        ];

        $event->setResponse(new JsonResponse($responseData, $code));
    