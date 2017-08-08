<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Travel;
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