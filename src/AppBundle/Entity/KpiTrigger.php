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
     * @ORM\Column(name="pct_cli_contact_trigger_WB", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliContactTriggerWB;

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
     * @ORM\Column(name="pct_cli_contact_trigger_WP", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliContactTriggerWP;

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
     * @ORM\Column(name="pct_cli_contact_trigger_AA", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliContactTriggerAA;


    

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
     * Set codeBoutiqueVendeur
     *
     * @param string $codeBoutiqueVendeur
     * @return KpiTrigger
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
     * @return KpiTrigger
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
     * @return KpiTrigger
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

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return KpiTrigger
     */
    public function setDate($date)
    {
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
     * Set nbCliTocontactTriggerA
     *
     * @param integer $nbCliTocontactTriggerA
     * @return KpiTrigger
     */
    public function setNbCliTocontactTriggerA($nbCliTocontactTriggerA)
    {
        $this->nbCliTocontactTriggerA = $nbCliTocontactTriggerA;

        return $this;
    }

    /**
     * Get nbCliTocontactTriggerA
     *
     * @return integer 
     */
    public function getNbCliTocontactTriggerA()
    {
        return $this->nbCliTocontactTriggerA;
    }

    /**
     * Set nbCliContactTriggerA
     *
     * @param integer $nbCliContactTriggerA
     * @return KpiTrigger
     */
    public function setNbCliContactTriggerA($nbCliContactTriggerA)
    {
        $this->nbCliContactTriggerA = $nbCliContactTriggerA;

        return $this;
    }

    /**
     * Get nbCliContactTriggerA
     *
     * @return integer 
     */
    public function getNbCliContactTriggerA()
    {
        return $this->nbCliContactTriggerA;
    }

    /**
     * Set pctCliContactTriggerA
     *
     * @param string $pctCliContactTriggerA
     * @return KpiTrigger
     */
    public function setPctCliContactTriggerA($pctCliContactTriggerA)
    {
        $this->pctCliContactTriggerA = $pctCliContactTriggerA;

        return $this;
    }

    /**
     * Get pctCliContactTriggerA
     *
     * @return string 
     */
    public function getPctCliContactTriggerA()
    {
        return $this->pctCliContactTriggerA;
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
}
