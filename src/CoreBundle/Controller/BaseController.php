<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 13:09
 */

namespace CoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseController extends Controller
{
    /**
     * Create API Response
     *
     * @param $data
     * @param $statusCode
     * @param array $serializerGroups
     *
     * @return JsonResponse
     */
    protected function createApiResponse($data, $statusCode, $serializerGroups = [])
    {
        return $this->get('core.api.response')->createApiResponse($data, $statusCode, $serializerGroups);
    }
}