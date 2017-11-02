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
        $search = $request->get('search', null);

        $qb = $this->getDoctrine()
            ->getRepository(Travel::class)
            ->findAllQueryBuilder($search)
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
        $form = $this->createForm(TravelType::class);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var Travel $travel */
            $travel = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($travel);
            $em->flush();

            return $this->redirectToRoute('app_travel_view', array(
                'travel' => $travel->getId(),
            ));
        }

        return $this->render('@App/travel/new.html.twig', array(
            'form' => $form->createView(),
        ));
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
        $steps = $this->getDoctrine()->getRepository(AbstractStep::class)->findBy(array(
            'travel' => $travel,
        ), array('dateStart' => 'ASC'));

        $totalTransportation = 0;
        $totalAccomodation = 0;
        $totalTour = 0;
        $total = 0;

        foreach($steps as &$step) {
            $price = $step->getPrice();
            if(isset($price) && is_numeric($price)) {
                if($step instanceof TransportationStep) {
                    $totalTransportation += $price;
                } elseif($step instanceof AccomodationStep) {
                    $totalAccomodation += $price;
                } elseif($step instanceof TourStep) {
                    $totalTour += $price;
                }

                $total += $price;
            }
        }

        return $this->render('@App/travel/view.html.twig', array(
            'travel' => $travel,
            'steps' => $steps,
            'totalTransportation' => $totalTransportation,
            'totalAccomodation' => $totalAccomodation,
            'totalTour' => $totalTour,
            'total' => $total,
        ));
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
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($travel);
            $em->flush();

            return $this->redirectToRoute('app_travel_view', array(
                'travel' => $travel->getId(),
            ));
        }

        return $this->render('@App/travel/edit.html.twig', array(
            'travel' => $travel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Delete a Travel
     *
     * @param Travel $travel
     * @param Request $request
     * @return Response
     */
    public function deleteAction(Travel $travel, Request $request)
    {
        $confirm = $request->get('confirm', false);

        if($confirm) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($travel);
            $em->flush();

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('@App/travel/delete.html.twig', array(
            'travel' => $travel,
        ));
    }
}