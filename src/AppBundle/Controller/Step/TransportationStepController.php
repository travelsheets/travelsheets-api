<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 09/08/2017
 * Time: 12:13
 */

namespace AppBundle\Controller\Step;


use AppBundle\Controller\AbstractStepController;
use AppBundle\Entity\Step\TransportationStep;
use AppBundle\Entity\Travel;
use AppBundle\Form\Step\TransportationStepType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TransportationStepController extends AbstractStepController
{
    /**
     * Add new Step in Travel
     *
     * @param Travel $travel
     * @param Request $request
     * @return Response
     */
    public function newAction(Travel $travel, Request $request)
    {
        $form = $this->createForm(TransportationStepType::class);
        $form->handleRequest($request);

        if($form->isValid()) {
            /** @var TransportationStep $step */
            $step = $form->getData();
            $step->setTravel($travel);

            $em = $this->getDoctrine()->getManager();
            $em->persist($step);
            $em->flush();

            return $this->redirectToRoute('app_travel_view', array(
                'travel' => $travel->getId(),
            ));
        }

        return $this->render('@App/step/new.html.twig', array(
            'travel' => $travel,
            'type' => 'Transport',
            'form' => $form->createView(),
        ));
    }
}