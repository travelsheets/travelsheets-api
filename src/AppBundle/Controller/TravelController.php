<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Travel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 08/08/2017
 * Time: 23:12
 */
class TravelController extends Controller
{
    public function listAction(Request $request)
    {
        $entities = $this->getDoctrine()->getRepository(Travel::class)->findAll();

        return $this->render('@App/travel/list.html.twig', array(
            'entities' => $entities,
        ));
    }
}