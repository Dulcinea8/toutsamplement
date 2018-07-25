<?php

namespace App\Repository;

use App\Entity\Relations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

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
        //on récupère l'objet pdo qui permet de se connecter à la base => le résultat du try catch
        $connexion = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM relations ORDER BY id DESC LIMIT 4';
        $select = $connexion->prepare($sql);
        $select->execute();
        
        //on renvoie un tableau de tableau
        return $select->fetchAll();

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
