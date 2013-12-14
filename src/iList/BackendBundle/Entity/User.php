<?php

namespace iList\BackendBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="É necessário preencher o seu nome", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="Nome muito pequeno",
     *     maxMessage="Nome muito longo",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255)
     *     pattern="/^\(\d{2}\)\s{0,1}\d{4,5}-\d{4}$/",
     *     match=true,
     *     message="Telefone Inválido. Formato: (99) 9999-9999"
     * )
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="Nome muito pequeno",
     *     maxMessage="Nome muito longo",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $phone;

    /**
     * @ORM\OneToMany(targetEntity="Ad", mappedBy="user")
     */
    protected $ads;

    /**
     * @ORM\OneToMany(targetEntity="AdMsg", mappedBy="fromUser")
     */
    protected $admsgs;

    public function __construct()
    {
        parent::__construct();

        $this->ads = new ArrayCollection();
        $this->admsgs = new ArrayCollection();
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
     * @return User
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
     * Add ads
     *
     * @param \iList\BackendBundle\Entity\Ad $ads
     * @return User
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
     * Add admsgs
     *
     * @param \iList\BackendBundle\Entity\AdMsg $admsgs
     * @return User
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
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }
}