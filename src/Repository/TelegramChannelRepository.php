<?php

namespace App\Repository;

use App\Entity\TelegramChannel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TelegramChannel>
 *
 * @method TelegramChannel|null find($id, $lockMode = null, $lockVersion = null)
 * @method TelegramChannel|null findOneBy(array $criteria, array $orderBy = null)
 * @method TelegramChannel[]    findAll()
 * @method TelegramChannel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelegramChannelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TelegramChannel::class);
    }

    public function add(TelegramChannel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TelegramChannel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
