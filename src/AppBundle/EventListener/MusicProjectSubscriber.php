<?php
// src/AppBundle/EventListener/SearchIndexer.php
namespace AppBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use AppBundle\Entity\MusicProject;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class MusicProjectSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
            'preUpdate',
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->updateEntity($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->updateEntity($args);
    }

    public function updateEntity(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

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
