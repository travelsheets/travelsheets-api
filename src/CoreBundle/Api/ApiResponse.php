<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 01/11/2017
 * Time: 20:01
 */

namespace CoreBundle\Api;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;

class ApiResponse
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * ApiResponse constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Serialize Object
     *
     * @param $object
     * @param string $format
     * @param array $serializerGroups
     * @return string|\Symfony\Component\Serializer\Encoder\scalar
     */
    public function serialize($object, $format = 'json', $serializerGroups = [])
    {
        return $this->serializer->serialize($object, $format, array(
            'groups' => $serializerGroups
        ));
    }

    /**
     * @param $object
     * @param int $statusCode
     * @param array $serializerGroups
     * @param array $headers
     *
     * @return JsonResponse
     */
    public function createApiResponse($object, $statusCode = 200, $serializerGroups = [], $headers = [])
    {
        return new JsonResponse($this->serialize($object, 'json', $serializerGroups), $statusCode, $headers, true);
    }

    /**
     * Create a ApiProblem Reponse
     *
     * @param ApiProblem $apiProblem
     * @return JsonResponse
     */
    public function createApiProblemResponse(ApiProblem $apiProblem)
    {
        $data = $apiProblem->toArray();
        // making type a URL, to a temporarily fake page
        if ($data['type'] != 'about:blank') {
            $data['type'] = '/docs/errors#'.$data['type'];
        }
        $response = new JsonResponse(
            $data,
            $apiProblem->getStatusCode()
        );
        $response->headers->set('Content-Type', 'application/problem+json');
        return $response;
    }
}