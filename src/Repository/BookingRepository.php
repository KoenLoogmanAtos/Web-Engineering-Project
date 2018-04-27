<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    public function findByDate($date, $dummy = false)
    {
        return $this->findByDateRange($date, $date, $dummy);
    }

    public function findByDateRange($from, $to, $dummy = false)
    {
        $result = $this->createQueryBuilder('b')
            ->innerJoin('b.bookingType', 'bt')
            ->where('b.depature >= :from AND b.arrival <= :to');

        if (!$dummy) {
            $result->andWhere('bt.dummy = 0');
        }

        return $result->setParameter('from', $from)
            ->setParameter('to', $to)
            ->orderBy('b.arrival', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('b')
            ->where('b.something = :value')->setParameter('value', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
