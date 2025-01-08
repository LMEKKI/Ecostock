<?php

namespace App\Repository;

use App\Entity\Camping;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Camping>
 */
class CampingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Camping::class);
    }

    //    /**
    //     * @return Camping[] Returns an array of Camping objects
    //     */
    //    public function findByExampleField($value): array
    //    {

    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')

    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')

    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Camping
    //    {
 
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')

    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')

    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
