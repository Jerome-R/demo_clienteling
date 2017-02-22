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
     * @ORM\Column(name="code_uvc", type="string", length=255, nullable=true)
     */
    private $codeUvc;

    /**
     * @var string
     *
     * @ORM\Column(name="sku_desc", type="string", length=255, nullable=true)
     */
    private $skuDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="genre_desc", type="string", length=255, nullable=true)
     */
    private $genreDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="ligne_desc", type="string", length=255, nullable=true)
     */
    private $ligneDesc;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="prix_paye", type="integer", nullable=true)
     */
    private $prixPaye;

    /**
     * @var string
     *
     * @ORM\Column(name="code_vendeur", type="string", length=255, nullable=true)
     */
    private $codevendeur;

    /**
     * @var string
     *
     * @ORM\Column(name="motif_achat", type="string", length=255, nullable=true)
     */
    private $motifAchat;

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
     * @return DataRecipient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

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
     * @return DataRecipient
     */
    public function setIdCampagneName($idCampagneName)
    {
        $this->idCampagneName = $idCampagneName;

        return $this;
    }

    /**
     * Set dateEntree
     *
     * @param \DateTime $dateEntree
     *
     * @return DataRecipient
     */
    public function setDateEntree($dateEntree)
    {
        if( !($dateEntree instanceof \DateTime) ) $dateEntree = new \DateTime($dateEntree);
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
     * @return Recipient
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
     *
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
     * Set codeUvc
     *
     * @param string $codeUvc
     * @return DataRecipient
     */
    public function setCodeUvc($codeUvc)
    {
        $this->codeUvc = $codeUvc;

        return $this;
    }

    /**
     * Get codeUvc
     *
     * @return string 
     */
    public function getCodeUvc()
    {
        return $this->codeUvc;
    }

    /**
     * Set skuDesc
     *
     * @param string $skuDesc
     * @return DataRecipient
     */
    public function setSkuDesc($skuDesc)
    {
        $this->skuDesc = $skuDesc;

        return $this;
    }

    /**
     * Get skuDesc
     *
     * @return string 
     */
    public function getSkuDesc()
    {
        return $this->skuDesc;
    }

    /**
     * Set genreDesc
     *
     * @param string $genreDesc
     * @return DataRecipient
     */
    public function setGenreDesc($genreDesc)
    {
        $this->genreDesc = $genreDesc;

        return $this;
    }

    /**
     * Get genreDesc
     *
     * @return string 
     */
    public function getGenreDesc()
    {
        return $this->genreDesc;
    }

    /**
     * Set ligneDesc
     *
     * @param string $ligneDesc
     * @return DataRecipient
     */
    public function setLigneDesc($ligneDesc)
    {
        $this->ligneDesc = $ligneDesc;

        return $this;
    }

    /**
     * Get ligneDesc
     *
     * @return string 
     */
    public function getLigneDesc()
    {
        return $this->ligneDesc;
    }

    /**
     * Set prixPaye
     *
     * @param integer $prixPaye
     * @return DataRecipient
     */
    public function setPrixPaye($prixPaye)
    {
        $this->prixPaye = $prixPaye;

        return $this;
    }

    /**
     * Get prixPaye
     *
     * @return integer 
     */
    public function getPrixPaye()
    {
        return $this->prixPaye;
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
     * Set motifAchat
     *
     * @param string $motifAchat
     * @return Client
     */
    public function setMotifAchat($motifAchat)
    {
        $this->motifAchat = $motifAchat;

        return $this;
    }

    /**
     * Get motifAchat
     *
     * @return string 
     */
    public function getMotifAchat()
    {
        return $this->motifAchat;
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
}