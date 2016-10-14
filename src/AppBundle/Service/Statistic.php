<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

class Statistic
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getSummaryProjectCount()
    {
        $repo = $this->entityManager->getRepository('AppBundle:MusicProject');
        return $repo->getMusicProjectCount();
    }

    public function getPublishedPercent()
    {
        $repo = $this->entityManager->getRepository('AppBundle:MusicProject');
        $summary = $this->getSummaryProjectCount();
        $published = $repo->getPublishedMusicProjectCount();
        return round(($published*100)/$summary);
    }

    public function getSummaryPerson()
    {
        $repo = $this->entityManager->getRepository('AppBundle:Person');
        return count($repo->findAll());
    }
}
