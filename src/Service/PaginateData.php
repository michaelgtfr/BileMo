<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 19/03/2020
 * Time: 11:19
 */

namespace App\Service;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

abstract class PaginateData extends ServiceEntityRepository
{
    /**
     * allows paging information send
     *
     * @param QueryBuilder $qb
     * @param int $limit
     * @param int $offset
     * @return Pagerfanta
     */
    public function paginate(QueryBuilder $qb, $limit = 20, $offset = 0)
    {
        if (0 == $limit) {
            throw new \LogicException('$limit must be greater than 0.');
        }

        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));
        $currentPage = ceil(($offset + 1) / $limit);
        $pager->setCurrentPage($currentPage);
        $pager->setMaxPerPage((int) $limit);

        return $pager;
    }
}