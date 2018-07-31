<?php

namespace App\Repository;

use App\Entity\Artistes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Artistes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artistes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artistes[]    findAll()
 * @method Artistes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Artistes::class);
    }



     public function last4Artistes(): array
    {
         return $this->createQueryBuilder('a')
            ->andWhere('a.user IS NOT NULL')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;

    }
    public function findArtisteByNom($nom){
        return $this->createQueryBuilder('a')
            ->andWhere('a.nom = :nom')
            ->setParameter('nom', $nom)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    /*
        Moteur de recherche par Artist
    */
    public function searchArtist($recherche)
    {

        $querybuilder = $this->createQueryBuilder('a')
            ->where('a.nom LIKE :recherche')
            ->setParameter('recherche', '%' . $recherche.'%')
            ->getQuery();
        return $querybuilder->execute();
    }

    /*
     * Recherche des genres d Artiste
     */
    public function findGenres()
    {

        $connexion = $this->getEntityManager()->getConnection();
        $sql = 'SELECT DISTINCT(genre) FROM artistes';
        $select = $connexion->query($sql);
        $select->execute();
        // on renvoie un tableau de tableau
        return $select->fetchAll();

        //SELECT DISTINCT(genre) FROM artistes

    }



//    /**
//     * @return Artistes[] Returns an array of Artistes objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Artistes
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
