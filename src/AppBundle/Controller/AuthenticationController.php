<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 11/12/2017
 * Time: 17:22
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\RegisterType;
use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationController extends BaseController
{
    public function registerAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);
        $this->processForm($form, $request);

        // Create token
        $token = md5(uniqid($user->getUsername(), true));
        $user->setToken($token);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->createApiResponse($user, 201, 'details');
    }
}