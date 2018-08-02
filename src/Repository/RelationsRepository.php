<?php

namespace App\Repository;

use App\Entity\Relations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * @method Relations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Relations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Relations[]    findAll()
 * @method Relations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Relations::class);
    }


    public function last4Samples(): array
    {
       return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }

    public function lastSamples(int $page = 1): Pagerfanta
    {
        $qb= $this->createQueryBuilder('a')
            ->andWhere('a.is_validated = 1')
            ->orderBy('a.id', 'DESC')

            ;
        return $this->createPaginator($qb->getQuery(), $page);
    }

    private function createPaginator($query, int $page): Pagerfanta
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(5);
        $paginator->setCurrentPage($page);

        return $paginator;
    }


    public function doesRelationExist($id1, $id2){
        return $this->createQueryBuilder('a')
            ->andWhere('a.sampleur = :id1', 'a.original = :id2')
            ->setParameter('id1', $id1)
            ->setParameter('id2', $id2)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getNonValidated(){
        return $this->createQueryBuilder('a')
            ->andWhere('a.is_validated = 0')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByIdTrack($id){
        return $this->createQueryBuilder('r')
            ->andWhere('r.sampleur = :id')
            ->orWhere('r.original = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

    }

    /*
 * recherche de samples par genre
 */
    public function myfindSamplesGenre($genre){
        $querybuilder = $this->createQueryBuilder('s')
            ->innerJoin('s.sampleur', 't')
            ->addSelect('t')
            ->innerJoin('t.idalbum', 'a')
            ->addSelect('a')
            ->innerJoin('a.idartiste', 'ar')
            ->addSelect('ar')
            ->andWhere('s.is_validated = 1')
            ->andWhere('ar.genre = :genre')
            ->setParameter('genre', $genre)
            ->orderBy('s.id', 'DESC')

            ->getQuery();
        return $querybuilder->execute();
    }




//    /**
//     * @return Relations[] Returns an array of Relations objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Relations
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
