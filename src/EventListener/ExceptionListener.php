<?php

// src/EventListener/ExceptionListener.php
namespace App\EventListener;

use stdClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getThrowable();
        $exceptionsListened = [403, 404, 405, 500, 402];

        // Customize your response object to display the exception details
        $response = new stdClass;
        $response->data = [];
        $response->headers = [];
        $response->statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($exception instanceof NotEncodableValueException) {
            $event->setResponse(new JsonResponse(
                [
                    'statusCode' => $response->statusCode,
                    'message' => $exception->getMessage(),
                ],
                $response->statusCode,
                $response->headers
            ));
        }

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            if (in_array($exception->getStatusCode(), $exceptionsListened)) {
                $response->statusCode = $exception->getStatusCode();
                $response->data = [
                    'statusCode' => $exception->getStatusCode(),
                    'message' => $exception->getMessage(),
                ];
                $response->headers = $exception->getHeaders();

                // sends the modified response object to the event
                $event->setResponse(new JsonResponse(
                    $response->data,
                    $response->statusCode,
                    $response->headers
                ));
            }
        }

    }
}
