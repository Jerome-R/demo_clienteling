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
     * @ORM\Column(name="nb_cli_tocontact_trigger_A", type="integer", nullable=true)
     */
    private $nbCliTocontactTriggerA;


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_contact_trigger_A", type="integer", nullable=true)
     */
    private $nbCliContactTriggerA;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_contact_trigger_A", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliContactTriggerA;


    

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
}
