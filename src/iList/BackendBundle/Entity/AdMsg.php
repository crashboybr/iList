<?php

namespace iList\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * AdMsg
 *
 * @ORM\Table("ad_msgs")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class AdMsg
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank(
     *      message = "Digite sua mensagem!"
     *)
     * @Assert\Length(
     *      min = "5",
     *      max = "800",
     *      minMessage = "Mínimo de {{ limit }} caracteres",
     *      maxMessage = "Máximo de {{ limit }} caracteres"
     * )
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     * @Assert\NotBlank(
     *      message = "Digite seu nome!"
     *)
     * @Assert\Length(
     *      min = "2",
     *      max = "30",
     *      minMessage = "Mínimo de {{ limit }} caracteres",
     *      maxMessage = "Máximo de {{ limit }} caracteres"
     * )
     * @Assert\Regex(
     *     pattern="/^[A-Za-zçÇãõÃÕáéíóúÁÉÍÓÚâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ]+$/",
     *     match=true,
     *     message="Seu nome só pode conter letras"
     * )
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank(
     *      message = "Digite seu email!"
     *)
     * @Assert\Email(
     *     message = "O email '{{ value }}' é inválido",
     *     checkMX = true
     * )
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\(\d{2}\)\s{0,1}\d{4,5}-\d{4}$/",
     *     match=true,
     *     message="Telefone Inválido. Formato: (99) 9999-9999"
     * )
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var integer
     *
     * @ORM\Column(name="from_user_id", type="integer", nullable=true)
     */
    private $fromUserId;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="admsgs")
     * @ORM\JoinColumn(name="from_user_id", referencedColumnName="id")
     */
    protected $fromUser;

    /**
     * @var string
     *
     * @ORM\Column(name="to_user", type="integer", nullable=true)
     */
    private $toUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

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
     * @var integer
     *
     * @ORM\Column(name="ad_id", type="integer")
     */
    private $adId;

    /**
     * @ORM\ManyToOne(targetEntity="Ad", inversedBy="admsgs")
     * @ORM\JoinColumn(name="ad_id", referencedColumnName="id")
     */
    protected $ad;


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
     * Set title
     *
     * @param string $title
     * @return AdMsg
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
     * @return AdMsg
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
     * Set name
     *
     * @param string $name
     * @return AdMsg
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
     * Set email
     *
     * @param string $email
     * @return AdMsg
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
     * Set phone
     *
     * @param string $phone
     * @return AdMsg
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
     * Set fromUser
     *
     * @param integer $fromUser
     * @return AdMsg
     */
    public function setFromUser($fromUser)
    {
        $this->fromUser = $fromUser;
    
        return $this;
    }

    /**
     * Get fromUser
     *
     * @return integer 
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * Set toUser
     *
     * @param string $toUser
     * @return AdMsg
     */
    public function setToUser($toUser)
    {
        $this->toUser = $toUser;
    
        return $this;
    }

    /**
     * Get toUser
     *
     * @return string 
     */
    public function getToUser()
    {
        return $this->toUser;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return AdMsg
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
     * @return AdMsg
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
     * @return AdMsg
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
     * Set adId
     *
     * @param integer $adId
     * @return AdMsg
     */
    public function setAdId($adId)
    {
        $this->adId = $adId;
    
        return $this;
    }

    /**
     * Get adId
     *
     * @return integer 
     */
    public function getAdId()
    {
        return $this->adId;
    }

    /**
     * Set ad
     *
     * @param \iList\BackendBundle\Entity\Ad $ad
     * @return AdMsg
     */
    public function setAd(\iList\BackendBundle\Entity\Ad $ad = null)
    {
        $this->ad = $ad;
    
        return $this;
    }

    /**
     * Get ad
     *
     * @return \iList\BackendBundle\Entity\Ad 
     */
    public function getAd()
    {
        return $this->ad;
    }

    /**
     * Set fromUserId
     *
     * @param integer $fromUserId
     * @return AdMsg
     */
    public function setFromUserId($fromUserId)
    {
        $this->fromUserId = $fromUserId;
    
        return $this;
    }

    /**
     * Get fromUserId
     *
     * @return integer 
     */
    public function getFromUserId()
    {
        return $this->fromUserId;
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
}