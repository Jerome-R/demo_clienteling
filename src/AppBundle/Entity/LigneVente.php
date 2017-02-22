<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * LigneVente
 *
 * @ORM\Table(name="app_ligne_vente", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="UNIQUE_LV_ticket", columns={"ticket_uniq_id", "codeuvc", "quantite","code_vendeur", "type_vente"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Entity\LigneVenteRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class LigneVente
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
     * @ORM\Column(name="codeuvc", type="string", length=255, nullable=true)
     */
    private $codeuvc;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var integer
     *
     * @ORM\Column(name="cattc", type="integer", length=255, nullable=true)
     */
    private $cattc;

    /**
     * @var integer
     *
     * @ORM\Column(name="remise_ttc", type="integer", length=255, nullable=true)
     */
    private $remiseTtc;

    /**
     * @var string
     *
     * @ORM\Column(name="super_ligne_desc", type="string", length=255, nullable=true)
     */
    private $superLigneDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="sku_desc", type="string", length=255, nullable=true)
     */
    private $skuDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="ticket_uniq_id", type="string", length=255, nullable=true)
     */
    private $ticketUniqId;

    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="string", length=255, nullable=true)
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="code_vendeur", type="string", length=255, nullable=true)
     */
    private $codeVendeur;

    /**
     * @var string
     *
     * @ORM\Column(name="point_vente_id", type="string", length=255, nullable=true)
     */
    private $pointVenteId;

    /**
     * @var string
     *
     * @ORM\Column(name="type_vente", type="string", length=255, nullable=true)
     */
    private $typeVente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_facture", type="datetime", nullable=true)
     */
    private $dateFacture; 

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modif", type="datetime", nullable=true)
     */
    private $dateModif; 

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ticket", inversedBy="ligneVentes")
     */
    private $ticket;


    /**
     * Constructor
     */
    public function __construct()
    {

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
     * __toString
     * 
     * @return string
     */
    public function __toString() {
        return $this->getId();
    }


    /**
     * Set codeuvc
     *
     * @param string $codeuvc
     * @return LigneVente
     */
    public function setCodeuvc($codeuvc)
    {
        $this->codeuvc = $codeuvc;

        return $this;
    }

    /**
     * Get codeuvc
     *
     * @return string 
     */
    public function getCodeuvc()
    {
        return $this->codeuvc;
    }


    /**
     * Set pointVenteId
     *
     * @param string $pointVenteId
     * @return LigneVente
     */
    public function setPointVenteId($pointVenteId)
    {
        $this->pointVenteId = $pointVenteId;

        return $this;
    }

    /**
     * Get pointVenteId
     *
     * @return string 
     */
    public function getPointVenteId()
    {
        return $this->pointVenteId;
    }


    /**
     * Set ticketUniqId
     *
     * @param string $ticketUniqId
     * @return LigneVente
     */
    public function setTicketUniqId($ticketUniqId)
    {
        $this->ticketUniqId = $ticketUniqId;

        return $this;
    }

    /**
     * Get ticketUniqId
     *
     * @return string 
     */
    public function getTicketUniqId()
    {
        return $this->ticketUniqId;
    }


    /**
     * Set clientId
     * @param string $clientId
     * @return LigneVente
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return string 
     */
    public function getClientId()
    {
        return $this->clientId;
    }


    /**
     * Set codeVendeur
     * @param string $codeVendeur
     * @return LigneVente
     */
    public function setCodeVendeur($codeVendeur)
    {
        $this->codeVendeur = $codeVendeur;

        return $this;
    }

    /**
     * Get codeVendeur
     *
     * @return string 
     */
    public function getCodeVendeur()
    {
        return $this->codeVendeur;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return LigneVente
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set cattc
     *
     * @param integer $cattc
     * @return LigneVente
     */
    public function setCattc($cattc)
    {
        $this->cattc = $cattc;

        return $this;
    }

    /**
     * Get remiseTtc
     *
     * @return integer 
     */
    public function getRemiseTtc()
    {
        return $this->remiseTtc;
    }

    /**
     * Set remiseTtc
     *
     * @param integer $remiseTtc
     * @return LigneVente
     */
    public function setRemiseTtc($remiseTtc)
    {
        $this->remiseTtc = $remiseTtc;

        return $this;
    }

    /**
     * Get cattc
     *
     * @return integer 
     */
    public function getCattc()
    {
        return $this->cattc;
    }

    /**
     * Set superLigneDesc
     *
     * @param string $superLigneDesc
     * @return LigneVente
     */
    public function setSuperLigneDesc($superLigneDesc)
    {
        $this->superLigneDesc = $superLigneDesc;

        return $this;
    }

    /**
     * Get superLigneDesc
     *
     * @return string 
     */
    public function getSuperLigneDesc()
    {
        return $this->superLigneDesc;
    }

    /**
     * Set skuDesc
     *
     * @param string $skuDesc
     * @return LigneVente
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
     * Set dateFacture
     *
     * @param \DateTime $dateFacture
     * @return LigneVente
     */
    public function setDateFacture($dateFacture)
    {
        if( !($dateFacture instanceof \DateTime) ) $dateFacture = new \DateTime($dateFacture);
        $this->dateFacture = $dateFacture;

        return $this;
    }

    /**
     * Get dateFacture
     *
     * @return \DateTime 
     */
    public function getDateFacture()
    {
        return $this->dateFacture;
    }

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     * @return LigneVente
     */
    public function setDateModif($dateModif)
    {
        if( !($dateModif instanceof \DateTime) ) $dateModif = new \DateTime($dateModif);
        $this->dateModif = $dateModif;

        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime 
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }

    /**
     * Set ticket
     *
     * @param \AppBundle\Entity\Ticket $ticket
     * @return LigneVente
     */
    public function setTicket(\AppBundle\Entity\Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \AppBundle\Entity\Ticket 
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
