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
 * @ORM\Table(name="app_ligne_vente")
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
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", length=255, nullable=true)
     */
    private $prix;
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
    private $sous_categorie;

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
     * Set prix
     *
     * @param integer $prix
     * @return LigneVente
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
     * Set categorie
     *
     * @param string $categorie
     * @return LigneVente
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
     * Set sous_categorie
     *
     * @param string $sousCategorie
     * @return LigneVente
     */
    public function setSousCategorie($sousCategorie)
    {
        $this->sous_categorie = $sousCategorie;

        return $this;
    }

    /**
     * Get sous_categorie
     *
     * @return string 
     */
    public function getSousCategorie()
    {
        return $this->sous_categorie;
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
     *
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
     *
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
     * Set dateFacture
     *
     * @param \DateTime $dateFacture
     * @return LigneVente
     */
    public function setDateFacture($dateFacture)
    {
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
