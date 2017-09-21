<?php
//dev branch
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="products")
 * @ORM\Entity()
 */
class Product implements \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(name="description", length=1000, type="text", options={"default" : NULL})
     */
    private $description;

    /**
     * @ORM\Column(name="date_was_created", type="datetimetz", options={"default" : NULL})
     * @Assert\DateTime()
     */
    private $dateWasCreated;

    /**
     * @ORM\Column(name="date_last_change", type="datetimetz")
     * @Assert\DateTime()
     */
    private $dateLastChange;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     * @Assert\NotBlank()
     */
    private $isActive;

    /**
     * @ORM\Column(name="unique_identifier", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $uniqueIdentifier;

    /**
     * One Product has Many Attributes.
     * @ORM\OneToMany(targetEntity="Attribute", mappedBy="product")
     */
    private $attributes;

    /**
     * Many Products have One Category.
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * One Product has Many Products.
     * @ORM\OneToMany(targetEntity="Product", mappedBy="parent")
     */
    private $children;

    /**
     * Many Products have One Product.
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDateWasCreated()
    {
        return $this->dateWasCreated;
    }

    /**
     * @return mixed
     */
    public function getDateLastChange()
    {
        return $this->dateLastChange;
    }

    /**
     * @param mixed $dateLastChange
     */
    public function setDateLastChange($dateLastChange)
    {
        $this->dateLastChange = $dateLastChange;
    }

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $dateWasCreated
     */
    public function setDateWasCreated($dateWasCreated)
    {
        $this->dateWasCreated = $dateWasCreated;
    }

    /**
     * @param mixed $uniqueIdentifier
     */
    public function setUniqueIdentifier($uniqueIdentifier)
    {
        $this->uniqueIdentifier = $uniqueIdentifier;
    }


    /**
     * @return mixed
     */
    public function getUniqueIdentifier()
    {
        return $this->uniqueIdentifier;
    }

    public function __construct() {
        //$this->dateWasCreated = date('H:i:s \O\n d/m/Y');
        $this->dateWasCreated = new \DateTime();
        $this->attributes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->name,
            $this->isActive
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,
            $this->isActive
            ) = unserialize($serialized);
    }
}
