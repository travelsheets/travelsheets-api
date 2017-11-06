<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 06/11/2017
 * Time: 18:23
 */

namespace AppBundle\Controller;


use AppBundle\Entity\AbstractStep;
use AppBundle\Entity\StepAttachment;
use AppBundle\Entity\Travel;
use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class StepAttachmentController extends BaseController
{
    /**
     * List all StepAttachments
     *
     * @param Travel $travel
     * @param AbstractStep $step
     * @param Request $request
     *
     * @return Response
     */
    public function listAction(Travel $travel, AbstractStep $step, Request $request)
    {
        $qb = $this->getDoctrine()
            ->getRepository(StepAttachment::class)
            ->findAllByStepQueryBuilder($step)
        ;


        $paginatedCollection = $this->get('core.factory.pagination')->createCollection($qb, $request);

        $response = $this->createApiResponse($paginatedCollection, 200);

        return $response;
    }
}