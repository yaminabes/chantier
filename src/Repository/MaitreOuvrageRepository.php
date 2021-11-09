<?php

namespace App\Repository;

use App\Entity\MaitreOuvrage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaitreOuvrage|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaitreOuvrage|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaitreOuvrage[]    findAll()
 * @method MaitreOuvrage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaitreOuvrageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaitreOuvrage::class);
    }

    // /**
    //  * @return MaitreOuvrage[] Returns an array of MaitreOuvrage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MaitreOuvrage
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
