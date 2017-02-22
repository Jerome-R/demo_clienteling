<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Application\Sonata\UserBundle\Entity\User;

/**
 * Client
 *
 * @ORM\Table(name="app_client")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ClientRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Client
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
     * @ORM\Column(name="id_client", type="string", length=30, unique=true)
     */
    private $idClient;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=150, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=150, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=100, nullable=true)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="boutique_rattachement_topclient", type="string", length=50, nullable=true)
     */
    private $boutiqueRattachementTopclient;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_boutique_rattachement_topclient", type="string", length=150, nullable=true)
     */
    private $libelleBoutiqueRattachementTopclient;

    /**
     * @var string
     *
     * @ORM\Column(name="pays_boutique_rattachement", type="string", length=80, nullable=true)
     */
    private $paysBoutiqueRattachement;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone1", type="string", length=70, nullable=true)
     */
    private $telephone1;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone2", type="string", length=70, nullable=true)
     */
    private $telephone2;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone3", type="string", length=70, nullable=true)
     */
    private $telephone3;

    /**
     * @var string
     *
     * @ORM\Column(name="portable1", type="string", length=70, nullable=true)
     */
    private $portable1;

    /**
     * @var string
     *
     * @ORM\Column(name="portable2", type="string", length=70, nullable=true)
     */
    private $portable2;

    /**
     * @var string
     *
     * @ORM\Column(name="portable3", type="string", length=70, nullable=true)
     */
    private $portable3;

    /**
     * @var string
     *
     * @ORM\Column(name="local", type="string", length=20, nullable=true)
     */
    private $local;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=100, nullable=true)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=100, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=10, nullable=true)
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse1", type="string", length=100, nullable=true)
     */
    private $adresse1;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse2", type="string", length=100, nullable=true)
     */
    private $adresse2;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse3", type="string", length=100, nullable=true)
     */
    private $adresse3;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=100, nullable=true)
     */
    private $nationalite;
    /**
     * @var integer
     *
     * @ORM\Column(name="ca_3_ans", type="integer", nullable=true)
     */
    private $ca3ans;

    /**
     * @var integer
     *
     * @ORM\Column(name="ca_12_mois", type="integer", nullable=true)
     */
    private $ca12mois;

    /**
     * @var integer
     *
     * @ORM\Column(name="ca_histo", type="integer", nullable=true)
     */
    private $caHisto;

    /**
     * @var integer
     *
     * @ORM\Column(name="frequence_3_ans", type="integer", nullable=true)
     */
    private $freq3ans;

    /**
     * @var integer
     *
     * @ORM\Column(name="frequence_12_mois", type="integer", nullable=true)
     */
    private $freq12mois;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_max_3_ans", type="integer", nullable=true)
     */
    private $pmax3ans;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_max_12_mois", type="integer", nullable=true)
     */
    private $pmax12mois;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_max_article_histo", type="integer", nullable=true)
     */
    private $pmaxArticleHisto;

    /**
     * @var integer
     *
     * @ORM\Column(name="panier_moyen_histo", type="integer", nullable=true)
     */
    private $pmhisto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_1erachat", type="datetime", nullable=true)
     */
    private $date1erachat;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_dernier_achat", type="datetime", nullable=true)
     */
    private $datedernachat;

    /**
     * @var string
     *
     * @ORM\Column(name="segment", type="string", length=100, nullable=true)
     */
    private $segment;

    /**
     * @var string
     *
     * @ORM\Column(name="code_vendeur", type="string", length=255, nullable=true)
     */
    private $codevendeur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_tel_valide", type="boolean", nullable=true)
     */
    private $isTelValide;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_adresse_valide", type="boolean", nullable=true)
     */
    private $isAdresseValide;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_email_valide", type="boolean", length=10, nullable=true)
     */
    private $isEmailValide;

    /**
     * @var string
     *
     * @ORM\Column(name="is_contactable_tel", type="string", length=10, nullable=true)
     */
    private $isContactableTel;

    /**
     * @var string
     *
     * @ORM\Column(name="is_contactable_adresse", type="string", length=10, nullable=true)
     */
    private $isContactableAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="is_contactable_email", type="string", nullable=true)
     */
    private $isContactableEmail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="optout_email", type="boolean", nullable=true)
     */
    private $optoutEmail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="optout_mail", type="boolean", nullable=true)
     */
    private $optoutMail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="optout_telephone", type="boolean", nullable=true)
     */
    private $optoutTelephone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="optout_sms", type="boolean", nullable=true)
     */
    private $optoutSms;

    /**
     * @var string
     *
     * @ORM\Column(name="optin", type="string", length=20, nullable=true)
     */
    private $optin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
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

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_contact", type="datetime", nullable=true)
     */
    private $lastContact;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_hard_bounce", type="boolean", nullable=true)
     */
    private $isHardBounce;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_soft_bounce", type="boolean", nullable=true)
     */
    private $isSoftBounce;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_topclient", type="boolean", nullable=true)
     */
    private $isTopclient;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_nouveau_topclient", type="boolean", nullable=true)
     */
    private $isNouveauTopclient;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_topclient_sortant", type="boolean", nullable=true)
     */
    private $isTopclientSortant;


    /* Gestion des doublons suspect */


    /**
     * @var boolean
     *
     * @ORM\Column(name="is_suspect_doublon", type="boolean", nullable=true)
     */
    private $isSuspectDoublon;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_doublon", type="boolean", nullable=true)
     */
    private $isDoublon;


    /* Jointures */


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Recipient", mappedBy="client", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    protected $recipients;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DataRecipient", mappedBy="client",  cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    private $dataRecipients;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ticket", mappedBy="client")
     */
    private $tickets;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ClientComment", mappedBy="client")
     */
    private $clientComments;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ClientSortant", mappedBy="client")
     */
    protected $clientSortants;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ClientSuspectDoublon", mappedBy="client")
     */
    protected $clientSuspectDoublons;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="clientsTriggers")
     * @ORM\JoinColumn(name="user_id_trigger", nullable=true)
     */
    private $userTrigger;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="topclients")
     * @ORM\JoinColumn(name="user_id_topclient", nullable=true)
     */
    private $userTopclient;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="doublonSuspects")
     * @ORM\JoinColumn(name="user_id_doublon_suspect", nullable=true)
     */
    private $userDoublonSuspect;

    public function __construct()
    {
        $this->userTrigger              = null;
        $this->userTopclient            = null;
        $this->userDoublonSuspect       =null;
        $this->createdAt                = new \DateTime();
        $this->isTelValide              = 0;
        $this->isAdresseValide          = 0;
        $this->isEmailValide            = 0;
        $this->optoutEmail              = 0;
        $this->optoutMail               = 0;
        $this->optoutTelephone          = 0;
        $this->isContactableTel         = "";
        $this->isContactableAdresse     = "";
        $this->isContactableEmail       = "";
        $this->isHardBounce             = false;
        $this->isSoftBounce             = false;
        $this->optoutTeleohone          = 0;
        $this->optoutSms                = 0;
        $this->isTopclient              = 0;
        $this->isNouveauTopclient       = 0;
        $this->isTopclientSortant       = 0;
        $this->recipients               = new ArrayCollection();
        $this->dataRecipients           = new ArrayCollection();
        $this->tickets                  = new ArrayCollection();
        $this->clientComments           = new ArrayCollection();
        $this->clientSortants           = new ArrayCollection();
        $this->clientSuspectDoublons    = new ArrayCollection();
    }

    /**
     * Get fullName
     *
     * @return \Client
     */
    public function getFullName()
    {
        return $this->prenom.' '.$this->nom;
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
     * @return Client
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Get userTrigger
     *
     * @return Client
     */
    public function getUserTrigger()
    {
        return $this->userTrigger;
    }

    /**
     * Set userTrigger
     *
     * @return User
     */
    public function setUserTrigger(User $userTrigger)
    {
        $this->userTrigger = $userTrigger;

        return $this;
    }

    /**
     * Get userTopclient
     *
     * @return Client
     */
    public function getUserTopclient()
    {
        return $this->userTopclient;
    }

    /**
     * Set userTopclient
     *
     * @return User
     */
    public function setUserTopclient(User $userTopclient)
    {
        $this->userTopclient = $userTopclient;

        return $this;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     *
     * @return Client
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Client
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Client
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Client
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
     * Set telephone1
     *
     * @param string $telephone1
     *
     * @return Client
     */
    public function setTelephone1($telephone1)
    {
        $this->telephone1 = $telephone1;

        return $this;
    }

    /**
     * Get telephone1
     *
     * @return string
     */
    public function getTelephone1()
    {
        return $this->telephone1;
    }

    /**
     * Set telephone2
     *
     * @param string $telephone2
     *
     * @return Client
     */
    public function setTelephone2($telephone2)
    {
        $this->telephone2 = $telephone2;

        return $this;
    }

    /**
     * Get telephone2
     *
     * @return string
     */
    public function getTelephone2()
    {
        return $this->telephone2;
    }
      

    /**
     * Set telephone3
     *
     * @param string $telephone3
     *
     * @return Client
     */
    public function setTelephone3($telephone3)
    {
        $this->telephone3 = $telephone3;

        return $this;
    }

    /**
     * Get telephone3
     *
     * @return string
     */
    public function getTelephone3()
    {
        return $this->telephone3;
    }

    /**
     * Set portable1
     *
     * @param string $portable1
     *
     * @return Client
     */
    public function setPortable1($portable1)
    {
        $this->portable1 = $portable1;

        return $this;
    }

    /**
     * Get portable1
     *
     * @return string
     */
    public function getPortable1()
    {
        return $this->portable1;
    }

    /**
     * Set portable2
     *
     * @param string $portable2
     *
     * @return Client
     */
    public function setPortable2($portable2)
    {
        $this->portable1 = $portable2;

        return $this;
    }

    /**
     * Get portable2
     *
     * @return string
     */
    public function getPortable2()
    {
        return $this->portable2;
    }

    /**
     * Set portable3
     *
     * @param string $portable3
     *
     * @return Client
     */
    public function setPortable3($portable3)
    {
        $this->portable3 = $portable3;

        return $this;
    }

    /**
     * Get portable3
     *
     * @return string
     */
    public function getPortable3()
    {
        return $this->portable3;
    }

    /**
     * Set adresse1
     *
     * @param string $adresse1
     *
     * @return Client
     */
    public function setAdresse1($adresse1)
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    /**
     * Get adresse1
     *
     * @return string
     */
    public function getAdresse1()
    {
        return $this->adresse1;
    }

    /**
     * Set adresse2
     *
     * @param string $adresse2
     *
     * @return Client
     */
    public function setAdresse2($adresse2)
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    /**
     * Get adresse2
     *
     * @return string
     */
    public function getAdresse2()
    {
        return $this->adresse2;
    }

    /**
     * Set adresse3
     *
     * @param string $adresse3
     * @return Client
     */
    public function setAdresse3($adresse3)
    {
        $this->adresse3 = $adresse3;

        return $this;
    }

    /**
     * Get adresse3
     *
     * @return string 
     */
    public function getAdresse3()
    {
        return $this->adresse3;
    }

    /**
     * Set local
     *
     * @param string $local
     *
     * @return Client
     */
    public function setLocal($local)
    {
        $this->local = $local;

        return $this;
    }

    /**
     * Get local
     *
     * @return string
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Client
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set codepostal
     *
     * @param string $codepostal
     *
     * @return Client
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return string
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Client
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set lastContact
     *
     * @param \DateTime $lastContact
     *
     * @return Client
     */
    public function setLastContact($lastContact)
    {
        if( !($lastContact instanceof \DateTime) ) $lastContact = new \DateTime($lastContact);
        $this->lastContact = $lastContact;

        return $this;
    }

    /**
     * Get lastContact
     *
     * @return \DateTime
     */
    public function getLastContact()
    {
        return $this->lastContact;
    }

    /**
     * Set isTelValide
     *
     * @param boolean $isTelValide
     *
     * @return Client
     */
    public function setIsTelValide($isTelValide)
    {
        $this->isTelValide = $isTelValide;

        return $this;
    }

    /**
     * Get isTelValide
     *
     * @return boolean
     */
    public function getIsTelValide()
    {
        return $this->isTelValide;
    }

    /**
     * Set isAdresseValide
     *
     * @param boolean $isAdresseValide
     *
     * @return Client
     */
    public function setIsAdresseValide($isAdresseValide)
    {
        $this->isAdresseValide = $isAdresseValide;

        return $this;
    }

    /**
     * Get isAdresseValide
     *
     * @return boolean
     */
    public function getIsAdresseValide()
    {
        return $this->isAdresseValide;
    }

    /**
     * Set isEmailValide
     *
     * @param boolean $isEmailValide
     *
     * @return Client
     */
    public function setIsEmailValide($isEmailValide)
    {
        $this->isEmailValide = $isEmailValide;

        return $this;
    }

    /**
     * Get isEmailValide
     *
     * @return boolean
     */
    public function getIsEmailValide()
    {
        return $this->isEmailValide;
    }

    /**
     * Set isContactableTel
     *
     * @param string $isContactableTel
     *
     * @return Client
     */
    public function setIsContactableTel($isContactableTel)
    {
        $this->isContactableTel = $isContactableTel;

        return $this;
    }

    /**
     * Get isContactableTel
     *
     * @return string
     */
    public function getIsContactableTel()
    {
        return $this->isContactableTel;
    }

    /**
     * Set isContactableAdresse
     *
     * @param string $isContactableAdresse
     *
     * @return Client
     */
    public function setIsContactableAdresse($isContactableAdresse)
    {
        $this->isContactableAdresse = $isContactableAdresse;

        return $this;
    }

    /**
     * Get isContactableAdresse
     *
     * @return string
     */
    public function getIsContactableAdresse()
    {
        return $this->isContactableAdresse;
    }

    /**
     * Set isContactableEmail
     *
     * @param string $isContactableEmail
     *
     * @return Client
     */
    public function setIsContactableEmail($isContactableEmail)
    {
        $this->isContactableEmail = $isContactableEmail;

        return $this;
    }

    /**
     * Get isContactableEmail
     *
     * @return string
     */
    public function getIsContactableEmail()
    {
        return $this->isContactableEmail;
    }

    /**
     * Set optOutEmail
     *
     * @param boolean $optoutEmail
     *
     * @return Client
     */
    public function setOptoutEmail($optoutEmail)
    {
        $this->optoutEmail = $optoutEmail;

        return $this;
    }

    /**
     * Get optOutEmail
     *
     * @return boolean
     */
    public function getOptoutEmail()
    {
        return $this->optoutEmail;
    }

    /**
     * Set optOutMail
     *
     * @param boolean $optoutMail
     *
     * @return Client
     */
    public function setOptoutMail($optoutMail)
    {
        $this->optoutMail = $optoutMail;

        return $this;
    }

    /**
     * Get optOutMail
     *
     * @return boolean
     */
    public function getOptoutMail()
    {
        return $this->optoutMail;
    }

    /**
     * Set optOutTelephone
     *
     * @param boolean $optoutTelephone
     *
     * @return Client
     */
    public function setOptoutTelephone($optoutTelephone)
    {
        $this->optoutTelephone = $optoutTelephone;

        return $this;
    }

    /**
     * Get optOutTelephone
     *
     * @return boolean
     */
    public function getOptoutTelephone()
    {
        return $this->optoutTelephone;
    }

    /**
     * Set optOutSms
     *
     * @param boolean $optoutSms
     *
     * @return Client
     */
    public function setOptoutSms($optoutSms)
    {
        $this->optoutSms = $optoutSms;

        return $this;
    }

    /**
     * Get optOutSms
     *
     * @return boolean
     */
    public function getOptoutSms()
    {
        return $this->optoutSms;
    }

    /**
     * Set optin
     *
     * @param string $optin
     * @return Client
     */
    public function setOptin($optin)
    {
        $this->optin = $optin;

        return $this;
    }

    /**
     * Get optin
     *
     * @return string 
     */
    public function getOptin()
    {
        return $this->optin;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Client
     */
    public function setCreatedAt($createdAt)
    {
        if( !($createdAt instanceof \DateTime) ) $createdAt = new \DateTime($createdAt);
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
     *
     * @return Client
     */
    public function setModifiedAt($modifiedAt)
    {
        if( !($modifiedAt instanceof \DateTime) ) $modifiedAt = new \DateTime($modifiedAt);
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

    /**
     * Set boutiqueRattachementTopclient
     *
     * @param string $boutiqueRattachementTopclient
     * @return Client
     */
    public function setBoutiqueRattachementTopclient($boutiqueRattachementTopclient)
    {
        $this->boutiqueRattachementTopclient = $boutiqueRattachementTopclient;

        return $this;
    }

    /**
     * Get boutiqueRattachementTopclient
     *
     * @return string 
     */
    public function getBoutiqueRattachementTopclient()
    {
        return $this->boutiqueRattachementTopclient;
    }

    /**
     * Set libelleBoutiqueRattachementTopclient
     *
     * @param string $libelleBoutiqueRattachementTopclient
     * @return Client
     */
    public function setLibelleBoutiqueRattachementTopclient($libelleBoutiqueRattachementTopclient)
    {
        $this->libelleBoutiqueRattachementTopclient = $libelleBoutiqueRattachementTopclient;

        return $this;
    }

    /**
     * Get libelleBoutiqueRattachementTopclient
     *
     * @return string 
     */
    public function getLibelleBoutiqueRattachementTopclient()
    {
        return $this->libelleBoutiqueRattachementTopclient;
    }

    /**
     * Set paysBoutiqueRattachement
     *
     * @param string $paysBoutiqueRattachement
     * @return Client
     */
    public function setPaysBoutiqueRattachement($paysBoutiqueRattachement)
    {
        $this->paysBoutiqueRattachement = $paysBoutiqueRattachement;

        return $this;
    }

    /**
     * Get paysBoutiqueRattachement
     *
     * @return string 
     */
    public function getPaysBoutiqueRattachement()
    {
        return $this->paysBoutiqueRattachement;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     * @return Client
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string 
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set ca3ans
     *
     * @param integer $ca3ans
     * @return Client
     */
    public function setCa3ans($ca3ans)
    {
        $this->ca3ans = $ca3ans;

        return $this;
    }

    /**
     * Get ca3ans
     *
     * @return integer 
     */
    public function getCa3ans()
    {
        return $this->ca3ans;
    }

    /**
     * Set ca12mois
     *
     * @param integer $ca12mois
     * @return Client
     */
    public function setCa12mois($ca12mois)
    {
        $this->ca12mois = $ca12mois;

        return $this;
    }

    /**
     * Get ca12mois
     *
     * @return integer 
     */
    public function getCa12mois()
    {
        return $this->ca12mois;
    }

    /**
     * Set caHisto
     *
     * @param integer $caHisto
     * @return Client
     */
    public function setCaHisto($caHisto)
    {
        $this->caHisto = $caHisto;

        return $this;
    }

    /**
     * Get caHisto
     *
     * @return integer 
     */
    public function getCaHisto()
    {
        return $this->caHisto;
    }

    /**
     * Set freq3ans
     *
     * @param integer $freq3ans
     * @return Client
     */
    public function setFreq3ans($freq3ans)
    {
        $this->freq3ans = $freq3ans;

        return $this;
    }

    /**
     * Get freq3ans
     *
     * @return integer 
     */
    public function getFreq3ans()
    {
        return $this->freq3ans;
    }

    /**
     * Set freq12mois
     *
     * @param integer $freq12mois
     * @return Client
     */
    public function setFreq12mois($freq12mois)
    {
        $this->freq12mois = $freq12mois;

        return $this;
    }

    /**
     * Get freq12mois
     *
     * @return integer 
     */
    public function getFreq12mois()
    {
        return $this->freq12mois;
    }

    /**
     * Set pmax3ans
     *
     * @param integer $pmax3ans
     * @return Client
     */
    public function setPmax3ans($pmax3ans)
    {
        $this->pmax3ans = $pmax3ans;

        return $this;
    }

    /**
     * Get pmax3ans
     *
     * @return integer 
     */
    public function getPmax3ans()
    {
        return $this->pmax3ans;
    }

    /**
     * Set pmax12mois
     *
     * @param integer $pmax12mois
     * @return Client
     */
    public function setPmax12mois($pmax12mois)
    {
        $this->pmax12mois = $pmax12mois;

        return $this;
    }

    /**
     * Get pmax12mois
     *
     * @return integer 
     */
    public function getPmax12mois()
    {
        return $this->pmax12mois;
    }

    /**
     * Set pmaxArticleHisto
     *
     * @param integer $pmaxArticleHisto
     * @return Client
     */
    public function setPmaxArticleHisto($pmaxArticleHisto)
    {
        $this->pmaxArticleHisto = $pmaxArticleHisto;

        return $this;
    }

    /**
     * Get pmaxArticleHisto
     *
     * @return integer 
     */
    public function getPmaxArticleHisto()
    {
        return $this->pmaxArticleHisto;
    }

    /**
     * Set segment
     *
     * @param string $segment
     * @return Client
     */
    public function setSegment($segment)
    {
        $this->segment = $segment;

        return $this;
    }

    /**
     * Get segment
     *
     * @return string 
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * Set codevendeur
     *
     * @param string $codevendeur
     * @return Client
     */
    public function setCodevendeur($codevendeur)
    {
        $this->codevendeur = $codevendeur;

        return $this;
    }

    /**
     * Get codevendeur
     *
     * @return string 
     */
    public function getCodevendeur()
    {
        return $this->codevendeur;
    }

    /**
     * Set isHardBounce
     *
     * @param boolean $isHardBounce
     * @return Client
     */
    public function setIsHardBounce($isHardBounce)
    {
        $this->isHardBounce = $isHardBounce;

        return $this;
    }

    /**
     * Get isHardBounce
     *
     * @return boolean 
     */
    public function getIsHardBounce()
    {
        return $this->isHardBounce;
    }

    /**
     * Set isSoftBounce
     *
     * @param boolean $isSoftBounce
     * @return Client
     */
    public function setIsSoftBounce($isSoftBounce)
    {
        $this->isSoftBounce = $isSoftBounce;

        return $this;
    }

    /**
     * Get isSoftBounce
     *
     * @return boolean 
     */
    public function getIsSoftBounce()
    {
        return $this->isSoftBounce;
    }

    /**
     * Set isTopclient
     *
     * @param boolean $isTopclient
     * @return Client
     */
    public function setIsTopclient($isTopclient)
    {
        $this->isTopclient = $isTopclient;

        return $this;
    }

    /**
     * Get isTopclient
     *
     * @return boolean 
     */
    public function getIsTopclient()
    {
        return $this->isTopclient;
    }

    /**
     * Set isNouveauTopclient
     *
     * @param boolean $isNouveauTopclient
     * @return Client
     */
    public function setIsNouveauTopClient($isNouveauTopclient)
    {
        $this->isNouveauTopclient = $isNouveauTopclient;

        return $this;
    }

    /**
     * Get isNouveauTopclient
     *
     * @return boolean 
     */
    public function getIsNouveauTopClient()
    {
        return $this->isNouveauTopclient;
    }

    /**
     * Set isTopclientSortant
     *
     * @param boolean $isTopclientSortant
     * @return Client
     */
    public function setIsTopclientSortant($isTopclientSortant)
    {
        $this->isTopclientSortant = $isTopclientSortant;

        return $this;
    }

    /**
     * Get isTopclientSortant
     *
     * @return boolean 
     */
    public function getIsTopclientSortant()
    {
        return $this->isTopclientSortant;
    }

    /**
     * Set pmhisto
     *
     * @param integer $pmhisto
     * @return Client
     */
    public function setPmhisto($pmhisto)
    {
        $this->pmhisto = $pmhisto;

        return $this;
    }

    /**
     * Get pmhisto
     *
     * @return integer 
     */
    public function getPmhisto()
    {
        return $this->pmhisto;
    }

    /**
     * Set date1erachat
     *
     * @param \DateTime $date1erachat
     * @return Client
     */
    public function setDate1erachat($date1erachat)
    {
        if( !($date1erachat instanceof \DateTime) ) $date1erachat = new \DateTime($date1erachat);
        $this->date1erachat = $date1erachat;

        return $this;
    }

    /**
     * Get date1erachat
     *
     * @return \DateTime 
     */
    public function getDate1erachat()
    {
        return $this->date1erachat;
    }

    /**
     * Set datedernachat
     *
     * @param \DateTime $datedernachat
     * @return Client
     */
    public function setDatedernachat($datedernachat)
    {
        if( !($datedernachat instanceof \DateTime) ) $datedernachat = new \DateTime($datedernachat);
        $this->datedernachat = $datedernachat;

        return $this;
    }

    /**
     * Get datedernachat
     *
     * @return \DateTime 
     */
    public function getDatedernachat()
    {
        return $this->datedernachat;
    }

    /**
     * Add recipient
     *
     * @param Recipient $recipient
     * @return Client
     */
    public function addRecipient(Recipient $recipient)
    {
        $this->recipients[] = $recipient;
        return $this;
    }

    /**
     * Remove recipient
     *
     * @param Recipient $recipient
     */
    public function removeRecipient(Recipient $recipient)
    {
        $this->recipients->removeElement($recipient);
    }

    /**
     * Get recipient
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecipients()
    {
        return $this->recipients;
    }
    /**
     * Add clientSortant
     *
     * @param ClientSortant $clientSortant
     * @return Client
     */
    public function addClientSortant(ClientSortant $clientSortant)
    {
        $this->clientSortants[] = $clientSortant;
        return $this;
    }

    /**
     * Remove clientSortant
     *
     * @param ClientSortant $clientSortant
     */
    public function removeClientSortant(ClientSortant $clientSortant)
    {
        $this->clientSortants->removeElement($clientSortant);
    }

    /**
     * Get clientSortant
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientSortants()
    {
        return $this->clientSortants;
    }

    /**
     * Add clientComment
     *
     * @param ClientComment $clientComment
     * @return Client
     */
    public function addClientComment(ClientComment $clientComment)
    {
        $this->clientComments[] = $clientComment;
        return $this;
    }

    /**
     * Remove clientComment
     *
     * @param ClientComment $clientComment
     */
    public function removeClientComment(ClientComment $clientComment)
    {
        $this->clientComments->removeElement($clientComment);
    }

    /**
     * Get clientComment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientComments()
    {
        return $this->clientComments;
    }

    /**
     * Add dataRecipient
     *
     * @param DataRecipient $dataRecipient
     * @return Client
     */
    public function addDataRecipient(DataRecipient $dataRecipient)
    {
        $this->dataRecipients[] = $dataRecipient;
        return $this;
    }

    /**
     * Remove dataRecipient
     *
     * @param Recipient $dataRecipient
     */
    public function removeDataRecipient(DataRecipient $dataRecipient)
    {
        $this->dataRecipients->removeElement($dataRecipient);
    }

    /**
     * Get dataRecipient
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDataRecipients()
    {
        return $this->dataRecipients;
    }

    public function getCampaigns()
    {
        return array_map(
            function ($recipient) {
                return $recipient->getCampaign();
            },
            $this->recipients->toArray()
        );
    }

    /**
     * Add ticket
     *
     * @param Ticket $ticket
     * @return Client
     */
    public function addTicket(Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param Ticket $ticket
     */
    public function removeTicket(Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set isSuspectDoublon
     *
     * @param boolean $isSuspectDoublon
     * @return Client
     */
    public function setIsSuspectDoublon($isSuspectDoublon)
    {
        $this->isSuspectDoublon = $isSuspectDoublon;

        return $this;
    }

    /**
     * Get isSuspectDoublon
     *
     * @return boolean 
     */
    public function getIsSuspectDoublon()
    {
        return $this->isSuspectDoublon;
    }

    /**
     * Set isDoublon
     *
     * @param boolean $isDoublon
     * @return Client
     */
    public function setIsDoublon($isDoublon)
    {
        $this->isDoublon = $isDoublon;

        return $this;
    }

    /**
     * Get isDoublon
     *
     * @return boolean 
     */
    public function getIsDoublon()
    {
        return $this->isDoublon;
    }

    /**
     * Add clientSuspectDoublons
     *
     * @param \AppBundle\Entity\ClientSuspectDoublon $clientSuspectDoublons
     * @return Client
     */
    public function addClientSuspectDoublon(\AppBundle\Entity\ClientSuspectDoublon $clientSuspectDoublons)
    {
        $this->clientSuspectDoublons[] = $clientSuspectDoublons;

        return $this;
    }

    /**
     * Remove clientSuspectDoublons
     *
     * @param \AppBundle\Entity\ClientSuspectDoublon $clientSuspectDoublons
     */
    public function removeClientSuspectDoublon(\AppBundle\Entity\ClientSuspectDoublon $clientSuspectDoublons)
    {
        $this->clientSuspectDoublons->removeElement($clientSuspectDoublons);
    }

    /**
     * Get clientSuspectDoublons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientSuspectDoublons()
    {
        return $this->clientSuspectDoublons;
    }
}
