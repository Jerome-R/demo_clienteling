<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

//To get access to the EntityManager and UnitOfWork APIs inside these callback methods.
use Doctrine\ORM\Event\LifecycleEventArgs;


use Application\Sonata\UserBundle\Entity\User;

/**
 * Recipient
 *
 * @ORM\Table(name="app_recipient", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="UNIQUE_CL_CA", columns={"client_id", "campaign_id"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Entity\RecipientRepository")
 * @UniqueEntity(
 *     fields={"campaign", "client"},
 *     message="Duplicate entry for entries Campaign - Client."
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class Recipient
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Campaign", inversedBy="recipients")
     * @ORM\JoinColumn(name="campaign_id", nullable=false)
     */
    private $campaign;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="recipients")
     * @ORM\JoinColumn(name="client_id", nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\DataRecipient", inversedBy="recipient")
     * @ORM\JoinColumn(name="data_recipient_id", nullable=true)
     */
    private $dataRecipient;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="recipients")
     * @ORM\JoinColumn(name="user_id", nullable=true)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="optout_autre", type="string", nullable=true)
     */
    private $optoutAutre;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="canal", type="string", nullable=true)
     */
    private $canal;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", nullable=true)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="id_campagne_name", type="string", nullable=true)
     */
    private $idCampagneName;

    /**
     * @var string
     *
     * @ORM\Column(name="id_client", type="string", length=255, nullable=true)
     */
    private $idClient;

    /**
     * @var boolean
     *
     * @ORM\Column(name="optout_non_pertinent", type="boolean", nullable=true)
     */
    private $optoutNonPertinent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="optin", type="boolean", nullable=true)
     */
    private $optin = 1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="contact_later", type="boolean", nullable=true)
     */
    private $contactLater;

    /**
     * @var boolean
     *
     * @ORM\Column(name="in_last_import", type="boolean", nullable=true)
     */
    private $inLastImport;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_email_sent", type="boolean", nullable=true)
     */
    private $isEmailSent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="contacted_at", type="datetime", nullable=true)
     */
    private $contactedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $modifiedAt;

    public function __construct()
    {
        $this->optoutAutre = "";
        $this->optoutNonPertinent = 0;
        $this->optin = 1;
        $this->isEmailSent = 0;
        $this->inLastImport = 1;
        $this->contactLater = 0;
        $this->language = "fr";
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

    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }

    public function getDataRecipient()
    {
        return $this->dataRecipient;
    }

    public function setDataRecipient(dataRecipient $dataRecipient)
    {
        $this->dataRecipient = $dataRecipient;
        return $this;
    }

    public function getCampaign()
    {
        return $this->campaign;
    }

    public function setCampaign(Campaign $campaign)
    {
        $this->campaign = $campaign;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Recipient
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Recipient
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get idCampagneName
     *
     * @return string
     */
    public function getIdCampagneName()
    {
        return $this->idCampagneName;
    }

    /**
     * Set idCampagneName
     *
     * @param string $idCampagneName
     *
     * @return Recipient
     */
    public function setIdCampagneName($idCampagneName)
    {
        $this->idCampagneName = $idCampagneName;

        return $this;
    }

    /**
     * Get idClient
     *
     * @return string
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * Set idClient
     *
     * @return Recipient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set canal
     *
     * @param string $canal
     * @return Recipient
     */
    public function setCanal($canal)
    {
        $this->canal = $canal;

        return $this;
    }

    /**
     * Get canal
     *
     * @return string 
     */
    public function getCanal()
    {
        return $this->canal;
    }

    /**
     * Set optoutAutre
     *
     * @param string $optoutAutre
     * @return Recipient
     */
    public function setOptoutAutre($optoutAutre)
    {
        $this->optoutAutre = $optoutAutre;

        return $this;
    }

    /**
     * Get optoutAutre
     *
     * @return string 
     */
    public function getOptoutAutre()
    {
        return $this->optoutAutre;
    }

    /**
     * Set optoutNonPertinent
     *
     * @param boolean $optoutNonPertinent
     * @return Recipient
     */
    public function setOptoutNonPertinent($optoutNonPertinent)
    {
        $this->optoutNonPertinent = $optoutNonPertinent;

        return $this;
    }

    /**
     * Get optoutNonPertinent
     *
     * @return boolean 
     */
    public function getOptoutNonPertinent()
    {
        return $this->optoutNonPertinent;
    }

    /**
     * Set optin
     *
     * @param boolean $optin
     * @return Recipient
     */
    public function setOptin($optin)
    {
        $this->optin = $optin;

        return $this;
    }

    /**
     * Get optin
     *
     * @return boolean 
     */
    public function getOptin()
    {
        return $this->optin;
    }

    /**
     * Set isEmailSent
     *
     * @param boolean $isEmailSent
     * @return Recipient
     */
    public function setIsEmailSent($isEmailSent)
    {
        $this->isEmailSent = $isEmailSent;

        return $this;
    }

    /**
     * Get isEmailSent
     *
     * @return boolean 
     */
    public function getIsEmailSent()
    {
        return $this->isEmailSent;
    }

    /**
     * Set contactLater
     *
     * @param boolean $contactLater
     * @return Recipient
     */
    public function setContactLater($contactLater)
    {
        $this->contactLater = $contactLater;

        return $this;
    }

    /**
     * Get contactLater
     *
     * @return boolean 
     */
    public function getContactLater()
    {
        return $this->contactLater;
    }

    /**
     * Set inLastImport
     *
     * @param boolean $inLastImport
     * @return Recipient
     */
    public function setInLastImport($inLastImport)
    {
        $this->inLastImport = $inLastImport;

        return $this;
    }

    /**
     * Get inLastImport
     *
     * @return boolean 
     */
    public function getInLastImport()
    {
        return $this->inLastImport;
    }


    /**
     * Set contactedAt
     *
     * @param \DateTime $contactedAt
     * @return Recipient
     */
    public function setContactedAt($contactedAt)
    {
        $this->contactedAt = $contactedAt;

        return $this;
    }

    /**
     * Get contactedAt
     *
     * @return \DateTime 
     */
    public function getContactedAt()
    {
        return $this->contactedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Recipient
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
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     * @return Recipient
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime 
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    public function getCampaignName()
    {
        return $this->campaign->getName();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function increase()
    {
        $this->getCampaign()->increaseClient();
    }

    /**
     * @ORM\PrePersist
     */
    public function updateCanal()
    {
        $this->setCanal($this->getCampaign()->getCanalOne());
        return $this;
    }

    /**
     * @ORM\PreRemove
     */
    public function decrease()
    {
        $this->getCampaign()->decreaseClient();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateIdCampagneName()
    {
        $this->idCampagneName = $this->getCampaign()->getIdCampaignName();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateIdClient()
    {
        $this->idClient = $this->getClient()->getIdClient();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateOptinStatus()
    {
        $client     = $this->client;
        $campaign   = $this->campaign;

        //var_dump($this);die();

        switch ( $this->getCanal() )
        {
            case 'Email' :
                if ( $client->getOptoutEmail()  == 1 || $this->optoutAutre == 1 || $this->optoutNonPertinent == 1 || $client->getIsEmailValide() == 0 )
                {
                    $this->setOptin(0);
                }
                else{
                    if ( $this->optoutAutre != null and $this->optoutAutre != "") {
                        $this->setOptin(0);
                    }
                    elseif ( $this->optoutNonPertinent == 1 ) {
                        $this->setOptin(0);
                    }
                    else
                        $this->setOptin(1);
                }
            break;
            case 'Mail' :
                if ( $client->getOptoutMail()  == 1 || $this->optoutAutre == 1 || $this->optoutNonPertinent == 1 || $client->getIsAdresseValide() == 0 )
                {
                    $this->setOptin(0);
                }
                else{   
                    if ( $this->optoutAutre != null and $this->optoutAutre != "") {
                        $this->setOptin(0);
                    }
                    elseif ( $this->optoutNonPertinent == 1 ) {
                        $this->setOptin(0);
                    }
                    else
                        $this->setOptin(1);
                }
            break;
            case 'Phone' :
                if ( $client->getOptoutTelephone()  == 1 || $this->optoutAutre == 1 || $this->optoutNonPertinent == 1 || $client->getIsTelValide() == 0 )
                {
                    $this->setOptin(0);
                }
                else{   
                    if ( $this->optoutAutre != null and $this->optoutAutre != "") {
                        $this->setOptin(0);
                    }
                    elseif ( $this->optoutNonPertinent == 1 ) {
                        $this->setOptin(0);
                    }
                    else
                        $this->setOptin(1);
                }
            break;
            case 'SMS' :
                if ( $client->getOptoutSMS()  == 1 || $this->optoutAutre == 1 || $this->optoutNonPertinent == 1 || $client->getIsTelValide() == 0 )
                {
                    $this->setOptin(0);
                }
                else{   
                    if ( $this->optoutAutre != null and $this->optoutAutre != "") {
                        $this->setOptin(0);
                    }
                    elseif ( $this->optoutNonPertinent == 1 ) {
                        $this->setOptin(0);
                    }
                    else
                        $this->setOptin(1);
                }
            break;
        }        

        return;
    } 


    // Function for sonata to render text-link relative to the entity

    /**
     * __toString
     * 
     * @return string
     */
    public function __toString() {
        return $this->getCampaignName();
    }


}
