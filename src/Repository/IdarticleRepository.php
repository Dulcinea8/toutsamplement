<?php

namespace App\Repository;

use App\Entity\Idarticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Idarticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Idarticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Idarticle[]    findAll()
 * @method Idarticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdarticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Idarticle::class);
    }

//    /**
//     * @return Idarticle[] Returns an array of Idarticle objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Idarticle
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
