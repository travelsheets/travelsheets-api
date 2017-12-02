<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 13:25
 */

namespace CoreBundle\Pagination;


use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;

class PaginationFactory
{
    public function createCollection(QueryBuilder $qb, Request $request)
    {
        $currentPage = $request->query->get('page', 1);

        $adapter = new DoctrineORMAdapter($qb, false);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(10);
        $pagerfanta->setCurrentPage($currentPage);

        $items = [];
        foreach ($pagerfanta->getCurrentPageResults() as $item) {
            $items[] = $item;
        }

        $paginatedCollection = new PaginatedCollection($items, $pagerfanta->getNbResults());

        $paginatedCollection->setPageCurrent($currentPage);
        $paginatedCollection->setPageFirst(1);
        $paginatedCollection->setPageLast($pagerfanta->getNbPages());

        if ($pagerfanta->hasNextPage()) {
            $paginatedCollection->setPageNext($pagerfanta->getNextPage());
        }

        if ($pagerfanta->hasPreviousPage()) {
            $paginatedCollection->setPagePrevious($pagerfanta->getPreviousPage());
        }

        return  $paginatedCollection;
    }
}