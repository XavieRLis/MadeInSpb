<?php
// src/AppBundle/EventListener/SearchIndexer.php
namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\MusicProject;

class MusicProjectListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof MusicProject) {
            return;
        }

        foreach ($entity->getLinks() as $link) {
            $entity->removeLink($link);
            $link->setMusicProject($entity);
            $entity->addLink($link);
        }
    }
}
