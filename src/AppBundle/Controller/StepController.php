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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepController extends Controller
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
        // Resolve all query params
        $optionResolver = new OptionsResolver();
        $optionResolver->setRequired(array('type'));
        $params = $optionResolver->resolve($request->query->all());

        $type = $params['type'];
        $formType = 'AppBundle\\Form\\Step\\' . ucfirst($params['type']) . 'StepType';

        if(!class_exists($formType)) {
            throw new NotFoundHttpException('Type not found');
        }

        $form = $this->createForm($formType);
        $form->handleRequest($request);

        if($form->isValid()) {
            /** @var AbstractStep $step */
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
            'type' => $type,
            'form' => $form->createView(),
        ));
    }
}