<?php

namespace App\Repository;

use App\Entity\SourceParsingError;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SourceParsingError>
 *
 * @method SourceParsingError|null find($id, $lockMode = null, $lockVersion = null)
 * @method SourceParsingError|null findOneBy(array $criteria, array $orderBy = null)
 * @method SourceParsingError[]    findAll()
 * @method SourceParsingError[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourceParsingErrorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SourceParsingError::class);
    }

    public function add(SourceParsingError $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SourceParsingError $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
