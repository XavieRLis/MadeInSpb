<?php
namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="MusicProject", mappedBy="responsibleUser")
     */
    private $responsibleForProjects;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Add responsibleForProject
     *
     * @param \AppBundle\Entity\MusicProject $responsibleForProject
     *
     * @return User
     */
    public function addResponsibleForProject(\AppBundle\Entity\MusicProject $responsibleForProject)
    {
        $this->responsibleForProjects[] = $responsibleForProject;

        return $this;
    }

    /**
     * Remove responsibleForProject
     *
     * @param \AppBundle\Entity\MusicProject $responsibleForProject
     */
    public function removeResponsibleForProject(\AppBundle\Entity\MusicProject $responsibleForProject)
    {
        $this->responsibleForProjects->removeElement($responsibleForProject);
    }

    /**
     * Get responsibleForProjects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponsibleForProjects()
    {
        return $this->responsibleForProjects;
    }
}
