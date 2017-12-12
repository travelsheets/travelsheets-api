<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractStep;
use AppBundle\Entity\Step\AccomodationStep;
use AppBundle\Entity\Step\TourStep;
use AppBundle\Entity\Step\TransportationStep;
use AppBundle\Entity\Travel;
use AppBundle\Form\TravelType;
use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 08/08/2017
 * Time: 23:12
 */
class TravelController extends BaseController
{
    /**
     * List all Travels
     *
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $user = $this->getUser();

        $past = $request->query->getBoolean('past', false);

        $qb = $this->getDoctrine()
            ->getRepository(Travel::class)
            ->findAllQueryBuilder($user, $past)
        ;

        $paginatedCollection = $this->get('core.factory.pagination')->createCollection($qb, $request);

        $response = $this->createApiResponse($paginatedCollection, 200);

        return $response;
    }

    /**
     * Create a new Travel
     *
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $travel = new Travel();

        $form = $this->createForm(TravelType::class, $travel);
        $this->processForm($form, $request);

        $em = $this->getDoctrine()->getManager();
        $em->persist($travel);
        $em->flush();

        return $this->createApiResponse($travel, 201, array('details'));
    }

    /**
     * View a Travel
     *
     * @param Travel $travel
     * @param Request $request
     * @return Response
     */
    public function viewAction(Travel $travel, Request $request)
    {
        $view = explode(',', $request->get('view', 'details'));
        return $this->createApiResponse($travel, 200, $view);
    }

    /**
     * Edit a Travel
     *
     * @param Travel $travel
     * @param Request $request
     * @return Response
     */
    public function editAction(Travel $travel, Request $request)
    {
        $form = $this->createForm(TravelType::class, $travel);
        $this->processForm($form, $request);

        $em = $this->getDoctrine()->getManager();
        $em->persist($travel);
        $em->flush();

        $view = explode(',', $request->get('view', 'details'));
        return $this->createApiResponse($travel, 200, $view);
    }

    /**
     * Delete a Travel
     *
     * @param Travel $travel
     * @return Response
     */
    public function deleteAction(Travel $travel)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($travel);
        $em->flush();

        return $this->createApiResponse(null, 204);
    }
}