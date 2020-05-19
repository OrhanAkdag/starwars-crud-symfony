<?php

namespace App\Repository;

use App\Entity\Planete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Planete|null find($id, $lockMode = null, $lockVersion = null)
 * @method Planete|null findOneBy(array $criteria, array $orderBy = null)
 * @method Planete[]    findAll()
 * @method Planete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaneteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planete::class);
    }

    public function findDistanceInferieur($distance){
        return $this->createQueryBuilder('planet')
            ->where('planet.nbKmTerre <= :distance')
            ->setParameter('distance', $distance)
            ->getQuery()
            ->getResult();
    }

    public function findSearchSting($string){
        return $this->createQueryBuilder('planet')
            ->where('planet.nom LIKE :string')
            ->orWhere('planet.description LIKE :string')
            ->orWhere('planet.terrain LIKE :string')
            ->orWhere('planet.allegiance LIKE :string')
            ->setParameter(':string', '%'.$string.'%')
            ->getQuery()->getResult();
    }


    // /**
    //  * @return Planete[] Returns an array of Planete objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Planete
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
