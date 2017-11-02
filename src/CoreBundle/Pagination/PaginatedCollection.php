<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 13:14
 */

namespace CoreBundle\Pagination;


use Pagerfanta\Pagerfanta;

class PaginatedCollection
{
    /**
     * @var array
     */
    private $items;

    /**
     * @var int
     */
    private $total;

    /**
     * @var int
     */
    private $count;

    /**
     * @var int
     */
    private $pageCurrent;

    /**
     * @var int
     */
    private $pageNext;

    /**
     * @var int
     */
    private $pagePrevious;

    /**
     * @var int
     */
    private $pageFirst;

    /**
     * @var int
     */
    private $pageLast;

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    public function __construct(array $items, $totalItems)
    {
        $this->items = $items;
        $this->total = $totalItems;
        $this->count = count($items);
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function getPageCurrent()
    {
        return $this->pageCurrent;
    }

    /**
     * @param int $pageCurrent
     * @return PaginatedCollection
     */
    public function setPageCurrent($pageCurrent)
    {
        $this->pageCurrent = (int) $pageCurrent;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageNext()
    {
        return $this->pageNext;
    }

    /**
     * @param int $pageNext
     * @return PaginatedCollection
     */
    public function setPageNext($pageNext)
    {
        $this->pageNext = (int) $pageNext;
        return $this;
    }

    /**
     * @return int
     */
    public function getPagePrevious()
    {
        return $this->pagePrevious;
    }

    /**
     * @param int $pagePrevious
     * @return PaginatedCollection
     */
    public function setPagePrevious($pagePrevious)
    {
        $this->pagePrevious = (int) $pagePrevious;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageFirst()
    {
        return $this->pageFirst;
    }

    /**
     * @param int $pageFirst
     * @return PaginatedCollection
     */
    public function setPageFirst($pageFirst)
    {
        $this->pageFirst = (int) $pageFirst;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageLast()
    {
        return $this->pageLast;
    }

    /**
     * @param int $pageLast
     * @return PaginatedCollection
     */
    public function setPageLast($pageLast)
    {
        $this->pageLast = (int) $pageLast;
        return $this;
    }
}