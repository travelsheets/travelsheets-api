<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 11/12/2017
 * Time: 17:22
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\RegisterConfirmType;
use AppBundle\Form\RegisterType;
use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function registerConfirmAction(Request $request)
    {
        $form = $this->createForm(RegisterConfirmType::class);
        $this->processForm($form, $request);

        $data = $form->getNormData();

        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneBy(array(
            'email' => $data['email'],
            'token' => $data['token'],
            'verified' => false,
        ));

        if(!isset($user)) {
            throw new NotFoundHttpException('User not found or already verified');
        }

        $user->setVerified(true);
        $user->setToken(null);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->createApiResponse($user, 200, 'details');
    }
}