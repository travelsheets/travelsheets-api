<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 13:09
 */

namespace CoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @param FormInterface $form
     *
     * @param Request $request
     * @param bool $clearMissing
     * @param bool $required
     */
    protected function processForm(FormInterface $form, Request $request, $clearMissing = false, $required = true) {
        $this->get('core.processor.form')->processForm($form, $request, $clearMissing, $required);
    }
}