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
 * KpiTrigger
 *
 * @ORM\Table(name="app_kpi_trigger", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="UNIQUE_CBV_D", columns={"code_boutique_vendeur", "date"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Entity\KpiTriggerRepository")
 * @UniqueEntity(fields={"user_id", "date"})
 * @ORM\HasLifecycleCallbacks()
 */
class KpiTrigger
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="code_boutique_vendeur", type="string", nullable=true)
     *
     */
    private $codeBoutiqueVendeur;

    /**
     * @var string
     * @ORM\Column(name="point_vente_desc", type="string", nullable=true)
     *
     */
    private $libelle;

    /**
     * @var string
     * @ORM\Column(name="niveau", type="string", nullable=true)
     *
     */
    private $niveau;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /******** TRIGGERS ********/

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tocontact_trigger_AA", type="integer", nullable=true)
     */
    private $nbCliTocontactTriggerAA;


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_contact_trigger_AA", type="integer", nullable=true)
     */
    private $nbCliContactTriggerAA;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_contact_trigger_AA", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliContactTriggerAA;


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tocontact_trigger_WB", type="integer", nullable=true)
     */
    private $nbCliTocontactTriggerWB;


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_contact_trigger_WB", type="integer", nullable=true)
     */
    private $nbCliContactTriggerWB;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_contact_trigger_WB", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliContactTriggerWB;


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tocontact_trigger_WP", type="integer", nullable=true)
     */
    private $nbCliTocontactTriggerWP;


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_contact_trigger_WP", type="integer", nullable=true)
     */
    private $nbCliContactTriggerWP;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_contact_trigger_WP", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliContactTriggerWP;


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tocontact_trigger_WS", type="integer", nullable=true)
     */
    private $nbCliTocontactTriggerWS;


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_contact_trigger_WS", type="integer", nullable=true)
     */
    private $nbCliContactTriggerWS;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_contact_trigger_WS", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliContactTriggerWS;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="kpiTriggers")
     */
    private $user;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function setUser(User $user = null)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return kpiTrigger
     */
    public function setDate($date)
    {
        if( !($date instanceof \DateTime) ) $date = new \DateTime($date);
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set codeBoutiqueVendeur
     *
     * @param string $codeBoutiqueVendeur
     *
     * @return kpiTrigger
     */
    public function setCodeBoutiqueVendeur($codeBoutiqueVendeur)
    {
        $this->codeBoutiqueVendeur = $codeBoutiqueVendeur;
        return $this;
    }

    /**
     * Get codeBoutiqueVendeur
     *
     * @return string
     */
    public function getCodeBoutiqueVendeur()
    {
        return $this->codeBoutiqueVendeur;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return kpiTrigger
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set niveau
     *
     * @param string $niveau
     *
     * @return kpiTrigger
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }


    // Function for sonata to render text-link relative to the entity

    /**
     * __toString
     * 
     * @return string
     */
    public function __toString() {
        return $this->getId();
    }

    /**
     * Set nbCliTocontactTriggerAA
     *
     * @param integer $nbCliTocontactTriggerAA
     * @return KpiTrigger
     */
    public function setNbCliTocontactTriggerAA($nbCliTocontactTriggerAA)
    {
        $this->nbCliTocontactTriggerAA = $nbCliTocontactTriggerAA;

        return $this;
    }

    /**
     * Get nbCliTocontactTriggerAA
     *
     * @return integer 
     */
    public function getNbCliTocontactTriggerAA()
    {
        return $this->nbCliTocontactTriggerAA;
    }

    /**
     * Set nbCliContactTriggerAA
     *
     * @param integer $nbCliContactTriggerAA
     * @return KpiTrigger
     */
    public function setNbCliContactTriggerAA($nbCliContactTriggerAA)
    {
        $this->nbCliContactTriggerAA = $nbCliContactTriggerAA;

        return $this;
    }

    /**
     * Get nbCliContactTriggerAA
     *
     * @return integer 
     */
    public function getNbCliContactTriggerAA()
    {
        return $this->nbCliContactTriggerAA;
    }

    /**
     * Set pctCliContactTriggerAA
     *
     * @param string $pctCliContactTriggerAA
     * @return KpiTrigger
     */
    public function setPctCliContactTriggerAA($pctCliContactTriggerAA)
    {
        $this->pctCliContactTriggerAA = $pctCliContactTriggerAA;

        return $this;
    }

    /**
     * Get pctCliContactTriggerAA
     *
     * @return string 
     */
    public function getPctCliContactTriggerAA()
    {
        return $this->pctCliContactTriggerAA;
    }

    /**
     * Set nbCliTocontactTriggerWB
     *
     * @param integer $nbCliTocontactTriggerWB
     * @return KpiTrigger
     */
    public function setNbCliTocontactTriggerWB($nbCliTocontactTriggerWB)
    {
        $this->nbCliTocontactTriggerWB = $nbCliTocontactTriggerWB;

        return $this;
    }

    /**
     * Get nbCliTocontactTriggerWB
     *
     * @return integer 
     */
    public function getNbCliTocontactTriggerWB()
    {
        return $this->nbCliTocontactTriggerWB;
    }

    /**
     * Set nbCliContactTriggerWB
     *
     * @param integer $nbCliContactTriggerWB
     * @return KpiTrigger
     */
    public function setNbCliContactTriggerWB($nbCliContactTriggerWB)
    {
        $this->nbCliContactTriggerWB = $nbCliContactTriggerWB;

        return $this;
    }

    /**
     * Get nbCliContactTriggerWB
     *
     * @return integer 
     */
    public function getNbCliContactTriggerWB()
    {
        return $this->nbCliContactTriggerWB;
    }

    /**
     * Set pctCliContactTriggerWB
     *
     * @param string $pctCliContactTriggerWB
     * @return KpiTrigger
     */
    public function setPctCliContactTriggerWB($pctCliContactTriggerWB)
    {
        $this->pctCliContactTriggerWB = $pctCliContactTriggerWB;

        return $this;
    }

    /**
     * Get pctCliContactTriggerWB
     *
     * @return string 
     */
    public function getPctCliContactTriggerWB()
    {
        return $this->pctCliContactTriggerWB;
    }

    /**
     * Set nbCliTocontactTriggerWP
     *
     * @param integer $nbCliTocontactTriggerWP
     * @return KpiTrigger
     */
    public function setNbCliTocontactTriggerWP($nbCliTocontactTriggerWP)
    {
        $this->nbCliTocontactTriggerWP = $nbCliTocontactTriggerWP;

        return $this;
    }

    /**
     * Get nbCliTocontactTriggerWP
     *
     * @return integer 
     */
    public function getNbCliTocontactTriggerWP()
    {
        return $this->nbCliTocontactTriggerWP;
    }

    /**
     * Set nbCliContactTriggerWP
     *
     * @param integer $nbCliContactTriggerWP
     * @return KpiTrigger
     */
    public function setNbCliContactTriggerWP($nbCliContactTriggerWP)
    {
        $this->nbCliContactTriggerWP = $nbCliContactTriggerWP;

        return $this;
    }

    /**
     * Get nbCliContactTriggerWP
     *
     * @return integer 
     */
    public function getNbCliContactTriggerWP()
    {
        return $this->nbCliContactTriggerWP;
    }

    /**
     * Set pctCliContactTriggerWP
     *
     * @param string $pctCliContactTriggerWP
     * @return KpiTrigger
     */
    public function setPctCliContactTriggerWP($pctCliContactTriggerWP)
    {
        $this->pctCliContactTriggerWP = $pctCliContactTriggerWP;

        return $this;
    }

    /**
     * Get pctCliContactTriggerWP
     *
     * @return string 
     */
    public function getPctCliContactTriggerWP()
    {
        return $this->pctCliContactTriggerWP;
    }

    /**
     * Set nbCliTocontactTriggerWS
     *
     * @param integer $nbCliTocontactTriggerWS
     * @return KpiTrigger
     */
    public function setNbCliTocontactTriggerWS($nbCliTocontactTriggerWS)
    {
        $this->nbCliTocontactTriggerWS = $nbCliTocontactTriggerWS;

        return $this;
    }

    /**
     * Get nbCliTocontactTriggerWS
     *
     * @return integer 
     */
    public function getNbCliTocontactTriggerWS()
    {
        return $this->nbCliTocontactTriggerWS;
    }

    /**
     * Set nbCliContactTriggerWS
     *
     * @param integer $nbCliContactTriggerWS
     * @return KpiTrigger
     */
    public function setNbCliContactTriggerWS($nbCliContactTriggerWS)
    {
        $this->nbCliContactTriggerWS = $nbCliContactTriggerWS;

        return $this;
    }

    /**
     * Get nbCliContactTriggerWS
     *
     * @return integer 
     */
    public function getNbCliContactTriggerWS()
    {
        return $this->nbCliContactTriggerWS;
    }

    /**
     * Set pctCliContactTriggerWS
     *
     * @param string $pctCliContactTriggerWS
     * @return KpiTrigger
     */
    public function setPctCliContactTriggerWS($pctCliContactTriggerWS)
    {
        $this->pctCliContactTriggerWS = $pctCliContactTriggerWS;

        return $this;
    }

    /**
     * Get pctCliContactTriggerWS
     *
     * @return string 
     */
    public function getPctCliContactTriggerWS()
    {
        return $this->pctCliContactTriggerWS;
    }
}
