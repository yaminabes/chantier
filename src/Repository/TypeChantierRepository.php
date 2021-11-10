<?php

namespace App\Repository;

use App\Entity\TypeChantier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeChantier|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeChantier|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeChantier[]    findAll()
 * @method TypeChantier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeChantierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeChantier::class);
    }

    // /**
    //  * @return TypeChantier[] Returns an array of TypeChantier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeChantier
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
