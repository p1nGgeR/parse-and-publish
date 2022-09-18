<?php

namespace App\Repository;

use App\Entity\ArticleTelegramPublication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArticleTelegramPublication>
 *
 * @method ArticleTelegramPublication|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleTelegramPublication|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleTelegramPublication[]    findAll()
 * @method ArticleTelegramPublication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleTelegramPublicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleTelegramPublication::class);
    }

    public function add(ArticleTelegramPublication $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ArticleTelegramPublication $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
