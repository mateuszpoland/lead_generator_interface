<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Lead;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class LeadRepository extends ServiceEntityRepository implements LeadRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, Lead::class);
    }
}