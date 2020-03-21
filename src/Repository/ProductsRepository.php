<?php

namespace App\Repository;

use App\Entity\Products;
use App\Service\PaginateData;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends PaginateData
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }

    public function search($term, $order = 'asc', $limit = 20, $offset = 0)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->orderBy('p.id', $order)
        ;


        if ($term) {
            $qb
                ->where('p.id LIKE ?1')
                ->setParameter(1, '%'.$term.'%')
            ;
        }

        return $this->paginate($qb, $limit, $offset);
    }

    // /**
    //  * @return Products[] Returns an array of Products objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Products
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
