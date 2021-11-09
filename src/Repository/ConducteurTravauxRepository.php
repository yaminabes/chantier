<?php

namespace App\Repository;

use App\Entity\ConducteurTravaux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConducteurTravaux|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConducteurTravaux|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConducteurTravaux[]    findAll()
 * @method ConducteurTravaux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConducteurTravauxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConducteurTravaux::class);
    }

    // /**
    //  * @return ConducteurTravaux[] Returns an array of ConducteurTravaux objects
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
    public function findOneBySomeField($value): ?ConducteurTravaux
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
