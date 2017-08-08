<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Travel;
use AppBundle\Form\TravelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 08/08/2017
 * Time: 23:12
 */
class TravelController extends Controller
{
    /**
     * List all Travels
     *
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $entities = $this->getDoctrine()->getRepository(Travel::class)->findAll();

        return $this->render('@App/travel/list.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(TravelType::class);
        $form->handleRequest($request);

        if($form->isValid()) {
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
    public function viewAction(Travel $travel, Request $request) {
        return $this->render('@App/travel/view.html.twig', array(
           'travel' => $travel,
        ));
    }
}