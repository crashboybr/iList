<?php

namespace iList\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity
 */
class Product
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer")
     */
    private $categoryId;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var integer
     *
     * @ORM\Column(name="subcategory_id", type="integer")
     */
    private $subcategoryId;

    /**
     * @ORM\ManyToOne(targetEntity="SubCategory", inversedBy="products")
     * @ORM\JoinColumn(name="subcategory_id", referencedColumnName="id")
     */
    protected $subcategory;

    /**
     * @ORM\OneToMany(targetEntity="Ad", mappedBy="product")
     */
    protected $ads;

    /**
     * @ORM\ManyToMany(targetEntity="Size", inversedBy="products")
     * @ORM\JoinTable(name="product_sizes")
     */
    private $sizes;

    /**
     * @ORM\ManyToMany(targetEntity="Color", inversedBy="products")
     * @ORM\JoinTable(name="product_colors")
     */
    private $colors;


    /**
     * @ORM\ManyToMany(targetEntity="Generation", inversedBy="products")
     * @ORM\JoinTable(name="product_generations")
     */
    private $generations;
  

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
     * @return Product
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
     * Set gen
     *
     * @param string $gen
     * @return Product
     */
    public function setGen($gen)
    {
        $this->gen = $gen;
    
        return $this;
    }

    /**
     * Get gen
     *
     * @return string 
     */
    public function getGen()
    {
        return $this->gen;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return Product
     */
    public function setSize($size)
    {
        $this->size = $size;
    
        return $this;
    }

    /**
     * Get size
     *
     * @return string 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Product
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Product
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Product
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    
        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set category
     *
     * @param \iList\BackendBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\iList\BackendBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \iList\BackendBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set subcategoryId
     *
     * @param integer $subcategoryId
     * @return Product
     */
    public function setSubcategoryId($subcategoryId)
    {
        $this->subcategoryId = $subcategoryId;
    
        return $this;
    }

    /**
     * Get subcategoryId
     *
     * @return integer 
     */
    public function getSubcategoryId()
    {
        return $this->subcategoryId;
    }

    /**
     * Set subcategory
     *
     * @param \iList\BackendBundle\Entity\SubCategory $subcategory
     * @return Product
     */
    public function setSubcategory(\iList\BackendBundle\Entity\SubCategory $subcategory = null)
    {
        $this->subcategory = $subcategory;
    
        return $this;
    }

    /**
     * Get subcategory
     *
     * @return \iList\BackendBundle\Entity\SubCategory 
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }

    /**
     * Add ads
     *
     * @param \iList\BackendBundle\Entity\Ad $ads
     * @return Product
     */
    public function addAd(\iList\BackendBundle\Entity\Ad $ads)
    {
        $this->ads[] = $ads;
    
        return $this;
    }

    /**
     * Remove ads
     *
     * @param \iList\BackendBundle\Entity\Ad $ads
     */
    public function removeAd(\iList\BackendBundle\Entity\Ad $ads)
    {
        $this->ads->removeElement($ads);
    }

    /**
     * Get ads
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAds()
    {
        return $this->ads;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add sizes
     *
     * @param \iList\BackendBundle\Entity\Size $sizes
     * @return Product
     */
    public function addSize(\iList\BackendBundle\Entity\Size $sizes)
    {
        $this->sizes[] = $sizes;
    
        return $this;
    }

    /**
     * Remove sizes
     *
     * @param \iList\BackendBundle\Entity\Size $sizes
     */
    public function removeSize(\iList\BackendBundle\Entity\Size $sizes)
    {
        $this->sizes->removeElement($sizes);
    }

    /**
     * Get sizes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSizes()
    {
        return $this->sizes;
    }
    
    

    /**
     * Add colors
     *
     * @param \iList\BackendBundle\Entity\Color $colors
     * @return Product
     */
    public function addColor(\iList\BackendBundle\Entity\Color $colors)
    {
        $this->colors[] = $colors;
    
        return $this;
    }

    /**
     * Remove colors
     *
     * @param \iList\BackendBundle\Entity\Color $colors
     */
    public function removeColor(\iList\BackendBundle\Entity\Color $colors)
    {
        $this->colors->removeElement($colors);
    }

    /**
     * Get colors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getColors()
    {
        return $this->colors;
    }
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ads = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sizes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->colors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->generations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add generations
     *
     * @param \iList\BackendBundle\Entity\Generation $generations
     * @return Product
     */
    public function addGeneration(\iList\BackendBundle\Entity\Generation $generations)
    {
        $this->generations[] = $generations;
    
        return $this;
    }

    /**
     * Remove generations
     *
     * @param \iList\BackendBundle\Entity\Generation $generations
     */
    public function removeGeneration(\iList\BackendBundle\Entity\Generation $generations)
    {
        $this->generations->removeElement($generations);
    }

    /**
     * Get generations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGenerations()
    {
        return $this->generations;
    }
}