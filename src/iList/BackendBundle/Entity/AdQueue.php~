<?php

namespace iList\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdQueue
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class AdQueue
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
     * @ORM\Column(name="ad_id", type="integer")
     */
    private $adId;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="declined_msg_id", type="integer")
     */
    private $declinedMsgId;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set adId
     *
     * @param integer $adId
     * @return AdQueue
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
     * Set status
     *
     * @param integer $status
     * @return AdQueue
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
     * Set declinedMsgId
     *
     * @param integer $declinedMsgId
     * @return AdQueue
     */
    public function setDeclinedMsgId($declinedMsgId)
    {
        $this->declinedMsgId = $declinedMsgId;
    
        return $this;
    }

    /**
     * Get declinedMsgId
     *
     * @return integer 
     */
    public function getDeclinedMsgId()
    {
        return $this->declinedMsgId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AdQueue
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
     * @return AdQueue
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
}