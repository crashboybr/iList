<?php

namespace iList\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeclinedMsg
 *
 * @ORM\Table(name="declined_msgs")
 * @ORM\Entity
 */
class DeclinedMsg
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
     * @ORM\Column(name="msg", type="string", length=255)
     */
    private $msg;

    /**
     * @ORM\OneToMany(targetEntity="DeclinedAds", mappedBy="declinedMsg")
     */
    protected $declinedAds;


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
     * Set msg
     *
     * @param string $msg
     * @return DeclinedMsg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    
        return $this;
    }

    /**
     * Get msg
     *
     * @return string 
     */
    public function getMsg()
    {
        return $this->msg;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->declinedAds = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add declinedAds
     *
     * @param \iList\BackendBundle\Entity\DeclinedAds $declinedAds
     * @return DeclinedMsg
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
}