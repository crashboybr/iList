<?php

namespace iList\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubCategory
 *
 * @ORM\Table(name="subcategory")
 * @ORM\Entity
 */
class SubCategory
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
     * @ORM\Column(name="name", type="string", length=100)
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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="subcategories")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;


    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    protected $products;

    /**
     * @ORM\OneToMany(targetEntity="Ad", mappedBy="subcategory")
     */
    protected $ads;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->ads = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return SubCategory
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return SubCategory
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
     * @return SubCategory
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
     * @return SubCategory
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

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add products
     *
     * @param \iList\BackendBundle\Entity\Product $products
     * @return SubCategory
     */
    public function addProduct(\iList\BackendBundle\Entity\Product $products)
    {
        $this->products[] = $products;
    
        return $this;
    }

    /**
     * Remove products
     *
     * @param \iList\BackendBundle\Entity\Product $products
     */
    public function removeProduct(\iList\BackendBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Add ads
     *
     * @param \iList\BackendBundle\Entity\Ad $ads
     * @return SubCategory
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
}