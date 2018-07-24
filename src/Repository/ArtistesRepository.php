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



     public function last5Artistes(): array
    {
        //on récupère l'objet pdo qui permet de se connecter à la base => le résultat du try catch
        $connexion = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM artistes ORDER BY id DESC LIMIT 5';
        $select = $connexion->prepare($sql);
        $select->execute();
        //on renvoie un tableau de tableau
        return $select->fetchAll();

    }
    public function findArtisteByNom($nom){
        return $this->createQueryBuilder('a')
            ->andWhere('a.nom = :nom')
            ->setParameter('nom', $nom)
            ->getQuery()
            ->getOneOrNullResult()
        ;
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
