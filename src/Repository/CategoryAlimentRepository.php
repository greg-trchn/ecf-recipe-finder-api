<?php

namespace App\Repository;

use App\Entity\CategoryAliment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryAliment|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryAliment|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryAliment[]    findAll()
 * @method CategoryAliment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryAlimentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryAliment::class);
    }

    // /**
    //  * @return CategoryAliment[] Returns an array of CategoryAliment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoryAliment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
