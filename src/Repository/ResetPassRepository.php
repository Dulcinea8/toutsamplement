<?php

namespace App\Repository;

use App\Entity\ResetPass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ResetPass|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResetPass|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResetPass[]    findAll()
 * @method ResetPass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResetPassRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ResetPass::class);
    }

    /*
     requete pour chercher le token et l'id dans ma bdd
     */
    public function searcheToken(string $token, int $idUser)
    {
        $querybuilder = $this->createQueryBuilder('r')
            ->andWhere('r.token = :token','r.user_id = :userId')
            ->setParameter('token', $token)
            ->setParameter('userId',$idUser)
            ->getQuery();
        return $querybuilder->execute();
    }


//    /**
//     * @return ResetPass[] Returns an array of ResetPass objects
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
    public function findOneBySomeField($value): ?ResetPass
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
