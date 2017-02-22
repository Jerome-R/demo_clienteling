<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * DataRecipient
 *
 * @ORM\Table(name="app_data_recipient", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="UNIQUE_CL_CA", columns={"client_id", "id_campagne_name"})
 * })
 * @ORM\Entity()
 * @UniqueEntity(
 *     fields={"idClient", "idCampagneName"},
 *     message="Duplicate entry for entries Campaign - Client."
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class DataRecipient
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="dataRecipients")
     * @ORM\JoinColumn(name="client_id", nullable=true)
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="id_client", type="string", length=255)
     */
    private $idClient;

    /**
     * @var string
     *
     * @ORM\Column(name="id_campagne_name", type="string", length=255, nullable=true)
     */
    private $idCampagneName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_entree", type="datetime", nullable=true)
     */
    private $dateEntree;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_boutique_achat", type="string")
     */
    private $libelleBoutiqueAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="canal", type="string", length=100, nullable=true)
     */
    private $canal;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255, nullable=true)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="sous_categorie", type="string", length=255, nullable=true)
     */
    private $sousCategorie;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="code_vendeur", type="string", length=255, nullable=true)
     */
    private $codevendeur;

    /**
     * @var string
     *
     * @ORM\Column(name="vide_1", type="string", length=255, nullable=true)
     */
    private $vide1;

    /**
     * @var string
     *
     * @ORM\Column(name="vide_2", type="string", length=255, nullable=true)
     */
    private $vide2;

    /**
     * @var string
     *
     * @ORM\Column(name="vide_3", type="string", length=255, nullable=true)
     */
    private $vide3;

    /**
     * @var string
     *
     * @ORM\Column(name="vide_4", type="string", length=255, nullable=true)
     */
    private $vide4;

    /**
     * @var string
     *
     * @ORM\Column(name="vide_5", type="string", length=255, nullable=true)
     */
    private $vide5;

    /**
     * @var string
     *
     * @ORM\Column(name="vide_6", type="string", length=255, nullable=true)
     */
    private $vide6;

    /**
     * @var string
     *
     * @ORM\Column(name="vide_7", type="string", length=255, nullable=true)
     */
    private $vide7;

    /**
     * @var string
     *
     * @ORM\Column(name="vide_8", type="string", length=255, nullable=true)
     */
    private $vide8;

    /**
     * @var string
     *
     * @ORM\Column(name="vide_9", type="string", length=255, nullable=true)
     */
    private $vide9;

    /**
     * @var string
     *
     * @ORM\Column(name="vide_10", type="string", length=255, nullable=true)
     */
    private $vide10;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Recipient", mappedBy="dataRecipient", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    protected $recipient;

    public function __construct()
    {
    }
    
    /**
     * Get fullName
     *
     * @return \Client
     */
    public function getFullName()
    {
        if ($this->getClient() != null )
            return 'DataRecipient : '.$this->id.' : '.$this->getClient()->getFullname().' | '.$this->idCampagneName;
       else
            return 'DataRecipient : NULL | '.$this->idCampagneName;
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
     * Set idClient
     *
     * @param string $idClient
     * @return DataRecipient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

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
     * Set idCampagneName
     *
     * @param string $idCampagneName
     * @return DataRecipient
     */
    public function setIdCampagneName($idCampagneName)
    {
        $this->idCampagneName = $idCampagneName;

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
     * Set dateEntree
     *
     * @param \DateTime $dateEntree
     * @return DataRecipient
     */
    public function setDateEntree($dateEntree)
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }

    /**
     * Get dateEntree
     *
     * @return \DateTime 
     */
    public function getDateEntree()
    {
        return $this->dateEntree;
    }

    /**
     * Set libelleBoutiqueAchat
     *
     * @param string $libelleBoutiqueAchat
     * @return DataRecipient
     */
    public function setLibelleBoutiqueAchat($libelleBoutiqueAchat)
    {
        $this->libelleBoutiqueAchat = $libelleBoutiqueAchat;

        return $this;
    }

    /**
     * Get libelleBoutiqueAchat
     *
     * @return string 
     */
    public function getLibelleBoutiqueAchat()
    {
        return $this->libelleBoutiqueAchat;
    }

    /**
     * Set canal
     *
     * @param string $canal
     * @return DataRecipient
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
     * Set categorie
     *
     * @param string $categorie
     * @return DataRecipient
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set sousCategorie
     *
     * @param string $sousCategorie
     * @return DataRecipient
     */
    public function setSousCategorie($sousCategorie)
    {
        $this->sousCategorie = $sousCategorie;

        return $this;
    }

    /**
     * Get sousCategorie
     *
     * @return string 
     */
    public function getSousCategorie()
    {
        return $this->sousCategorie;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     * @return DataRecipient
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set codevendeur
     *
     * @param string $codevendeur
     * @return DataRecipient
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
     * Set vide1
     *
     * @param string $vide1
     * @return DataRecipient
     */
    public function setVide1($vide1)
    {
        $this->vide1 = $vide1;

        return $this;
    }

    /**
     * Get vide1
     *
     * @return string 
     */
    public function getVide1()
    {
        return $this->vide1;
    }

    /**
     * Set vide2
     *
     * @param string $vide2
     * @return DataRecipient
     */
    public function setVide2($vide2)
    {
        $this->vide2 = $vide2;

        return $this;
    }

    /**
     * Get vide2
     *
     * @return string 
     */
    public function getVide2()
    {
        return $this->vide2;
    }

    /**
     * Set vide3
     *
     * @param string $vide3
     * @return DataRecipient
     */
    public function setVide3($vide3)
    {
        $this->vide3 = $vide3;

        return $this;
    }

    /**
     * Get vide3
     *
     * @return string 
     */
    public function getVide3()
    {
        return $this->vide3;
    }

    /**
     * Set vide4
     *
     * @param string $vide4
     * @return DataRecipient
     */
    public function setVide4($vide4)
    {
        $this->vide4 = $vide4;

        return $this;
    }

    /**
     * Get vide4
     *
     * @return string 
     */
    public function getVide4()
    {
        return $this->vide4;
    }

    /**
     * Set vide5
     *
     * @param string $vide5
     * @return DataRecipient
     */
    public function setVide5($vide5)
    {
        $this->vide5 = $vide5;

        return $this;
    }

    /**
     * Get vide5
     *
     * @return string 
     */
    public function getVide5()
    {
        return $this->vide5;
    }

    /**
     * Set vide6
     *
     * @param string $vide6
     * @return DataRecipient
     */
    public function setVide6($vide6)
    {
        $this->vide6 = $vide6;

        return $this;
    }

    /**
     * Get vide6
     *
     * @return string 
     */
    public function getVide6()
    {
        return $this->vide6;
    }

    /**
     * Set vide7
     *
     * @param string $vide7
     * @return DataRecipient
     */
    public function setVide7($vide7)
    {
        $this->vide7 = $vide7;

        return $this;
    }

    /**
     * Get vide7
     *
     * @return string 
     */
    public function getVide7()
    {
        return $this->vide7;
    }

    /**
     * Set vide8
     *
     * @param string $vide8
     * @return DataRecipient
     */
    public function setVide8($vide8)
    {
        $this->vide8 = $vide8;

        return $this;
    }

    /**
     * Get vide8
     *
     * @return string 
     */
    public function getVide8()
    {
        return $this->vide8;
    }

    /**
     * Set vide9
     *
     * @param string $vide9
     * @return DataRecipient
     */
    public function setVide9($vide9)
    {
        $this->vide9 = $vide9;

        return $this;
    }

    /**
     * Get vide9
     *
     * @return string 
     */
    public function getVide9()
    {
        return $this->vide9;
    }

    /**
     * Set vide10
     *
     * @param string $vide10
     * @return DataRecipient
     */
    public function setVide10($vide10)
    {
        $this->vide10 = $vide10;

        return $this;
    }

    /**
     * Get vide10
     *
     * @return string 
     */
    public function getVide10()
    {
        return $this->vide10;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     * @return DataRecipient
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set recipient
     *
     * @param \AppBundle\Entity\Recipient $recipient
     * @return DataRecipient
     */
    public function setRecipient(\AppBundle\Entity\Recipient $recipient = null)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get recipient
     *
     * @return \AppBundle\Entity\Recipient 
     */
    public function getRecipient()
    {
        return $this->recipient;
    }
}
