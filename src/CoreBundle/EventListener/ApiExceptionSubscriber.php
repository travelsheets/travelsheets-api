<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 12:53
 */

namespace CoreBundle\EventListener;


use CoreBundle\Api\ApiProblem;
use Monolog\Logger;
use CoreBundle\Api\ApiProblemException;
use CoreBundle\Api\ApiResponse;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\KernelInterface;

class ApiExceptionSubscriber implements EventSubscriberInterface
{
    /**
     * @var bool
     */
    private $isDev;

    /**
     * @var ApiResponse
     */
    private $apiResponse;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * ApiExceptionSubscriber constructor.
     * @param KernelInterface $kernel
     * @param ApiResponse $apiResponse
     * @param Logger $logger
     */
    public function __construct(KernelInterface $kernel, ApiResponse $apiResponse, Logger $logger)
    {
        $this->isDev = ($kernel->getEnvironment() == "dev" || $kernel->getEnvironment() == "test") ? true : false;
        $this->apiResponse = $apiResponse;
        $this->logger = $logger;
    }

    /**
     * Callback when KernelEvents::EXCEPTION is triggered
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $e = $event->getException();

        if ($e instanceof ApiProblemException) {
            $apiProblem = $e->getApiProblem();
        } else {
            $statusCode = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;

            switch($statusCode) {
                case 404:
                    $type = ApiProblem::TYPE_NOT_FOUND;
                    break;
                case 400:
                    $type = ApiProblem::TYPE_VALIDATION_ERROR;
                    break;
                default:
                    $type = null;
                    break;
            }

            $apiProblem = new ApiProblem($statusCode, $type);
        }

        if ($this->isDev) {
            $apiProblem->set('file', $e->getFile());
            $apiProblem->set('line', $e->getLine());
            $apiProblem->set('trace', $e->getTrace());
        }

        // Log error
        $this->logger->critical($e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
        $this->logger->debug($e->getTraceAsString());
        $response = $this->apiResponse->createApiProblemResponse($apiProblem);
        $event->setResponse($response);
    }

    /**
     * Implementation of EventSubscriberInterface
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION => 'onKernelException'
        );
    }
}