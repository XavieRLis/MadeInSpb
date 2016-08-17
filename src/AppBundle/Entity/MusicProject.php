<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="music_projects")
 * @Vich\Uploadable
 */
class MusicProject
{

    const CATEGORY_NONE = 0;
    const CATEGORY_TOP = 1;
    const VOCAL_MEN = 0;
    const VOCAL_WOMEN = 1;
    const VOCAL_BOTH = 2;
    const VOCAL_NONE = 3;
    const STATUS_PUBLISHED = 1;
    const STATUS_UNPUBLISHED = 0;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     * @ORM\Column(type="integer", length=4, nullable=true)
     */
    private $startYear;

    /**
     * @var integer
     * @ORM\Column(type="integer", length=4, nullable=true)
     */
    private $endYear;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var City
     * @ORM\ManyToOne(targetEntity="City", inversedBy="musicProjects")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $category;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $vocal;

    /**
     * @var Language
     * @ORM\ManyToMany(targetEntity="Language", inversedBy="musicProjects")
     * @ORM\JoinTable(name="projects_languages")
     */
    private $languages;

    /**
     * @var MusicType
     * @ORM\ManyToOne(targetEntity="MusicType", inversedBy="musicProjects")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;

    /**
     * @var Style
     * @ORM\ManyToMany(targetEntity="Style", inversedBy="musicProjects")
     * @ORM\JoinTable(name="projects_styles")
     */
    private $style;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $mainImage;

    /**
     * @ORM\OneToMany(targetEntity="Link", mappedBy="musicProject", cascade={"all"}, orphanRemoval=true)
     */
    private $links;

    /**
     * @ORM\OneToMany(
     *     targetEntity="MusicProjectMember",
     *     mappedBy="project",
     *     cascade={"all"},
     *     orphanRemoval=true)
     */
    private $members;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $contactPhone;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="responsibleForProjects")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $responsibleUser;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="updated_by", referencedColumnName="id")
     */
    private $updatedBy;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="musicproject_image", fileNameProperty="mainImage")
     *
     * @var File
     */
    private $imageFile;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->links = new ArrayCollection();
        $this->members = new ArrayCollection();
        $this->style = new ArrayCollection();
        $this->status = self::STATUS_UNPUBLISHED;
        $this->createdAt = new \DateTime();
        $this->languages = new ArrayCollection();
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
     * @return MusicProject
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
     * @return MusicProject
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
     * Set title
     *
     * @param string $title
     *
     * @return MusicProject
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set category
     *
     * @param integer $category
     *
     * @return MusicProject
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return integer
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set vocal
     *
     * @param integer $vocal
     *
     * @return MusicProject
     */
    public function setVocal($vocal)
    {
        $this->vocal = $vocal;

        return $this;
    }

    /**
     * Get vocal
     *
     * @return integer
     */
    public function getVocal()
    {
        return $this->vocal;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return MusicProject
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set mainImage
     *
     * @param string $mainImage
     *
     * @return MusicProject
     */
    public function setMainImage($mainImage)
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    /**
     * Get mainImage
     *
     * @return string
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return MusicProject
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     *
     * @return MusicProject
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return MusicProject
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return MusicProject
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return MusicProject
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set city
     *
     * @param City $city
     *
     * @return MusicProject
     */
    public function setCity(City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set type
     *
     * @param MusicType $type
     *
     * @return MusicProject
     */
    public function setType(MusicType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return MusicType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set style
     *
     * @param Style $style
     *
     * @return MusicProject
     */
    public function setStyle(Style $style = null)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return Style
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Add link
     *
     * @param Link $link
     *
     * @return MusicProject
     */
    public function addLink(Link $link)
    {
        $link->setMusicProject($this);
        $this->links->add($link);

        return $this;
    }

    /**
     * Remove link
     *
     * @param Link $link
     */
    public function removeLink(Link $link)
    {
        $this->links->removeElement($link);
    }

    /**
     * Get links
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Add member
     *
     * @param MusicProjectMember $member
     *
     * @return MusicProject
     */
    public function addMember(MusicProjectMember $member)
    {
        $member->setProject($this);
        $this->members->add($member);

        return $this;
    }

    /**
     * Remove member
     *
     * @param MusicProjectMember $member
     */
    public function removeMember(MusicProjectMember $member)
    {
        $this->members->removeElement($member);
        $member->setProject();
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set responsibleUser
     *
     * @param User $responsibleUser
     *
     * @return MusicProject
     */
    public function setResponsibleUser(User $responsibleUser = null)
    {
        $this->responsibleUser = $responsibleUser;

        return $this;
    }

    /**
     * Get responsibleUser
     *
     * @return User
     */
    public function getResponsibleUser()
    {
        return $this->responsibleUser;
    }

    /**
     * Set updatedBy
     *
     * @param User $updatedBy
     *
     * @return MusicProject
     */
    public function setUpdatedBy(User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Add style
     *
     * @param \AppBundle\Entity\Style $style
     *
     * @return MusicProject
     */
    public function addStyle(Style $style)
    {
        $this->style[] = $style;

        return $this;
    }

    /**
     * Remove style
     *
     * @param \AppBundle\Entity\Style $style
     */
    public function removeStyle(Style $style)
    {
        $this->style->removeElement($style);
    }
    
    public static function getCategories()
    {
        return [
            'без категории' => self::CATEGORY_NONE,
            'ТОП' => self::CATEGORY_TOP
        ];
    }

    public static function getVocals()
    {
        return [
            'мужской' => self::VOCAL_MEN,
            'женский' => self::VOCAL_WOMEN,
            'мужской + женский' => self::VOCAL_BOTH,
            'без вокала' => self::VOCAL_NONE
        ];
    }

    public static function getStatuses()
    {
        return [
            'не опубликован' => self::STATUS_UNPUBLISHED,
            'опубликован' => self::STATUS_PUBLISHED
        ];
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return MusicProject
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Add language
     *
     * @param \AppBundle\Entity\Language $language
     *
     * @return MusicProject
     */
    public function addLanguage(Language $language)
    {
        $this->languages[] = $language;

        return $this;
    }

    /**
     * Remove language
     *
     * @param \AppBundle\Entity\Language $language
     */
    public function removeLanguage(Language $language)
    {
        $this->languages->removeElement($language);
    }

    /**
     * Get languages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    public function getMainContact()
    {
        return $this->members->filter(function ($member) {
           return $member->isContact();
        })->first();
    }
}
