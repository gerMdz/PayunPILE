<?php

namespace App\Repository;

use App\Entity\DelayMail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DelayMail|null find($id, $lockMode = null, $lockVersion = null)
 * @method DelayMail|null findOneBy(array $criteria, array $orderBy = null)
 * @method DelayMail[]    findAll()
 * @method DelayMail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DelayMailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DelayMail::class);
    }

    /**
    * @return DelayMail[] Returns an array of DelayMail objects
    */

    public function findDelayMail()
    {
        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
            ->orderBy('d.prioridad', 'ASC')
            ->addOrderBy('d.creacionAt', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?DelayMail
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
