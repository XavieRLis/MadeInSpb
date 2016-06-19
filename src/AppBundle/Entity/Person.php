<?php
namespace AppBundle\Entity;

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
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type ="string")
     */
    private $vkId;

    /**
     * @var PersonRole
     * @ORM\ManyToOne(targetEntity="PersonRole", inversedBy="Person")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $role;

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
     * Set role
     *
     * @param \AppBundle\Entity\PersonRole $role
     *
     * @return Person
     */
    public function setRole(PersonRole $role = null)
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
}
