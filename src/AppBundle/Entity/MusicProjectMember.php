<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mp_members")
 */
class MusicProjectMember
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Person
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="memberships")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    private $person;

    /**
     * @var PersonRole
     * @ORM\ManyToOne(targetEntity="PersonRole", inversedBy="people")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    private $role;

    /**
     * @var integer
     * @ORM\Column(type="integer", length=4)
     */
    private $startYear;

    /**
     * @var integer
     * @ORM\Column(type="integer", length=4, nullable=true)
     */
    private $endYear;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $contact;

    /**
     * @ORM\ManyToMany(targetEntity="MusicProject", mappedBy="members")
     */
    private $projects;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set startYear
     *
     * @param integer $startYear
     *
     * @return MusicProjectMember
     */
    public function setStartYear($startYear)
    {
        $this->startYear = $startYear;

        return $this;
    }

    /**
     * Get startYear
     *
     * @return integer
     */
    public function getStartYear()
    {
        return $this->startYear;
    }

    /**
     * Set endYear
     *
     * @param integer $endYear
     *
     * @return MusicProjectMember
     */
    public function setEndYear($endYear)
    {
        $this->endYear = $endYear;

        return $this;
    }

    /**
     * Get endYear
     *
     * @return integer
     */
    public function getEndYear()
    {
        return $this->endYear;
    }

    /**
     * Set contact
     *
     * @param boolean $contact
     *
     * @return MusicProjectMember
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return boolean
     */
    public function isContact()
    {
        return $this->contact;
    }

    /**
     * Set person
     *
     * @param \AppBundle\Entity\Person $person
     *
     * @return MusicProjectMember
     */
    public function setPerson(\AppBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \AppBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set role
     *
     * @param \AppBundle\Entity\PersonRole $role
     *
     * @return MusicProjectMember
     */
    public function setRole(\AppBundle\Entity\PersonRole $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \AppBundle\Entity\PersonRole
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add project
     *
     * @param \AppBundle\Entity\MusicProject $project
     *
     * @return MusicProjectMember
     */
    public function addProject(\AppBundle\Entity\MusicProject $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \AppBundle\Entity\MusicProject $project
     */
    public function removeProject(\AppBundle\Entity\MusicProject $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Get contact
     *
     * @return boolean
     */
    public function getContact()
    {
        return $this->contact;
    }
}