<?php

namespace App\Repository;

use App\Entity\MateriauxNecessaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MateriauxNecessaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method MateriauxNecessaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method MateriauxNecessaires[]    findAll()
 * @method MateriauxNecessaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MateriauxNecessairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MateriauxNecessaires::class);
    }

    // /**
    //  * @return MateriauxNecessaires[] Returns an array of MateriauxNecessaires objects
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
    public function findOneBySomeField($value): ?MateriauxNecessaires
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
