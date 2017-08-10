<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 10/08/2017
 * Time: 14:28
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Attachment;
use AppBundle\Form\AttachmentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AttachmentController extends Controller
{
    public function newAction(Request $request)
    {
        $attachment = new Attachment();

        $form = $this->createForm(AttachmentType::class, $attachment);
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attachment);
            $em->flush();
        }

        return $this->render('@App/attachment/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}