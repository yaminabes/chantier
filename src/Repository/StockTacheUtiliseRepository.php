<?php

namespace App\Repository;

use App\Entity\StockTacheUtilise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StockTacheUtilise|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockTacheUtilise|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockTacheUtilise[]    findAll()
 * @method StockTacheUtilise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockTacheUtiliseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockTacheUtilise::class);
    }

    // /**
    //  * @return StockTacheUtilise[] Returns an array of StockTacheUtilise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StockTacheUtilise
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
