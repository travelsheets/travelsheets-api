<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 13:09
 */

namespace CoreBundle\Controller;


use CoreBundle\Api\ApiProblem;
use CoreBundle\Api\ApiProblemException;
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

    /**
     * @param FormInterface $form
     * @return array
     */
    protected function getErrorsFromForm(FormInterface $form) {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }
        return $errors;
    }

    /**
     * @param FormInterface $form
     */
    protected function throwApiProblemValidationException(FormInterface $form) {
        $errors = $this->getErrorsFromForm($form);
        $this->throwApiProblemErrorsValidationException($errors);
    }

    /**
     * @param array $errors
     * @throws ApiProblemException
     */
    protected function throwApiProblemErrorsValidationException($errors) {
        $apiProblem = new ApiProblem(400, ApiProblem::TYPE_VALIDATION_ERROR);
        $apiProblem->set('errors', $errors);
        throw new ApiProblemException($apiProblem);
    }
}