<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="languages")
 */
class Language
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="MusicProject", mappedBy="language")
     */
    private $musicProjects;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->musicProjects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add musicProject
     *
     * @param \AppBundle\Entity\MusicProject $musicProject
     *
     * @return Language
     */
    public function addMusicProject(\AppBundle\Entity\MusicProject $musicProject)
    {
        $this->musicProjects[] = $musicProject;

        return $this;
    }

    /**
     * Remove musicProject
     *
     * @param \AppBundle\Entity\MusicProject $musicProject
     */
    public function removeMusicProject(\AppBundle\Entity\MusicProject $musicProject)
    {
        $this->musicProjects->removeElement($musicProject);
    }

    /**
     * Get musicProjects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMusicProjects()
    {
        return $this->musicProjects;
    }

    public function __toString()
    {
        return $this->name;
    }
}
