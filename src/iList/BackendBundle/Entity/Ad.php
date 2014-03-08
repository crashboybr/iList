<?php

namespace iList\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Ad
 *
 * @ORM\Table(name="ads")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="iList\BackendBundle\Entity\AdRepository")
 */
class Ad
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
     * @var integer
     *
     * @ORM\Column(name="ad_type", type="integer")
     */
    private $adType;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="ads")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer")
     */
    private $categoryId;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="ads")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var integer
     *
     * @ORM\Column(name="subcategory_id", type="integer", nullable=true)
     */
    private $subcategoryId;

    /**
     * @ORM\ManyToOne(targetEntity="SubCategory", inversedBy="ads")
     * @ORM\JoinColumn(name="subcategory_id", referencedColumnName="id", nullable=true)
     */
    protected $subcategory;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer", nullable=true)
     */
    private $productId;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="ads")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=true)
     */
    protected $product;

    /**
     * @var integer
     *
     * @ORM\Column(name="size_id", type="integer", nullable=true)
     */
    private $sizeId;

    /**
     * @ORM\ManyToOne(targetEntity="Size", inversedBy="ads")
     * @ORM\JoinColumn(name="size_id", referencedColumnName="id", nullable=true)
     */
    protected $size;

    /**
     * @var integer
     *
     * @ORM\Column(name="color_id", type="integer", nullable=true)
     */
    private $colorId;

    /**
     * @ORM\ManyToOne(targetEntity="Color", inversedBy="ads")
     * @ORM\JoinColumn(name="color_id", referencedColumnName="id", nullable=true)
     */
    protected $color;


    /**
     * @var integer
     *
     * @ORM\Column(name="screen_id", type="integer", nullable=true)
     */
    private $screenId;

    /**
     * @ORM\ManyToOne(targetEntity="ScreenSize", inversedBy="ads")
     * @ORM\JoinColumn(name="screen_id", referencedColumnName="id", nullable=true)
     */
    protected $screen;


    /**
     * @var integer
     *
     * @ORM\Column(name="processor_id", type="integer", nullable=true)
     */
    private $processorId;

    /**
     * @ORM\ManyToOne(targetEntity="Processor", inversedBy="ads")
     * @ORM\JoinColumn(name="processor_id", referencedColumnName="id", nullable=true)
     */
    protected $processor;

    /**
     * @var integer
     *
     * @ORM\Column(name="memory_id", type="integer", nullable=true)
     */
    private $memoryId;

    /**
     * @ORM\ManyToOne(targetEntity="MemoryRam", inversedBy="ads")
     * @ORM\JoinColumn(name="memory_id", referencedColumnName="id", nullable=true)
     */
    protected $memory;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=30)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=30)
     */
    private $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="neighbourhood", type="string", length=255)
     */
    private $neighbourhood;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="complement", type="string", length=255, nullable=true)
     */
    private $complement;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_type", type="integer", nullable=true)
     */
    private $productType;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="default_img", type="string", length=255)
     */
    private $default_img;

    /**
     * @ORM\OneToMany(targetEntity="AdImage", mappedBy="ads", cascade={"ALL"})
     */
    protected $ad_images;

    /**
     * @ORM\OneToMany(targetEntity="AdMsg", mappedBy="ad")
     */
    protected $admsgs;

    /**
     * @ORM\OneToMany(targetEntity="DeclinedAds", mappedBy="ad")
     */
    protected $declinedAds;

    public function __construct()
    {
        $this->ad_images = new ArrayCollection();
        $this->admsgs = new ArrayCollection();
        $this->declinedAds = new ArrayCollection();
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
     * Set userId
     *
     * @param integer $userId
     * @return Ad
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Ad
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
     * Set subcategoryId
     *
     * @param integer $subcategoryId
     * @return Ad
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
     * Set productId
     *
     * @param integer $productId
     * @return Ad
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    
        return $this;
    }

    /**
     * Get productId
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return Ad
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
     * @return Ad
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
     * Set title
     *
     * @param string $title
     * @return Ad
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
     * Set content
     *
     * @param string $content
     * @return Ad
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Ad
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Ad
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Ad
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return Ad
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    
        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Ad
     */
    public function setStreet($street)
    {
        $this->street = $street;
    
        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set complement
     *
     * @param string $complement
     * @return Ad
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
    
        return $this;
    }

    /**
     * Get complement
     *
     * @return string 
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Ad
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
     * @return Ad
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
     * @return Ad
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
     * Set slug
     *
     * @param string $slug
     * @return Ad
     */
    public function setSlug($slug)
    {
        global $kernel;

        if ('AppCache' == get_class($kernel)) {
            $kernel = $kernel->getKernel();
        }

        $service = $kernel->getContainer()->get('slug.helper');
        $this->slug = $service->modifySlug($slug);

        return $this;
    }


    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set user
     *
     * @param \iList\BackendBundle\Entity\User $user
     * @return Ad
     */
    public function setUser(\iList\BackendBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \iList\BackendBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set category
     *
     * @param \iList\BackendBundle\Entity\Category $category
     * @return Ad
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
     * Set subcategory
     *
     * @param \iList\BackendBundle\Entity\SubCategory $subcategory
     * @return Ad
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
     * Set product
     *
     * @param \iList\BackendBundle\Entity\Product $product
     * @return Ad
     */
    public function setProduct(\iList\BackendBundle\Entity\Product $product = null)
    {
        $this->product = $product;
    
        return $this;
    }

    /**
     * Get product
     *
     * @return \iList\BackendBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set adType
     *
     * @param integer $adType
     * @return Ad
     */
    public function setAdType($adType)
    {
        $this->adType = $adType;
    
        return $this;
    }

    /**
     * Get adType
     *
     * @return integer 
     */
    public function getAdType()
    {
        return $this->adType;
    }

    /**
     * Set productType
     *
     * @param integer $productType
     * @return Ad
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;
    
        return $this;
    }

    /**
     * Get productType
     *
     * @return integer 
     */
    public function getProductType()
    {
        if ($this->productType == 1) return "Novo"; 
        else return "Usado";
        //return $this->productType;
    }


    /**
     * Now we tell doctrine that before we persist or update we call the updatedTimestamps() function.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime(date('Y-m-d H:i:s')));

        if($this->getCreatedAt() == null)
        {
            $this->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
        }
    }

    /**
     *
     * @ORM\PostPersist
     * @ORM\PostUpdate
     */
    public function modifySlug()
    {
        $this->setSlug($this->slug . '-' . $this->id);
        
    }




    /**
     * Add ad_images
     *
     * @param \iList\BackendBundle\Entity\AdImage $adImages
     * @return Ad
     */
    public function addAdImage(\iList\BackendBundle\Entity\AdImage $adImages)
    {
        $this->ad_images[] = $adImages;

        $adImages->setAd($this);
        //var_dump($adImages);exit;
    
        return $this;
    }

    /**
     * Remove ad_images
     *
     * @param \iList\BackendBundle\Entity\AdImage $adImages
     */
    public function removeAdImage(\iList\BackendBundle\Entity\AdImage $adImages)
    {
        $this->ad_images->removeElement($adImages);
    }

    /**
     * Get ad_images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdImages()
    {
        return $this->ad_images;
    }

    /**
     * Set neighbourhood
     *
     * @param string $neighbourhood
     * @return Ad
     */
    public function setNeighbourhood($neighbourhood)
    {
        $this->neighbourhood = $neighbourhood;
    
        return $this;
    }

    /**
     * Get neighbourhood
     *
     * @return string 
     */
    public function getNeighbourhood()
    {
        return $this->neighbourhood;
    }

    /**
     * Add admsgs
     *
     * @param \iList\BackendBundle\Entity\AdMsg $admsgs
     * @return Ad
     */
    public function addAdmsg(\iList\BackendBundle\Entity\AdMsg $admsgs)
    {
        $this->admsgs[] = $admsgs;
    
        return $this;
    }

    /**
     * Remove admsgs
     *
     * @param \iList\BackendBundle\Entity\AdMsg $admsgs
     */
    public function removeAdmsg(\iList\BackendBundle\Entity\AdMsg $admsgs)
    {
        $this->admsgs->removeElement($admsgs);
    }

    /**
     * Get admsgs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdmsgs()
    {
        return $this->admsgs;
    }

    /**
     * Set default_img
     *
     * @param string $defaultImg
     * @return Ad
     */
    public function setDefaultImg($defaultImg)
    {
        $this->default_img = $defaultImg;
    
        return $this;
    }

    /**
     * Get default_img
     *
     * @return string 
     */
    public function getDefaultImg()
    {
        return $this->default_img;
    }

    /**
     * Set sizeId
     *
     * @param integer $sizeId
     * @return Ad
     */
    public function setSizeId($sizeId)
    {
        $this->sizeId = $sizeId;
    
        return $this;
    }

    /**
     * Get sizeId
     *
     * @return integer 
     */
    public function getSizeId()
    {
        return $this->sizeId;
    }

    /**
     * Set colorId
     *
     * @param integer $colorId
     * @return Ad
     */
    public function setColorId($colorId)
    {
        $this->colorId = $colorId;
    
        return $this;
    }

    /**
     * Get colorId
     *
     * @return integer 
     */
    public function getColorId()
    {
        return $this->colorId;
    }

    /**
     * Add declinedAds
     *
     * @param \iList\BackendBundle\Entity\DeclinedAds $declinedAds
     * @return Ad
     */
    public function addDeclinedAd(\iList\BackendBundle\Entity\DeclinedAds $declinedAds)
    {
        $this->declinedAds[] = $declinedAds;
    
        return $this;
    }

    /**
     * Remove declinedAds
     *
     * @param \iList\BackendBundle\Entity\DeclinedAds $declinedAds
     */
    public function removeDeclinedAd(\iList\BackendBundle\Entity\DeclinedAds $declinedAds)
    {
        $this->declinedAds->removeElement($declinedAds);
    }

    /**
     * Get declinedAds
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDeclinedAds()
    {
        return $this->declinedAds;
    }

    /**
     * Set screenId
     *
     * @param integer $screenId
     * @return Ad
     */
    public function setScreenId($screenId)
    {
        $this->screenId = $screenId;
    
        return $this;
    }

    /**
     * Get screenId
     *
     * @return integer 
     */
    public function getScreenId()
    {
        return $this->screenId;
    }

    /**
     * Set screen
     *
     * @param \iList\BackendBundle\Entity\ScreenSize $screen
     * @return Ad
     */
    public function setScreen(\iList\BackendBundle\Entity\ScreenSize $screen = null)
    {
        $this->screen = $screen;
    
        return $this;
    }

    /**
     * Get screen
     *
     * @return \iList\BackendBundle\Entity\ScreenSize 
     */
    public function getScreen()
    {
        return $this->screen;
    }

    /**
     * Set processorId
     *
     * @param integer $processorId
     * @return Ad
     */
    public function setProcessorId($processorId)
    {
        $this->processorId = $processorId;
    
        return $this;
    }

    /**
     * Get processorId
     *
     * @return integer 
     */
    public function getProcessorId()
    {
        return $this->processorId;
    }

    /**
     * Set memoryId
     *
     * @param integer $memoryId
     * @return Ad
     */
    public function setMemoryId($memoryId)
    {
        $this->memoryId = $memoryId;
    
        return $this;
    }

    /**
     * Get memoryId
     *
     * @return integer 
     */
    public function getMemoryId()
    {
        return $this->memoryId;
    }

    /**
     * Set processor
     *
     * @param \iList\BackendBundle\Entity\Processor $processor
     * @return Ad
     */
    public function setProcessor(\iList\BackendBundle\Entity\Processor $processor = null)
    {
        $this->processor = $processor;
    
        return $this;
    }

    /**
     * Get processor
     *
     * @return \iList\BackendBundle\Entity\Processor 
     */
    public function getProcessor()
    {
        return $this->processor;
    }

    /**
     * Set memory
     *
     * @param \iList\BackendBundle\Entity\MemoryRam $memory
     * @return Ad
     */
    public function setMemory(\iList\BackendBundle\Entity\MemoryRam $memory = null)
    {
        $this->memory = $memory;
    
        return $this;
    }

    /**
     * Get memory
     *
     * @return \iList\BackendBundle\Entity\MemoryRam 
     */
    public function getMemory()
    {
        return $this->memory;
    }
}