<?php
/**
 * User: michaelgt
 */

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

    /**
     * @param $term
     * @param string $order
     * @param int $limit
     * @param int $offset
     * @param $client
     * @return \Pagerfanta\Pagerfanta
     */
    public function searchListByClient($term, $order = 'asc', $limit = 20, $offset = 0, $client)
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->orderBy('u.id', $order)
            ->where('u.client = ?2')
            ->setParameter(2, $client);

        if ($term) {
            $qb
                ->where('u.id LIKE ?1')
                ->setParameter(1, '%' . $term . '%');
        }

        return $this->paginate($qb, $limit, $offset);
    }

    /**
     * @param $id
     * @param $client
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function detailUserOfClient($id, $client)
    {
        return $this->createQueryBuilder('u')
                ->select('u')
                ->where('u.id = ?1')
                ->andWhere('u.client = ?2')
                ->setParameters(array(1 => $id, 2 => $client))
                ->getQuery()
                ->getSingleResult();
    }
}
