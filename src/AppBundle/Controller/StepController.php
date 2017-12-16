<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 09/08/2017
 * Time: 12:12
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractStep;
use AppBundle\Entity\Travel;
use AppBundle\Entity\User;
use CoreBundle\Api\ApiProblem;
use CoreBundle\Api\ApiProblemException;
use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepController extends BaseController
{

    /**
     * List all Steps for Travel
     *
     * @param Travel $travel
     * @param Request $request
     * @return Response
     */
    public function listAction(Travel $travel, Request $request)
    {
        $this->checkAuthorization($travel);

        $qb = $this->getDoctrine()
            ->getRepository(AbstractStep::class)
            ->findAllByTravelQueryBuilder($travel)
        ;

        $paginatedCollection = $this->get('core.factory.pagination')->createCollection($qb, $request);

        return $this->createApiResponse($paginatedCollection, 200);
    }

    /**
     * Add new Step in Travel
     *
     * @param Travel $travel
     * @param Request $request
     * @return Response
     */
    public function newAction(Travel $travel, Request $request)
    {
        $this->checkAuthorization($travel);

        // Resolve all query params
        $optionResolver = new OptionsResolver();
        $optionResolver->setRequired(array('type'));
        try {
            $params = $optionResolver->resolve($request->query->all());
        } catch(\Exception $e) {
            $apiProblem = new ApiProblem(400);
            $apiProblem->set('message', $e->getMessage());
            throw new ApiProblemException($apiProblem);
        }

        $type = $params['type'];
        $formType = 'AppBundle\\Form\\Step\\' . ucfirst($type) . 'Type';

        if (!class_exists($formType)) {
            throw new NotFoundHttpException('Type not found');
        }

        $form = $this->createForm($formType);
        $this->processForm($form, $request);

        /** @var AbstractStep $step */
        $step = $form->getData();
        $step->setTravel($travel);

        $em = $this->getDoctrine()->getManager();
        $em->persist($step);
        $em->flush();

        return $this->createApiResponse($step, 201, array('detail'));
    }

    /**
     * Get a Step
     *
     * @param Travel $travel
     * @param AbstractStep $step
     * @param Request $request
     *
     * @return Response
     */
    public function getAction(AbstractStep $step, Travel $travel, Request $request)
    {
        $this->checkAuthorization($travel);

        if($step->getTravel()->getId() != $travel->getId()) {
            throw new NotFoundHttpException("Step not found");
        }

        $view = explode(',', $request->get('view', 'detail'));

        return $this->createApiResponse($step, 200, $view);
    }

    /**
     * Edit a Step in Travel
     *
     * @param AbstractStep $step
     * @param Travel $travel
     * @param Request $request
     * @return Response
     */
    public function editAction(AbstractStep $step, Travel $travel, Request $request)
    {
        $this->checkAuthorization($travel);

        if($step->getTravel()->getId() != $travel->getId()) {
            throw new NotFoundHttpException("Step not found");
        }

        $formType = 'AppBundle\\Form\\Step\\' . ucfirst($step->getDType()) . 'StepType';

        $form = $this->createForm($formType, $step);
        $this->processForm($form, $request, FALSE);

        $em = $this->getDoctrine()->getManager();
        $em->persist($step);
        $em->flush();

        return $this->createApiResponse($step, 200, array('detail'));
    }

    /**
     * Delete a Travel
     *
     * @param AbstractStep $step
     * @param Travel $travel
     * @param Request $request
     * @return Response
     */
    public function deleteAction(AbstractStep $step, Travel $travel, Request $request)
    {
        $this->checkAuthorization($travel);

        if($step->getTravel()->getId() != $travel->getId()) {
            throw new NotFoundHttpException("Step not found");
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($step);
        $em->flush();

        return $this->createApiResponse(null, 204);
    }

    /**
     * Check authorization of Travel for current User
     *
     * @param Travel $travel
     *
     * @throws AccessDeniedHttpException
     */
    private function checkAuthorization(Travel $travel)
    {
        /** @var User $user */
        $user = $this->getUser();

        if($travel->getUser()->getId() !== $user->getId()) {
            throw new AccessDeniedHttpException('You d\'ont have access to this Travel');
        }
    }
}