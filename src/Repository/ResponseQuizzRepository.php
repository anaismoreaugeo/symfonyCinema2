<?php

namespace App\Repository;

use App\Entity\ResponseQuizz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ResponseQuizz>
 *
 * @method ResponseQuizz|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResponseQuizz|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResponseQuizz[]    findAll()
 * @method ResponseQuizz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponseQuizzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponseQuizz::class);
    }

//    /**
//     * @return ResponseQuizz[] Returns an array of ResponseQuizz objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ResponseQuizz
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
