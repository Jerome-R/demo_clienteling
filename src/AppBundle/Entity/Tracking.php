<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Tracking
 *
 * @ORM\Table(name="app_tracking")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TrackingRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Tracking
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Campaign", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    protected $campaign;

    /**
     * @var integer
     *
     * @ORM\Column(name="emails_sent", type="integer")
     */
    private $emailsSent;

    /**
     * @var integer
     *
     * @ORM\Column(name="mails_sent", type="integer")
     */
    private $mailsSent;

    /**
     * @var integer
     *
     * @ORM\Column(name="sms_sent", type="integer")
     */
    private $smsSent;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone_calls", type="integer")
     */
    private $phoneCalls;

    /**
     * @var integer
     *
     * @ORM\Column(name="hard_bounce", type="integer")
     */
    private $hardBounce;

    /**
     * @var integer
     *
     * @ORM\Column(name="soft_bounce", type="integer")
     */
    private $softBounce;

    /**
     * @var integer
     *
     * @ORM\Column(name="opens", type="integer")
     */
    private $opens;

    /**
     * @var integer
     *
     * @ORM\Column(name="opens_once", type="integer")
     */
    private $opensOnce;

    /**
     * @var integer
     *
     * @ORM\Column(name="clics", type="integer")
     */
    private $clics;

    /**
     * @var integer
     *
     * @ORM\Column(name="clics_once", type="integer")
     */
    private $clicsOnce;

    /**
     * @var integer
     *
     * @ORM\Column(name="forwards", type="integer")
     */
    private $forwards;

    /**
     * @var integer
     *
     * @ORM\Column(name="prints", type="integer", nullable=true)
     */
    private $prints;

    /**
     * @var integer
     *
     * @ORM\Column(name="unsuscribes", type="integer")
     */
    private $unsuscribes;

    public function __construct()
    {   
        $this->emailsSent       = 0;
        $this->mailsSent        = 0;
        $this->smsSent          = 0;
        $this->phoneCalls       = 0;
        $this->opens            = 0;
        $this->opensOnce        = 0;
        $this->clics            = 0;
        $this->clicsOnce        = 0;
        $this->hardBounce       = 0;
        $this->softBounce       = 0;
        $this->forwards         = 0;
        $this->prints           = 0;
        $this->unsuscribes      = 0;
    }


    /**
     * Get fullName
     *
     * @return \Tracking
     */
    public function getFullName()
    {
        return 'Tracking : '.$this->id.' - '.$this->idClient.' '.$this->idCampagne;
    }

    // Function for sonata to render text-link relative to the entity

    /**
     * __toString
     * 
     * @return string
     */
    public function __toString() {
        return $this->getFullName();
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

    public function getClient()
    {
        return $this->client;
    }

    public function setClient(Client $client = null)
    {
        $this->client = $client;
        return $this;
    }

    

    /**
     * Set campaign
     *
     * @param Campaign $campaign
     * @return Tracking
     */
    public function setCampaign(Campaign $campaign)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Get campaign
     *
     * @return Campaign 
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Set emailsSent
     *
     * @param integer $emailsSent
     * @return Tracking
     */
    public function setEmailsSent($emailsSent)
    {
        $this->emailsSent = $emailsSent;

        return $this;
    }

    /**
     * Get emailsSent
     *
     * @return integer 
     */
    public function getEmailsSent()
    {
        return $this->emailsSent;
    }

    public function increaseEmailsSent()
    {
        $this->emailsSent++;
    }

    /**
     * Set mailsSent
     *
     * @param integer $mailsSent
     * @return Tracking
     */
    public function setMailsSent($mailsSent)
    {
        $this->mailsSent = $mailsSent;

        return $this;
    }

    /**
     * Get mailsSent
     *
     * @return integer 
     */
    public function getMailsSent()
    {
        return $this->mailsSent;
    }

    public function increaseMailsSent()
    {
        $this->mailsSent++;
    }

    /**
     * Set smsSent
     *
     * @param integer $smsSent
     * @return Tracking
     */
    public function setSmsSent($smsSent)
    {
        $this->smsSent = $smsSent;

        return $this;
    }

    /**
     * Get smsSent
     *
     * @return integer 
     */
    public function getSmsSent()
    {
        return $this->smsSent;
    }

    public function increaseSmsSent()
    {
        $this->smsSent++;
    }

    /**
     * Set phoneCalls
     *
     * @param integer $phoneCalls
     * @return Tracking
     */
    public function setPhoneCalls($phoneCalls)
    {
        $this->phoneCalls = $phoneCalls;

        return $this;
    }

    /**
     * Get phoneCalls
     *
     * @return integer 
     */
    public function getPhoneCalls()
    {
        return $this->phoneCalls;
    }

    public function increasePhoneCalls()
    {
        $this->phoneCalls++;
    }

    /**
     * Set hardBounce
     *
     * @param integer $hardBounce
     * @return Tracking
     */
    public function setHardBounce($hardBounce)
    {
        $this->hardBounce = $hardBounce;

        return $this;
    }

    /**
     * Get hardBounce
     *
     * @return integer 
     */
    public function getHardBounce()
    {
        return $this->hardBounce;
    }

    /**
     * Set softBounce
     *
     * @param integer $softBounce
     * @return Tracking
     */
    public function setSoftBounce($softBounce)
    {
        $this->softBounce = $softBounce;

        return $this;
    }

    /**
     * Get softBounce
     *
     * @return integer 
     */
    public function getSoftBounce()
    {
        return $this->softBounce;
    }

    /**
     * Set opens
     *
     * @param integer $opens
     * @return Tracking
     */
    public function setOpens($opens)
    {
        $this->opens = $opens;

        return $this;
    }

    /**
     * Get opens
     *
     * @return integer 
     */
    public function getOpens()
    {
        return $this->opens;
    }

    /**
     * Set opensOnce
     *
     * @param integer $opensOnce
     * @return Tracking
     */
    public function setOpensOnce($opensOnce)
    {
        $this->opensOnce = $opensOnce;

        return $this;
    }

    /**
     * Get opensOnce
     *
     * @return integer 
     */
    public function getOpensOnce()
    {
        return $this->opensOnce;
    }

    /**
     * Set clics
     *
     * @param integer $clics
     * @return Tracking
     */
    public function setClics($clics)
    {
        $this->clics = $clics;

        return $this;
    }

    /**
     * Get clics
     *
     * @return integer 
     */
    public function getClics()
    {
        return $this->clics;
    }

    /**
     * Set clicsOnce
     *
     * @param integer $clicsOnce
     * @return Tracking
     */
    public function setClicsOnce($clicsOnce)
    {
        $this->clicsOnce = $clicsOnce;

        return $this;
    }

    /**
     * Get clicsOnce
     *
     * @return integer 
     */
    public function getClicsOnce()
    {
        return $this->clicsOnce;
    }

    /**
     * Set forwards
     *
     * @param integer $forwards
     * @return Tracking
     */
    public function setForwards($forwards)
    {
        $this->forwards = $forwards;

        return $this;
    }

    /**
     * Get forwards
     *
     * @return integer 
     */
    public function getForwards()
    {
        return $this->forwards;
    }

    /**
     * Set prints
     *
     * @param integer $prints
     * @return Tracking
     */
    public function setPrints($prints)
    {
        $this->prints = $prints;

        return $this;
    }

    /**
     * Get prints
     *
     * @return integer 
     */
    public function getPrints()
    {
        return $this->prints;
    }

    /**
     * Set unsuscribes
     *
     * @param integer $unsuscribes
     * @return Tracking
     */
    public function setUnsuscribes($unsuscribes)
    {
        $this->unsuscribes = $unsuscribes;

        return $this;
    }

    /**
     * Get unsuscribes
     *
     * @return integer 
     */
    public function getUnsuscribes()
    {
        return $this->unsuscribes;
    }
}
