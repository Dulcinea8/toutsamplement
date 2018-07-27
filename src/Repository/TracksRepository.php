<?php

namespace App\Repository;

use App\Entity\Tracks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tracks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tracks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tracks[]    findAll()
 * @method Tracks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TracksRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tracks::class);
    }

    public function findTrackByTitre($titre){
        return $this->createQueryBuilder('a')
            ->andWhere('a.titre = :titre')
            ->setParameter('titre', $titre)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findTracksById($id){
        return $this->createQueryBuilder('a')
            ->andWhere('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /*
 Moteur de recherche par Track
 */
    public function searchTrack($recherche)
    {

        $querybuilder = $this->createQueryBuilder('t')
            ->andWhere('t.titre LIKE :titre')
            ->setParameter('titre', '%' . $recherche.'%')
            ->getQuery();
        return $querybuilder->execute();
    }



//    /**
//     * @return Tracks[] Returns an array of Tracks objects
//     */
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
    public function findOneBySomeField($value): ?Tracks
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
