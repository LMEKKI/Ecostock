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
     * gets an array with Ingredient name, its quantity and what unit it uses
     * @param int $dataSheetId L'identifiant de la fiche technique
     * @return array("name" => string, "quantity" => int, "unit" => string);
     */
    public function findByDatasheetId(String $dataSheetId): array
    {
        return $this->createQueryBuilder('i')
            ->select('i.name AS name', 'w.value AS quantity', 'u.name AS unit')
            ->leftJoin('i.unit', 'u')
            ->leftJoin('i.weight', 'w')
            ->leftJoin('i.datasheet', 'd')
            ->where('d.id = :dataSheetId')
            ->setParameter('dataSheetId', $dataSheetId)
            ->getQuery()
            ->getArrayResult();
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
