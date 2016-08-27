<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="people")
 */
class Person
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="first_name", type="string", nullable=true)
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(name="last_name", type="string", nullable=true)
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(type ="string")
     */
    private $vkId;

    /**
     * @ORM\OneToMany(targetEntity="MusicProjectMember", mappedBy="person", cascade={"remove"})
     */
    private $memberships;

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
     * Set vkId
     *
     * @param string $vkId
     *
     * @return Person
     */
    public function setVkId($vkId)
    {
        $this->vkId = $vkId;

        return $this;
    }

    /**
     * Get vkId
     *
     * @return string
     */
    public function getVkId()
    {
        return $this->vkId;
    }
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->memberships = new ArrayCollection();
    }

    /**
     * Add membership
     *
     * @param \AppBundle\Entity\MusicProjectMember $membership
     *
     * @return Person
     */
    public function addMembership(MusicProjectMember $membership)
    {
        $this->memberships[] = $membership;

        return $this;
    }

    /**
     * Remove membership
     *
     * @param \AppBundle\Entity\MusicProjectMember $membership
     */
    public function removeMembership(MusicProjectMember $membership)
    {
        $this->memberships->removeElement($membership);
    }

    /**
     * Get memberships
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMemberships()
    {
        return $this->memberships;
    }

    public function __toString()
    {
        return $this->getFullName();
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get fisrstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    public function getFullName()
    {
        return $this->getLastName().' '.$this->getFirstName();
    }
}
