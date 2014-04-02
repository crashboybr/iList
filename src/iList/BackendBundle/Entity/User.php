<?php

namespace iList\BackendBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @UniqueEntity(fields="email", message="Este email já está sendo utilizado.")
 * @UniqueEntity(fields="cpf", message="Este CPF já está sendo utilizado.")
 * @UniqueEntity(fields="username", message="Este usuário já está sendo utilizado.")
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
     * @Assert\NotBlank(message="É necessário preencher o seu nome")
     * @Assert\Length(
     *     min=3,
     *     max="30",
     *     minMessage="Nome muito pequeno",
     *     maxMessage="Nome muito longo"
     *     
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Caracteres inválidos"
     * )
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *    
     * @Assert\Regex(
     *     pattern="/^\(\d{2}\)\s{0,1}\d{4,5}-\d{4}$/",
     *     match=true,
     *     message="Telefone Inválido. Formato: (99) 9999-9999"
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
    protected $sent_admsgs;

    /**
     * @ORM\OneToMany(targetEntity="AdMsg", mappedBy="toUser")
     */
    protected $my_admsgs;

    /* facebook */

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
     */
    protected $state;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    protected $street;

    /**
     * @var string
     *
     * @ORM\Column(name="complement", type="string", length=255, nullable=true)
     */
    protected $complement;

    /**
     * @var string
     *
     * @ORM\Column(name="neighbourhood", type="string", length=255, nullable=true)
     */
    private $neighbourhood;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=255, nullable=true)
     *
     * @Assert\Regex(
     *     pattern="/(^\d{3}\.\d{3}\.\d{3}\-\d{2}$)|(^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$)/",
     *     match=true,
     *     message="Formato Inválido. CPF: 111.111.111-11"
     * )
     */
    protected $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=255, nullable=true)
     */
    protected $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="facebookId", type="string", length=255, nullable=true)
     */
    protected $facebookId;

    public function serialize()
    {
        return serialize(array($this->facebookId, parent::serialize()));
    }

    public function unserialize($data)
    {
        list($this->facebookId, $parentData) = unserialize($data);
        parent::unserialize($parentData);
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get the full name of the user (first + last name)
     * @return string
     */
    public function getFullName()
    {
        return $this->getFirstname() . ' ' . $this->getLastname();
    }

    /**
     * @param string $facebookId
     * @return void
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        $this->setUsername($facebookId);
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param Array
     */
    public function setFBData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setFacebookId($fbdata['id']);
            $this->addRole('ROLE_FACEBOOK');
        }
        if (isset($fbdata['first_name'])) {
            $this->setFirstname($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setLastname($fbdata['last_name']);
        }
        if (isset($fbdata['email'])) {
            $this->setEmail($fbdata['email']);
        }
    }

    /* end facebook */
    public function __construct()
    {
        parent::__construct();

        $this->ads = new ArrayCollection();
        $this->sent_admsgs = new ArrayCollection();
        $this->my_admsgs = new ArrayCollection();
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

    /**
     * Add sent_admsgs
     *
     * @param \iList\BackendBundle\Entity\AdMsg $sentAdmsgs
     * @return User
     */
    public function addSentAdmsg(\iList\BackendBundle\Entity\AdMsg $sentAdmsgs)
    {
        $this->sent_admsgs[] = $sentAdmsgs;
    
        return $this;
    }

    /**
     * Remove sent_admsgs
     *
     * @param \iList\BackendBundle\Entity\AdMsg $sentAdmsgs
     */
    public function removeSentAdmsg(\iList\BackendBundle\Entity\AdMsg $sentAdmsgs)
    {
        $this->sent_admsgs->removeElement($sentAdmsgs);
    }

    /**
     * Get sent_admsgs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSentAdmsgs()
    {
        return $this->sent_admsgs;
    }

    /**
     * Add my_admsgs
     *
     * @param \iList\BackendBundle\Entity\AdMsg $myAdmsgs
     * @return User
     */
    public function addMyAdmsg(\iList\BackendBundle\Entity\AdMsg $myAdmsgs)
    {
        $this->my_admsgs[] = $myAdmsgs;
    
        return $this;
    }

    /**
     * Remove my_admsgs
     *
     * @param \iList\BackendBundle\Entity\AdMsg $myAdmsgs
     */
    public function removeMyAdmsg(\iList\BackendBundle\Entity\AdMsg $myAdmsgs)
    {
        $this->my_admsgs->removeElement($myAdmsgs);
    }

    /**
     * Get my_admsgs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyAdmsgs()
    {
        return $this->my_admsgs;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return User
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
     * @return User
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
     * @return User
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
     * Set cpf
     *
     * @param string $cpf
     * @return User
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    
        return $this;
    }

    /**
     * Get cpf
     *
     * @return string 
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return User
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
     * @return User
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
     * Set neighbourhood
     *
     * @param string $neighbourhood
     * @return User
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
}