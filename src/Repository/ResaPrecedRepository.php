<?php

namespace App\Repository;

use App\Entity\ResaPreced;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResaPreced|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResaPreced|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResaPreced[]    findAll()
 * @method ResaPreced[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResaPrecedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResaPreced::class);
    }

    // /**
    //  * @return ResaPreced[] Returns an array of ResaPreced objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResaPreced
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
