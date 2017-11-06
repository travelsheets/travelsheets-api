<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 06/11/2017
 * Time: 15:52
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Upload;
use AppBundle\Form\UploadType;
use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadController extends BaseController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $upload = new Upload();

        $form = $this->createForm(UploadType::class, $upload);
        $form->submit(array(
            'file' => $request->files->get('file'),
        ));

        if(!$form->isValid()) {
            $this->throwApiProblemValidationException($form);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($upload);
        $em->flush();

        return $this->createApiResponse($upload, 201);
    }
}