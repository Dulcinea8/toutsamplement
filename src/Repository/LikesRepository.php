<?php

namespace App\Repository;

use App\Entity\Likes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Likes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Likes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Likes[]    findAll()
 * @method Likes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Likes::class);
    }


    public function findLikes($user, $article){
       
         $connexion = $this->getEntityManager()->getConnection();
         $requete='SELECT * FROM likes INNER JOIN likes_users ON likes.id = likes_users.likes_id INNER JOIN likes_articles ON likes.id = likes_articles.likes_id WHERE likes_users.users_id ='.$user.' AND likes_articles.articles_id='.$article.'';
        $select = $connexion->prepare($requete);
        $select->execute();
  
        return $select->fetch();

        // return $this->createQueryBuilder('l')
        // ->innerJoin('l.article', 'a' )
        // ->innerJoin('l.user', 'u' )
        //     ->andWhere('l.article = :article')
        //     ->setParameter('article', $article)
        //     ->andWhere('l.user = :user')
        //     ->setParameter('user', $user)
        //     ->getQuery()
        //     ->getOneOrNullResult()
        //     ;

    }

    public function compteLikes($idArticle)
    {
        $connexion = $this->getEntityManager()->getConnection();
         $requete='SELECT COUNT(*) FROM likes INNER JOIN likes_users ON likes.id = likes_users.likes_id INNER JOIN likes_articles ON likes.id = likes_articles.likes_id WHERE  likes_articles.articles_id='.$idArticle.'';
        $select = $connexion->prepare($requete);
        $select->execute();
  
        return $select->fetch();
    }

    public function findLikesOnArticle($idArticle)
    {
        $connexion = $this->getEntityManager()->getConnection();
         $requete='SELECT * FROM likes INNER JOIN likes_users ON likes.id = likes_users.likes_id INNER JOIN likes_articles ON likes.id = likes_articles.likes_id WHERE  likes_articles.articles_id='.$idArticle.' AND likes_users.likes_id = likes_articles.likes_id';
        $select = $connexion->prepare($requete);
        $select->execute();
  
        return $select->fetchAll();
    }

//    /**
//     * @return Likes[] Returns an array of Likes objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Likes
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
