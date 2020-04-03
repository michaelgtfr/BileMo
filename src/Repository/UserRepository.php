<?php

namespace App\Repository;

use App\Entity\User;
use App\Service\PaginateData;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends PaginateData
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function search($term, $order = 'asc', $limit = 20, $offset = 0)
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->orderBy('u.id', $order);


        if ($term) {
            $qb
                ->where('u.id LIKE ?1')
                ->setParameter(1, '%' . $term . '%');
        }

        return $this->paginate($qb, $limit, $offset);
    }
}
