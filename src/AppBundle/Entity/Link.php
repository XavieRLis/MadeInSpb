<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="links")
 */
class Link
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
    private $url;

    /**
     * @var LinkType
     * @ORM\ManyToOne(targetEntity="LinkType", inversedBy="links")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;

    /**
     * @var MusicProject
     * @ORM\ManyToOne(targetEntity="MusicProject", inversedBy="links", cascade={"persist"})
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $musicProject;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $mainResource;


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
     * Set url
     *
     * @param string $url
     *
     * @return Link
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\LinkType $type
     *
     * @return Link
     */
    public function setType(\AppBundle\Entity\LinkType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\LinkType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set musicProject
     *
     * @param \AppBundle\Entity\MusicProject $musicProject
     *
     * @return Link
     */
    public function setMusicProject(\AppBundle\Entity\MusicProject $musicProject = null)
    {
        $this->musicProject = $musicProject;

        return $this;
    }

    /**
     * Get musicProject
     *
     * @return \AppBundle\Entity\MusicProject
     */
    public function getMusicProject()
    {
        return $this->musicProject;
    }

    /**
     * @return boolean
     */
    public function isMainResource()
    {
        return $this->mainResource;
    }

    /**
     * @param boolean $mainResource
     * @return Link
     */
    public function setMainResource($mainResource)
    {
        $this->mainResource = $mainResource;
        return $this;
    }
}
