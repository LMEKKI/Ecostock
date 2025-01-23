<?php

namespace App\Repository;

use App\Entity\Ingredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ingredient>
 */
class IngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingredient::class);
    }
    /**
    * gets an array with Ingredient name, it's quantity and what unit it uses
    */
    public function findByAllIngredientDetails($id)
    {
        return $this->createQueryBuilder('i')
            ->select( 'i.name AS name','w.weight AS quantity', 'u.name AS unit')
            ->leftJoin('i.unit', 'u')
            ->leftJoin('i.weight', 'w')
            ->where('i.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult(); // Retourne un tableau avec uniquement les valeurs nécessaires
    }

//    /**
//     * @return Ingredient[] Returns an array of Ingredient objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ingredient
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
