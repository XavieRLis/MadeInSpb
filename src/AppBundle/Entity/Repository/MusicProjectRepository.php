<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\MusicProject;
use Doctrine\ORM\EntityRepository;

class MusicProjectRepository extends EntityRepository
{
    public function getMusicProjectCount()
    {
        $queryBuilder = $this->createQueryBuilder('mp');
        $queryBuilder->select($queryBuilder->expr()->count('mp.id'));

        $count = $queryBuilder->getQuery()->getSingleScalarResult();
        return $count;
    }

    public function getPublishedMusicProjectCount()
    {
        $queryBuilder = $this->createQueryBuilder('mp');
        $queryBuilder->select($queryBuilder->expr()->count('mp.id'))
        ->where('mp.status = :status')
        ->setParameter('status', MusicProject::STATUS_PUBLISHED);

        $count = $queryBuilder->getQuery()->getSingleScalarResult();
        return $count;
    }
}
