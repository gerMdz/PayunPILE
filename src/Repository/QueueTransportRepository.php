<?php

namespace App\Repository;

use App\Entity\QueueTransport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QueueTransport|null find($id, $lockMode = null, $lockVersion = null)
 * @method QueueTransport|null findOneBy(array $criteria, array $orderBy = null)
 * @method QueueTransport[]    findAll()
 * @method QueueTransport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QueueTransportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QueueTransport::class);
    }

    // /**
    //  * @return QueueTransport[] Returns an array of QueueTransport objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QueueTransport
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
