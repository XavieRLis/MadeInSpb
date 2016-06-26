<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="people_roles")
 */
class PersonRole
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="MusicProjectMember", mappedBy="role")
     */
    private $people;


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
     * @param string $title
     *
     * @return PersonRole
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->people = new ArrayCollection();
    }

    /**
     * Add person
     *
     * @param Person $person
     *
     * @return PersonRole
     */
    public function addPerson(Person $person)
    {
        $this->people[] = $person;

        return $this;
    }

    /**
     * Remove Person
     *
     * @param Person $person
     */
    public function removePerson(Person $person)
    {
        $this->people->removeElement($person);
    }

    /**
     * Get Person
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerson()
    {
        return $this->people;
    }
    
    public function __toString()
    {
        return $this->title;
    }

    /**
     * Get people
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeople()
    {
        return $this->people;
    }
}
