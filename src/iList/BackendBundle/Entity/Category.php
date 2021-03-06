<?php

namespace iList\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
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
     * @ORM\OneToMany(targetEntity="SubCategory", mappedBy="category")
     */
    protected $subcategories;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    protected $products;

    /**
     * @ORM\ManyToMany(targetEntity="Size", inversedBy="categories")
     * @ORM\JoinTable(name="category_sizes")
     */
    private $sizes;

    /**
     * @ORM\ManyToMany(targetEntity="Color", inversedBy="categories")
     * @ORM\JoinTable(name="category_colors")
     */
    private $colors;

    /**
     * @ORM\ManyToMany(targetEntity="Processor", inversedBy="categories")
     * @ORM\JoinTable(name="category_processors")
     */
    private $processors;

    /**
     * @ORM\ManyToMany(targetEntity="ScreenSize", inversedBy="categories")
     * @ORM\JoinTable(name="category_screens")
     */
    private $screens;

    /**
     * @ORM\ManyToMany(targetEntity="MemoryRam", inversedBy="categories")
     * @ORM\JoinTable(name="category_memories")
     */
    private $memories;

     /**
     * @ORM\OneToMany(targetEntity="Ad", mappedBy="category")
     */
    protected $ads;

    public function __construct()
    {
        $this->subcategories = new ArrayCollection();
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
     * @return Category
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
     * @return Category
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
     * Add subcategories
     *
     * @param \iList\BackendBundle\Entity\SubCategory $subcategories
     * @return Category
     */
    public function addSubcategorie(\iList\BackendBundle\Entity\SubCategory $subcategories)
    {
        $this->subcategories[] = $subcategories;
    
        return $this;
    }

    /**
     * Remove subcategories
     *
     * @param \iList\BackendBundle\Entity\SubCategory $subcategories
     */
    public function removeSubcategorie(\iList\BackendBundle\Entity\SubCategory $subcategories)
    {
        $this->subcategories->removeElement($subcategories);
    }

    /**
     * Get subcategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add products
     *
     * @param \iList\BackendBundle\Entity\Product $products
     * @return Category
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
     * @return Category
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

    /**
     * Add sizes
     *
     * @param \iList\BackendBundle\Entity\Size $sizes
     * @return Category
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
     * @return Category
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
     * Add processors
     *
     * @param \iList\BackendBundle\Entity\Processor $processors
     * @return Category
     */
    public function addProcessor(\iList\BackendBundle\Entity\Processor $processors)
    {
        $this->processors[] = $processors;
    
        return $this;
    }

    /**
     * Remove processors
     *
     * @param \iList\BackendBundle\Entity\Processor $processors
     */
    public function removeProcessor(\iList\BackendBundle\Entity\Processor $processors)
    {
        $this->processors->removeElement($processors);
    }

    /**
     * Get processors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProcessors()
    {
        return $this->processors;
    }

    /**
     * Add screens
     *
     * @param \iList\BackendBundle\Entity\ScreenSize $screens
     * @return Category
     */
    public function addScreen(\iList\BackendBundle\Entity\ScreenSize $screens)
    {
        $this->screens[] = $screens;
    
        return $this;
    }

    /**
     * Remove screens
     *
     * @param \iList\BackendBundle\Entity\ScreenSize $screens
     */
    public function removeScreen(\iList\BackendBundle\Entity\ScreenSize $screens)
    {
        $this->screens->removeElement($screens);
    }

    /**
     * Get screens
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getScreens()
    {
        return $this->screens;
    }

    /**
     * Add memories
     *
     * @param \iList\BackendBundle\Entity\MemoryRam $memories
     * @return Category
     */
    public function addMemorie(\iList\BackendBundle\Entity\MemoryRam $memories)
    {
        $this->memories[] = $memories;
    
        return $this;
    }

    /**
     * Remove memories
     *
     * @param \iList\BackendBundle\Entity\MemoryRam $memories
     */
    public function removeMemorie(\iList\BackendBundle\Entity\MemoryRam $memories)
    {
        $this->memories->removeElement($memories);
    }

    /**
     * Get memories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMemories()
    {
        return $this->memories;
    }
}