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
 * Ticket
 *
 * @ORM\Table(name="app_ticket")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TicketRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Ticket
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
     * @ORM\Column(name="ticket_uniq_id", type="string", length=255, unique=true)
     */
    private $ticketUniqId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_facture", type="datetime", nullable=true)
     */
    private $dateFacture; 


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="tickets")
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\LigneVente", mappedBy="ticket")
     */
    private $ligneVentes;


    /**
     * Constructor
     */
    public function __construct()
    {
        $ligneVentes = new ArrayCollection();
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
     * Set ticketUniqId
     *
     * @param string $ticketUniqId
     * @return Ticket
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
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     * @return LigneVente
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
     * Add ligneVente
     *
     * @param LigneVente $ligneVente
     * @return TopClient
     */
    public function addLigneVente(LigneVente $ligneVente)
    {
        $this->ligneVentes[] = $ligneVente;

        return $this;
    }

    /**
     * Remove ligneVente
     *
     * @param LigneVente $ligneVente
     */
    public function removeLigneVente(LigneVente $ligneVente)
    {
        $this->ligneVentes->removeElement($ligneVente);
    }

    /**
     * Get ligneVentes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLigneVentes()
    {
        return $this->ligneVentes;
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
     * __toString
     * 
     * @return string
     */
    public function __toString() {
        return $this->getticketUniqId();
    }

}
