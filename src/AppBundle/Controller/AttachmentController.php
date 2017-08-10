<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 10/08/2017
 * Time: 14:28
 */

namespace AppBundle\Controller;


use AppBundle\Entity\AbstractStep;
use AppBundle\Entity\Attachment;
use AppBundle\Entity\StepAttachment;
use AppBundle\Entity\Travel;
use AppBundle\Form\AttachmentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class AttachmentController extends Controller
{
    /**
     * Add a new Attachment
     *
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $attachment = new Attachment();

        $form = $this->createForm(AttachmentType::class, $attachment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attachment);
            $em->flush();

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('@App/attachment/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Add a new Attachment for Step
     *
     * @param AbstractStep $step
     * @param Travel $travel
     * @param Request $request
     *
     * @return Response
     */
    public function newForStepAction(AbstractStep $step, Travel $travel, Request $request)
    {
        $attachment = new Attachment();

        $form = $this->createForm(AttachmentType::class, $attachment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attachment);

            $stepAttachment = new StepAttachment();
            $stepAttachment->setAttachment($attachment);
            $stepAttachment->setStep($step);
            $em->persist($stepAttachment);

            $em->flush();

            return $this->redirectToRoute('app_travel_view', array(
                'travel' => $travel->getId(),
            ));
        }

        return $this->render('@App/attachment/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Download an Attachment
     *
     * @param Attachment $attachment
     * @param Travel $travel
     * @param Request $request
     *
     * @return Response
     */
    public function downloadAction(Attachment $attachment, Travel $travel, Request $request) {
        $response = new BinaryFileResponse($attachment->getFile());
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $attachment->getName() . '.' . $attachment->getFile()->guessExtension());
        return $response;
    }

    /**
     * Edit an Attachment
     *
     * @param Attachment $attachment
     * @param Travel $travel
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(Attachment $attachment, Travel $travel, Request $request) {
        $form = $this->createForm(AttachmentType::class, $attachment, array(
            'validation_groups' => array('Default'),
        ));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attachment);
            $em->flush();

            return $this->redirectToRoute('app_travel_view', array(
                'travel' => $travel->getId(),
            ));
        }

        return $this->render('@App/attachment/edit.html.twig', array(
            'attachment' => $attachment,
            'travel' => $travel,
            'form' => $form->createView(),
        ));
    }
}