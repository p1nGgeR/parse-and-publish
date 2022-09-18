<?php

namespace App\Repository;

use App\Entity\TelegramPublicationError;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TelegramPublicationError>
 *
 * @method TelegramPublicationError|null find($id, $lockMode = null, $lockVersion = null)
 * @method TelegramPublicationError|null findOneBy(array $criteria, array $orderBy = null)
 * @method TelegramPublicationError[]    findAll()
 * @method TelegramPublicationError[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelegramPublicationErrorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TelegramPublicationError::class);
    }

    public function add(TelegramPublicationError $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TelegramPublicationError $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
