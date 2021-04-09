<?php

namespace App\Repository;

use App\Entity\CuerpoMail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CuerpoMail|null find($id, $lockMode = null, $lockVersion = null)
 * @method CuerpoMail|null findOneBy(array $criteria, array $orderBy = null)
 * @method CuerpoMail[]    findAll()
 * @method CuerpoMail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuerpoMailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CuerpoMail::class);
    }

    // /**
    //  * @return CuerpoMail[] Returns an array of CuerpoMail objects
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
    public function findOneBySomeField($value): ?CuerpoMail
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
