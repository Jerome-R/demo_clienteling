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
 * KpiCapture
 *
 * @ORM\Table(name="app_kpi_capture", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="UNIQUE_CBV_D", columns={"code_boutique_vendeur", "date"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Entity\KpiCaptureRepository")
 * @UniqueEntity(fields={"user_id", "date"})
 * @ORM\HasLifecycleCallbacks()
 */
class KpiCapture
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


    /******** MENS_LOC ********/


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_m_l", type="integer", nullable=true)
     */
    private $nbCliML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_valid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliCoordValidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_nonvalid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliCoordNonvalidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_nonrens_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliCoordNonrensML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_valid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliEmailValidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_nonvalid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliEmailNonvalidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_nonrens_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliEmailNonrensML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_valid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliTelValidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_nonvalid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliTelNonvalidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_nonrens_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliTelNonrensML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_valid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliAddValidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_nonrens_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliAddNonrensML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_nonvalid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliAddNonvalidML;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_m_l", type="integer", nullable=true)
     */
    private $nbCliActifsML;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_new_m_l", type="integer", nullable=true)
     */
    private $nbCliActifsNewML;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_exist_m_l", type="integer", nullable=true)
     */
    private $nbCliActifsExistML;


    /******** YEAR_LOC ********/


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_y_l", type="integer", nullable=true)
     */
    private $nbCliYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_valid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliCoordValidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_nonvalid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliCoordNonvalidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_nonrens_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliCoordNonrensYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_valid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliEmailValidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_nonvalid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliEmailNonvalidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_nonrens_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliEmailNonrensYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_valid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliTelValidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_nonvalid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliTelNonvalidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_nonrens_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliTelNonrensYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_valid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliAddValidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_nonrens_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliAddNonrensYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_nonvalid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliAddNonvalidYL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_y_l", type="integer", nullable=true)
     */
    private $nbCliActifsYL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_new_y_l", type="integer", nullable=true)
     */
    private $nbCliActifsNewYL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_exist_y_l", type="integer", nullable=true)
     */
    private $nbCliActifsExistYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_email_y_l", type="integer", nullable=true)
     */
    private $nbEmailYL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_tel_y_l", type="integer", nullable=true)
     */
    private $nbTelYL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_adr_y_l", type="integer", nullable=true)
     */
    private $nbAdrYL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="pct_cli_donnees_nonvalid_y_l", type="integer", nullable=true)
     */
    private $pctCliDonneesNonvalidYL;


    /*******YL********/
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_email_nonvalid_y_l", type="integer", nullable=true)
     */
    private $nbEmailNonvalidYL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_tel_nonvalid_y_l", type="integer", nullable=true)
     */
    private $nbTelNonvalidYL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_adr_nonvalid_y_l", type="integer", nullable=true)
     */
    private $nbAdrNonvalidYL;  


    /**** TRANSACTIONS  ******/

    /***   YEAR   ****/

     /**
     * @var integer
     *
     * @ORM\Column(name="nb_trans_linked_y", type="integer", nullable=true)
     */
    private $nbTransLinkedY;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="nb_trans_not_linked_y", type="integer", nullable=true)
     */
    private $nbTransNotLinkedY;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_trans_not_linked_y", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctTransNotLinkedY;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_trans_linked_y", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctTransLinkedY;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="nb_trans_tot_y", type="integer", nullable=true)
     */
    private $nbTransTotY;
    

    /***   MONTH   ****/

     /**
     * @var integer
     *
     * @ORM\Column(name="nb_trans_linked_m", type="integer", nullable=true)
     */
    private $nbTransLinkedM;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="nb_trans_not_linked_m", type="integer", nullable=true)
     */
    private $nbTransNotLinkedM;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_trans_not_linked_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctTransNotLinkedM;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_trans_linked_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctTransLinkedM;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_trans_tot_m", type="integer", nullable=true)
     */
    private $nbTransTotM;



    /***** NOMBRE COMPLEMENT AUX POURCENTAGES *****/

    /* ML */

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_optin_m_l", type="integer", nullable=true)
     */
    private $nbOptinML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_optout_m_l", type="integer", nullable=true)
     */
    private $nbOptoutML;

    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_optin_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctOptinML;

    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_optout_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctOptoutML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_valid_m_l", type="integer", nullable=true)
     */
    private $nbCliCoordValidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_nonvalid_m_l", type="integer", nullable=true)
     */
    private $nbCliCoordNonvalidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_nonrens_m_l", type="integer", nullable=true)
     */
    private $nbCliCoordNonrensML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_valid_m_l", type="integer", nullable=true)
     */
    private $nbCliEmailValidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_nonvalid_m_l", type="integer", nullable=true)
     */
    private $nbCliEmailNonvalidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_nonrens_m_l", type="integer", nullable=true)
     */
    private $nbCliEmailNonrensML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_valid_m_l", type="integer", nullable=true)
     */
    private $nbCliTelValidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_nonvalid_m_l", type="integer", nullable=true)
     */
    private $nbCliTelNonvalidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_nonrens_m_l", type="integer", nullable=true)
     */
    private $nbCliTelNonrensML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_valid_m_l", type="integer", nullable=true)
     */
    private $nbCliAddValidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_nonvalid_m_l", type="integer", nullable=true)
     */
    private $nbCliAddNonvalidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_nonrens_m_l", type="integer", nullable=true)
     */
    private $nbCliAddNonrensML;



    /***** NOMBRE COMPLEMENT AUX POURCENTAGES *****/

    /* YL */

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_optin_y_l", type="integer", nullable=true)
     */
    private $nbOptinYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_optout_y_l", type="integer", nullable=true)
     */
    private $nbOptoutYL;

    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_optin_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctOptinYL;

    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_optout_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctOptoutYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_valid_y_l", type="integer", nullable=true)
     */
    private $nbCliCoordValidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_nonvalid_y_l", type="integer", nullable=true)
     */
    private $nbCliCoordNonvalidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_nonrens_y_l", type="integer", nullable=true)
     */
    private $nbCliCoordNonrensYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_valid_y_l", type="integer", nullable=true)
     */
    private $nbCliEmailValidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_nonvalid_y_l", type="integer", nullable=true)
     */
    private $nbCliEmailNonvalidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_nonrens_y_l", type="integer", nullable=true)
     */
    private $nbCliEmailNonrensYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_valid_y_l", type="integer", nullable=true)
     */
    private $nbCliTelValidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_nonvalid_y_l", type="integer", nullable=true)
     */
    private $nbCliTelNonvalidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_nonrens_y_l", type="integer", nullable=true)
     */
    private $nbCliTelNonrensYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_valid_y_l", type="integer", nullable=true)
     */
    private $nbCliAddValidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_nonvalid_y_l", type="integer", nullable=true)
     */
    private $nbCliAddNonvalidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_nonrens_y_l", type="integer", nullable=true)
     */
    private $nbCliAddNonrensYL;
    
                                   
    

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="kpiCaptures")
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
     * @return KpiCapture
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
     * @return KpiCapture
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
     * @return KpiCapture
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
     * @return KpiCapture
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
     * Set nbCliML
     *
     * @param integer $nbCliML
     * @return KpiCapture
     */
    public function setNbCliML($nbCliML)
    {
        $this->nbCliML = $nbCliML;

        return $this;
    }

    /**
     * Get nbCliML
     *
     * @return integer 
     */
    public function getNbCliML()
    {
        return $this->nbCliML;
    }

    /**
     * Set pctCliCoordValidML
     *
     * @param string $pctCliCoordValidML
     * @return KpiCapture
     */
    public function setPctCliCoordValidML($pctCliCoordValidML)
    {
        $this->pctCliCoordValidML = $pctCliCoordValidML;

        return $this;
    }

    /**
     * Get pctCliCoordValidML
     *
     * @return string 
     */
    public function getPctCliCoordValidML()
    {
        return $this->pctCliCoordValidML;
    }

    /**
     * Set pctCliCoordNonvalidML
     *
     * @param string $pctCliCoordNonvalidML
     * @return KpiCapture
     */
    public function setPctCliCoordNonvalidML($pctCliCoordNonvalidML)
    {
        $this->pctCliCoordNonvalidML = $pctCliCoordNonvalidML;

        return $this;
    }

    /**
     * Get pctCliCoordNonvalidML
     *
     * @return string 
     */
    public function getPctCliCoordNonvalidML()
    {
        return $this->pctCliCoordNonvalidML;
    }

    /**
     * Set pctCliCoordNonrensML
     *
     * @param string $pctCliCoordNonrensML
     * @return KpiCapture
     */
    public function setPctCliCoordNonrensML($pctCliCoordNonrensML)
    {
        $this->pctCliCoordNonrensML = $pctCliCoordNonrensML;

        return $this;
    }

    /**
     * Get pctCliCoordNonrensML
     *
     * @return string 
     */
    public function getPctCliCoordNonrensML()
    {
        return $this->pctCliCoordNonrensML;
    }

    /**
     * Set pctCliEmailValidML
     *
     * @param string $pctCliEmailValidML
     * @return KpiCapture
     */
    public function setPctCliEmailValidML($pctCliEmailValidML)
    {
        $this->pctCliEmailValidML = $pctCliEmailValidML;

        return $this;
    }

    /**
     * Get pctCliEmailValidML
     *
     * @return string 
     */
    public function getPctCliEmailValidML()
    {
        return $this->pctCliEmailValidML;
    }

    /**
     * Set pctCliEmailNonvalidML
     *
     * @param string $pctCliEmailNonvalidML
     * @return KpiCapture
     */
    public function setPctCliEmailNonvalidML($pctCliEmailNonvalidML)
    {
        $this->pctCliEmailNonvalidML = $pctCliEmailNonvalidML;

        return $this;
    }

    /**
     * Get pctCliEmailNonvalidML
     *
     * @return string 
     */
    public function getPctCliEmailNonvalidML()
    {
        return $this->pctCliEmailNonvalidML;
    }

    /**
     * Set pctCliEmailNonrensML
     *
     * @param string $pctCliEmailNonrensML
     * @return KpiCapture
     */
    public function setPctCliEmailNonrensML($pctCliEmailNonrensML)
    {
        $this->pctCliEmailNonrensML = $pctCliEmailNonrensML;

        return $this;
    }

    /**
     * Get pctCliEmailNonrensML
     *
     * @return string 
     */
    public function getPctCliEmailNonrensML()
    {
        return $this->pctCliEmailNonrensML;
    }

    /**
     * Set pctCliTelValidML
     *
     * @param string $pctCliTelValidML
     * @return KpiCapture
     */
    public function setPctCliTelValidML($pctCliTelValidML)
    {
        $this->pctCliTelValidML = $pctCliTelValidML;

        return $this;
    }

    /**
     * Get pctCliTelValidML
     *
     * @return string 
     */
    public function getPctCliTelValidML()
    {
        return $this->pctCliTelValidML;
    }

    /**
     * Set pctCliTelNonvalidML
     *
     * @param string $pctCliTelNonvalidML
     * @return KpiCapture
     */
    public function setPctCliTelNonvalidML($pctCliTelNonvalidML)
    {
        $this->pctCliTelNonvalidML = $pctCliTelNonvalidML;

        return $this;
    }

    /**
     * Get pctCliTelNonvalidML
     *
     * @return string 
     */
    public function getPctCliTelNonvalidML()
    {
        return $this->pctCliTelNonvalidML;
    }

    /**
     * Set pctCliTelNonrensML
     *
     * @param string $pctCliTelNonrensML
     * @return KpiCapture
     */
    public function setPctCliTelNonrensML($pctCliTelNonrensML)
    {
        $this->pctCliTelNonrensML = $pctCliTelNonrensML;

        return $this;
    }

    /**
     * Get pctCliTelNonrensML
     *
     * @return string 
     */
    public function getPctCliTelNonrensML()
    {
        return $this->pctCliTelNonrensML;
    }

    /**
     * Set pctCliAddValidML
     *
     * @param string $pctCliAddValidML
     * @return KpiCapture
     */
    public function setPctCliAddValidML($pctCliAddValidML)
    {
        $this->pctCliAddValidML = $pctCliAddValidML;

        return $this;
    }

    /**
     * Get pctCliAddValidML
     *
     * @return string 
     */
    public function getPctCliAddValidML()
    {
        return $this->pctCliAddValidML;
    }

    /**
     * Set pctCliAddNonrensML
     *
     * @param string $pctCliAddNonrensML
     * @return KpiCapture
     */
    public function setPctCliAddNonrensML($pctCliAddNonrensML)
    {
        $this->pctCliAddNonrensML = $pctCliAddNonrensML;

        return $this;
    }

    /**
     * Get pctCliAddNonrensML
     *
     * @return string 
     */
    public function getPctCliAddNonrensML()
    {
        return $this->pctCliAddNonrensML;
    }

    /**
     * Set pctCliAddNonvalidML
     *
     * @param string $pctCliAddNonvalidML
     * @return KpiCapture
     */
    public function setPctCliAddNonvalidML($pctCliAddNonvalidML)
    {
        $this->pctCliAddNonvalidML = $pctCliAddNonvalidML;

        return $this;
    }

    /**
     * Get pctCliAddNonvalidML
     *
     * @return string 
     */
    public function getPctCliAddNonvalidML()
    {
        return $this->pctCliAddNonvalidML;
    }

    /**
     * Set nbCliActifsML
     *
     * @param integer $nbCliActifsML
     * @return KpiCapture
     */
    public function setNbCliActifsML($nbCliActifsML)
    {
        $this->nbCliActifsML = $nbCliActifsML;

        return $this;
    }

    /**
     * Get nbCliActifsML
     *
     * @return integer 
     */
    public function getNbCliActifsML()
    {
        return $this->nbCliActifsML;
    }

    /**
     * Set nbCliActifsNewML
     *
     * @param integer $nbCliActifsNewML
     * @return KpiCapture
     */
    public function setNbCliActifsNewML($nbCliActifsNewML)
    {
        $this->nbCliActifsNewML = $nbCliActifsNewML;

        return $this;
    }

    /**
     * Get nbCliActifsNewML
     *
     * @return integer 
     */
    public function getNbCliActifsNewML()
    {
        return $this->nbCliActifsNewML;
    }

    /**
     * Set nbCliActifsExistML
     *
     * @param integer $nbCliActifsExistML
     * @return KpiCapture
     */
    public function setNbCliActifsExistML($nbCliActifsExistML)
    {
        $this->nbCliActifsExistML = $nbCliActifsExistML;

        return $this;
    }

    /**
     * Get nbCliActifsExistML
     *
     * @return integer 
     */
    public function getNbCliActifsExistML()
    {
        return $this->nbCliActifsExistML;
    }

    /**
     * Set nbCliYL
     *
     * @param integer $nbCliYL
     * @return KpiCapture
     */
    public function setNbCliYL($nbCliYL)
    {
        $this->nbCliYL = $nbCliYL;

        return $this;
    }

    /**
     * Get nbCliYL
     *
     * @return integer 
     */
    public function getNbCliYL()
    {
        return $this->nbCliYL;
    }

    /**
     * Set pctCliCoordValidYL
     *
     * @param string $pctCliCoordValidYL
     * @return KpiCapture
     */
    public function setPctCliCoordValidYL($pctCliCoordValidYL)
    {
        $this->pctCliCoordValidYL = $pctCliCoordValidYL;

        return $this;
    }

    /**
     * Get pctCliCoordValidYL
     *
     * @return string 
     */
    public function getPctCliCoordValidYL()
    {
        return $this->pctCliCoordValidYL;
    }

    /**
     * Set pctCliCoordNonvalidYL
     *
     * @param string $pctCliCoordNonvalidYL
     * @return KpiCapture
     */
    public function setPctCliCoordNonvalidYL($pctCliCoordNonvalidYL)
    {
        $this->pctCliCoordNonvalidYL = $pctCliCoordNonvalidYL;

        return $this;
    }

    /**
     * Get pctCliCoordNonvalidYL
     *
     * @return string 
     */
    public function getPctCliCoordNonvalidYL()
    {
        return $this->pctCliCoordNonvalidYL;
    }

    /**
     * Set pctCliCoordNonrensYL
     *
     * @param string $pctCliCoordNonrensYL
     * @return KpiCapture
     */
    public function setPctCliCoordNonrensYL($pctCliCoordNonrensYL)
    {
        $this->pctCliCoordNonrensYL = $pctCliCoordNonrensYL;

        return $this;
    }

    /**
     * Get pctCliCoordNonrensYL
     *
     * @return string 
     */
    public function getPctCliCoordNonrensYL()
    {
        return $this->pctCliCoordNonrensYL;
    }

    /**
     * Set pctCliEmailValidYL
     *
     * @param string $pctCliEmailValidYL
     * @return KpiCapture
     */
    public function setPctCliEmailValidYL($pctCliEmailValidYL)
    {
        $this->pctCliEmailValidYL = $pctCliEmailValidYL;

        return $this;
    }

    /**
     * Get pctCliEmailValidYL
     *
     * @return string 
     */
    public function getPctCliEmailValidYL()
    {
        return $this->pctCliEmailValidYL;
    }

    /**
     * Set pctCliEmailNonvalidYL
     *
     * @param string $pctCliEmailNonvalidYL
     * @return KpiCapture
     */
    public function setPctCliEmailNonvalidYL($pctCliEmailNonvalidYL)
    {
        $this->pctCliEmailNonvalidYL = $pctCliEmailNonvalidYL;

        return $this;
    }

    /**
     * Get pctCliEmailNonvalidYL
     *
     * @return string 
     */
    public function getPctCliEmailNonvalidYL()
    {
        return $this->pctCliEmailNonvalidYL;
    }

    /**
     * Set pctCliEmailNonrensYL
     *
     * @param string $pctCliEmailNonrensYL
     * @return KpiCapture
     */
    public function setPctCliEmailNonrensYL($pctCliEmailNonrensYL)
    {
        $this->pctCliEmailNonrensYL = $pctCliEmailNonrensYL;

        return $this;
    }

    /**
     * Get pctCliEmailNonrensYL
     *
     * @return string 
     */
    public function getPctCliEmailNonrensYL()
    {
        return $this->pctCliEmailNonrensYL;
    }

    /**
     * Set pctCliTelValidYL
     *
     * @param string $pctCliTelValidYL
     * @return KpiCapture
     */
    public function setPctCliTelValidYL($pctCliTelValidYL)
    {
        $this->pctCliTelValidYL = $pctCliTelValidYL;

        return $this;
    }

    /**
     * Get pctCliTelValidYL
     *
     * @return string 
     */
    public function getPctCliTelValidYL()
    {
        return $this->pctCliTelValidYL;
    }

    /**
     * Set pctCliTelNonvalidYL
     *
     * @param string $pctCliTelNonvalidYL
     * @return KpiCapture
     */
    public function setPctCliTelNonvalidYL($pctCliTelNonvalidYL)
    {
        $this->pctCliTelNonvalidYL = $pctCliTelNonvalidYL;

        return $this;
    }

    /**
     * Get pctCliTelNonvalidYL
     *
     * @return string 
     */
    public function getPctCliTelNonvalidYL()
    {
        return $this->pctCliTelNonvalidYL;
    }

    /**
     * Set pctCliTelNonrensYL
     *
     * @param string $pctCliTelNonrensYL
     * @return KpiCapture
     */
    public function setPctCliTelNonrensYL($pctCliTelNonrensYL)
    {
        $this->pctCliTelNonrensYL = $pctCliTelNonrensYL;

        return $this;
    }

    /**
     * Get pctCliTelNonrensYL
     *
     * @return string 
     */
    public function getPctCliTelNonrensYL()
    {
        return $this->pctCliTelNonrensYL;
    }

    /**
     * Set pctCliAddValidYL
     *
     * @param string $pctCliAddValidYL
     * @return KpiCapture
     */
    public function setPctCliAddValidYL($pctCliAddValidYL)
    {
        $this->pctCliAddValidYL = $pctCliAddValidYL;

        return $this;
    }

    /**
     * Get pctCliAddValidYL
     *
     * @return string 
     */
    public function getPctCliAddValidYL()
    {
        return $this->pctCliAddValidYL;
    }

    /**
     * Set pctCliAddNonrensYL
     *
     * @param string $pctCliAddNonrensYL
     * @return KpiCapture
     */
    public function setPctCliAddNonrensYL($pctCliAddNonrensYL)
    {
        $this->pctCliAddNonrensYL = $pctCliAddNonrensYL;

        return $this;
    }

    /**
     * Get pctCliAddNonrensYL
     *
     * @return string 
     */
    public function getPctCliAddNonrensYL()
    {
        return $this->pctCliAddNonrensYL;
    }

    /**
     * Set pctCliAddNonvalidYL
     *
     * @param string $pctCliAddNonvalidYL
     * @return KpiCapture
     */
    public function setPctCliAddNonvalidYL($pctCliAddNonvalidYL)
    {
        $this->pctCliAddNonvalidYL = $pctCliAddNonvalidYL;

        return $this;
    }

    /**
     * Get pctCliAddNonvalidYL
     *
     * @return string 
     */
    public function getPctCliAddNonvalidYL()
    {
        return $this->pctCliAddNonvalidYL;
    }

    /**
     * Set nbCliActifsYL
     *
     * @param integer $nbCliActifsYL
     * @return KpiCapture
     */
    public function setNbCliActifsYL($nbCliActifsYL)
    {
        $this->nbCliActifsYL = $nbCliActifsYL;

        return $this;
    }

    /**
     * Get nbCliActifsYL
     *
     * @return integer 
     */
    public function getNbCliActifsYL()
    {
        return $this->nbCliActifsYL;
    }

    /**
     * Set nbCliActifsNewYL
     *
     * @param integer $nbCliActifsNewYL
     * @return KpiCapture
     */
    public function setNbCliActifsNewYL($nbCliActifsNewYL)
    {
        $this->nbCliActifsNewYL = $nbCliActifsNewYL;

        return $this;
    }

    /**
     * Get nbCliActifsNewYL
     *
     * @return integer 
     */
    public function getNbCliActifsNewYL()
    {
        return $this->nbCliActifsNewYL;
    }

    /**
     * Set nbCliActifsExistYL
     *
     * @param integer $nbCliActifsExistYL
     * @return KpiCapture
     */
    public function setNbCliActifsExistYL($nbCliActifsExistYL)
    {
        $this->nbCliActifsExistYL = $nbCliActifsExistYL;

        return $this;
    }

    /**
     * Get nbCliActifsExistYL
     *
     * @return integer 
     */
    public function getNbCliActifsExistYL()
    {
        return $this->nbCliActifsExistYL;
    }

    /**
     * Set nbEmailYL
     *
     * @param integer $nbEmailYL
     * @return KpiCapture
     */
    public function setNbEmailYL($nbEmailYL)
    {
        $this->nbEmailYL = $nbEmailYL;

        return $this;
    }

    /**
     * Get nbEmailYL
     *
     * @return integer 
     */
    public function getNbEmailYL()
    {
        return $this->nbEmailYL;
    }

    /**
     * Set nbTelYL
     *
     * @param integer $nbTelYL
     * @return KpiCapture
     */
    public function setNbTelYL($nbTelYL)
    {
        $this->nbTelYL = $nbTelYL;

        return $this;
    }

    /**
     * Get nbTelYL
     *
     * @return integer 
     */
    public function getNbTelYL()
    {
        return $this->nbTelYL;
    }

    /**
     * Set nbAdrYL
     *
     * @param integer $nbAdrYL
     * @return KpiCapture
     */
    public function setNbAdrYL($nbAdrYL)
    {
        $this->nbAdrYL = $nbAdrYL;

        return $this;
    }

    /**
     * Get nbAdrYL
     *
     * @return integer 
     */
    public function getNbAdrYL()
    {
        return $this->nbAdrYL;
    }

    /**
     * Set pctCliDonneesNonvalidYL
     *
     * @param integer $pctCliDonneesNonvalidYL
     * @return KpiCapture
     */
    public function setPctCliDonneesNonvalidYL($pctCliDonneesNonvalidYL)
    {
        $this->pctCliDonneesNonvalidYL = $pctCliDonneesNonvalidYL;

        return $this;
    }

    /**
     * Get pctCliDonneesNonvalidYL
     *
     * @return integer 
     */
    public function getPctCliDonneesNonvalidYL()
    {
        return $this->pctCliDonneesNonvalidYL;
    }

    /**
     * Set nbProspYL
     *
     * @param integer $nbProspYL
     * @return KpiCapture
     */
    public function setNbProspYL($nbProspYL)
    {
        $this->nbProspYL = $nbProspYL;

        return $this;
    }

    /**
     * Get nbProspYL
     *
     * @return integer 
     */
    public function getNbProspYL()
    {
        return $this->nbProspYL;
    }

    /**
     * Set nbEmailNonvalidYL
     *
     * @param integer $nbEmailNonvalidYL
     * @return KpiCapture
     */
    public function setNbEmailNonvalidYL($nbEmailNonvalidYL)
    {
        $this->nbEmailNonvalidYL = $nbEmailNonvalidYL;

        return $this;
    }

    /**
     * Get nbEmailNonvalidYL
     *
     * @return integer 
     */
    public function getNbEmailNonvalidYL()
    {
        return $this->nbEmailNonvalidYL;
    }

    /**
     * Set nbTelNonvalidYL
     *
     * @param integer $nbTelNonvalidYL
     * @return KpiCapture
     */
    public function setNbTelNonvalidYL($nbTelNonvalidYL)
    {
        $this->nbTelNonvalidYL = $nbTelNonvalidYL;

        return $this;
    }

    /**
     * Get nbTelNonvalidYL
     *
     * @return integer 
     */
    public function getNbTelNonvalidYL()
    {
        return $this->nbTelNonvalidYL;
    }

    /**
     * Set nbAdrNonvalidYL
     *
     * @param integer $nbAdrNonvalidYL
     * @return KpiCapture
     */
    public function setNbAdrNonvalidYL($nbAdrNonvalidYL)
    {
        $this->nbAdrNonvalidYL = $nbAdrNonvalidYL;

        return $this;
    }

    /**
     * Get nbAdrNonvalidYL
     *
     * @return integer 
     */
    public function getNbAdrNonvalidYL()
    {
        return $this->nbAdrNonvalidYL;
    }

    /**
     * Set nbTransLinkedY
     *
     * @param integer $nbTransLinkedY
     * @return KpiCapture
     */
    public function setNbTransLinkedY($nbTransLinkedY)
    {
        $this->nbTransLinkedY = $nbTransLinkedY;

        return $this;
    }

    /**
     * Get nbTransLinkedY
     *
     * @return integer 
     */
    public function getNbTransLinkedY()
    {
        return $this->nbTransLinkedY;
    }

    /**
     * Set nbTransLocalY
     *
     * @param integer $nbTransLocalY
     * @return KpiCapture
     */
    public function setNbTransLocalY($nbTransLocalY)
    {
        $this->nbTransLocalY = $nbTransLocalY;

        return $this;
    }

    /**
     * Get nbTransLocalY
     *
     * @return integer 
     */
    public function getNbTransLocalY()
    {
        return $this->nbTransLocalY;
    }

    /**
     * Set pctTransLocalY
     *
     * @param string $pctTransLocalY
     * @return KpiCapture
     */
    public function setPctTransLocalY($pctTransLocalY)
    {
        $this->pctTransLocalY = $pctTransLocalY;

        return $this;
    }

    /**
     * Get pctTransLocalY
     *
     * @return string 
     */
    public function getPctTransLocalY()
    {
        return $this->pctTransLocalY;
    }

    /**
     * Set nbTransNlocalY
     *
     * @param integer $nbTransNlocalY
     * @return KpiCapture
     */
    public function setNbTransNlocalY($nbTransNlocalY)
    {
        $this->nbTransNlocalY = $nbTransNlocalY;

        return $this;
    }

    /**
     * Get nbTransNlocalY
     *
     * @return integer 
     */
    public function getNbTransNlocalY()
    {
        return $this->nbTransNlocalY;
    }

    /**
     * Set pctTransNlocalY
     *
     * @param string $pctTransNlocalY
     * @return KpiCapture
     */
    public function setPctTransNlocalY($pctTransNlocalY)
    {
        $this->pctTransNlocalY = $pctTransNlocalY;

        return $this;
    }

    /**
     * Get pctTransNlocalY
     *
     * @return string 
     */
    public function getPctTransNlocalY()
    {
        return $this->pctTransNlocalY;
    }

    /**
     * Set nbTransNotLinkedY
     *
     * @param integer $nbTransNotLinkedY
     * @return KpiCapture
     */
    public function setNbTransNotLinkedY($nbTransNotLinkedY)
    {
        $this->nbTransNotLinkedY = $nbTransNotLinkedY;

        return $this;
    }

    /**
     * Get nbTransNotLinkedY
     *
     * @return integer 
     */
    public function getNbTransNotLinkedY()
    {
        return $this->nbTransNotLinkedY;
    }

    /**
     * Set pctTransNotLinkedY
     *
     * @param string $pctTransNotLinkedY
     * @return KpiCapture
     */
    public function setPctTransNotLinkedY($pctTransNotLinkedY)
    {
        $this->pctTransNotLinkedY = $pctTransNotLinkedY;

        return $this;
    }

    /**
     * Get pctTransNotLinkedY
     *
     * @return string 
     */
    public function getPctTransNotLinkedY()
    {
        return $this->pctTransNotLinkedY;
    }

    /**
     * Set nbTransTotY
     *
     * @param integer $nbTransTotY
     * @return KpiCapture
     */
    public function setNbTransTotY($nbTransTotY)
    {
        $this->nbTransTotY = $nbTransTotY;

        return $this;
    }

    /**
     * Get nbTransTotY
     *
     * @return integer 
     */
    public function getNbTransTotY()
    {
        return $this->nbTransTotY;
    }

    /**
     * Set nbTransLinkedM
     *
     * @param integer $nbTransLinkedM
     * @return KpiCapture
     */
    public function setNbTransLinkedM($nbTransLinkedM)
    {
        $this->nbTransLinkedM = $nbTransLinkedM;

        return $this;
    }

    /**
     * Get nbTransLinkedM
     *
     * @return integer 
     */
    public function getNbTransLinkedM()
    {
        return $this->nbTransLinkedM;
    }

    /**
     * Set nbTransNotLinkedM
     *
     * @param integer $nbTransNotLinkedM
     * @return KpiCapture
     */
    public function setNbTransNotLinkedM($nbTransNotLinkedM)
    {
        $this->nbTransNotLinkedM = $nbTransNotLinkedM;

        return $this;
    }

    /**
     * Get nbTransNotLinkedM
     *
     * @return integer 
     */
    public function getNbTransNotLinkedM()
    {
        return $this->nbTransNotLinkedM;
    }

    /**
     * Set pctTransNotLinkedM
     *
     * @param string $pctTransNotLinkedM
     * @return KpiCapture
     */
    public function setPctTransNotLinkedM($pctTransNotLinkedM)
    {
        $this->pctTransNotLinkedM = $pctTransNotLinkedM;

        return $this;
    }

    /**
     * Get pctTransNotLinkedM
     *
     * @return string 
     */
    public function getPctTransNotLinkedM()
    {
        return $this->pctTransNotLinkedM;
    }

    /**
     * Set pctTransLinkedM
     *
     * @param string $pctTransLinkedM
     * @return KpiCapture
     */
    public function setPctTransLinkedM($pctTransLinkedM)
    {
        $this->pctTransLinkedM = $pctTransLinkedM;

        return $this;
    }

    /**
     * Get pctTransLinkedM
     *
     * @return string 
     */
    public function getPctTransLinkedM()
    {
        return $this->pctTransLinkedM;
    }

    /**
     * Set nbTransTotM
     *
     * @param integer $nbTransTotM
     * @return KpiCapture
     */
    public function setNbTransTotM($nbTransTotM)
    {
        $this->nbTransTotM = $nbTransTotM;

        return $this;
    }

    /**
     * Get nbTransTotM
     *
     * @return integer 
     */
    public function getNbTransTotM()
    {
        return $this->nbTransTotM;
    }

    /**
     * Set nbOptinML
     *
     * @param integer $nbOptinML
     * @return KpiCapture
     */
    public function setNbOptinML($nbOptinML)
    {
        $this->nbOptinML = $nbOptinML;

        return $this;
    }

    /**
     * Get nbOptinML
     *
     * @return integer 
     */
    public function getNbOptinML()
    {
        return $this->nbOptinML;
    }

    /**
     * Set nbOptoutML
     *
     * @param integer $nbOptoutML
     * @return KpiCapture
     */
    public function setNbOptoutML($nbOptoutML)
    {
        $this->nbOptoutML = $nbOptoutML;

        return $this;
    }

    /**
     * Get nbOptoutML
     *
     * @return integer 
     */
    public function getNbOptoutML()
    {
        return $this->nbOptoutML;
    }

    /**
     * Set pctOptinML
     *
     * @param string $pctOptinML
     * @return KpiCapture
     */
    public function setPctOptinML($pctOptinML)
    {
        $this->pctOptinML = $pctOptinML;

        return $this;
    }

    /**
     * Get pctOptinML
     *
     * @return string 
     */
    public function getPctOptinML()
    {
        return $this->pctOptinML;
    }

    /**
     * Set pctOptoutML
     *
     * @param string $pctOptoutML
     * @return KpiCapture
     */
    public function setPctOptoutML($pctOptoutML)
    {
        $this->pctOptoutML = $pctOptoutML;

        return $this;
    }

    /**
     * Get pctOptoutML
     *
     * @return string 
     */
    public function getPctOptoutML()
    {
        return $this->pctOptoutML;
    }

    /**
     * Set nbCliCoordValidML
     *
     * @param integer $nbCliCoordValidML
     * @return KpiCapture
     */
    public function setNbCliCoordValidML($nbCliCoordValidML)
    {
        $this->nbCliCoordValidML = $nbCliCoordValidML;

        return $this;
    }

    /**
     * Get nbCliCoordValidML
     *
     * @return integer 
     */
    public function getNbCliCoordValidML()
    {
        return $this->nbCliCoordValidML;
    }

    /**
     * Set nbCliCoordNonvalidML
     *
     * @param integer $nbCliCoordNonvalidML
     * @return KpiCapture
     */
    public function setNbCliCoordNonvalidML($nbCliCoordNonvalidML)
    {
        $this->nbCliCoordNonvalidML = $nbCliCoordNonvalidML;

        return $this;
    }

    /**
     * Get nbCliCoordNonvalidML
     *
     * @return integer 
     */
    public function getNbCliCoordNonvalidML()
    {
        return $this->nbCliCoordNonvalidML;
    }

    /**
     * Set nbCliCoordNonrensML
     *
     * @param integer $nbCliCoordNonrensML
     * @return KpiCapture
     */
    public function setNbCliCoordNonrensML($nbCliCoordNonrensML)
    {
        $this->nbCliCoordNonrensML = $nbCliCoordNonrensML;

        return $this;
    }

    /**
     * Get nbCliCoordNonrensML
     *
     * @return integer 
     */
    public function getNbCliCoordNonrensML()
    {
        return $this->nbCliCoordNonrensML;
    }

    /**
     * Set nbCliEmailValidML
     *
     * @param integer $nbCliEmailValidML
     * @return KpiCapture
     */
    public function setNbCliEmailValidML($nbCliEmailValidML)
    {
        $this->nbCliEmailValidML = $nbCliEmailValidML;

        return $this;
    }

    /**
     * Get nbCliEmailValidML
     *
     * @return integer 
     */
    public function getNbCliEmailValidML()
    {
        return $this->nbCliEmailValidML;
    }

    /**
     * Set nbCliEmailNonvalidML
     *
     * @param integer $nbCliEmailNonvalidML
     * @return KpiCapture
     */
    public function setNbCliEmailNonvalidML($nbCliEmailNonvalidML)
    {
        $this->nbCliEmailNonvalidML = $nbCliEmailNonvalidML;

        return $this;
    }

    /**
     * Get nbCliEmailNonvalidML
     *
     * @return integer 
     */
    public function getNbCliEmailNonvalidML()
    {
        return $this->nbCliEmailNonvalidML;
    }

    /**
     * Set nbCliEmailNonrensML
     *
     * @param integer $nbCliEmailNonrensML
     * @return KpiCapture
     */
    public function setNbCliEmailNonrensML($nbCliEmailNonrensML)
    {
        $this->nbCliEmailNonrensML = $nbCliEmailNonrensML;

        return $this;
    }

    /**
     * Get nbCliEmailNonrensML
     *
     * @return integer 
     */
    public function getNbCliEmailNonrensML()
    {
        return $this->nbCliEmailNonrensML;
    }

    /**
     * Set nbCliTelValidML
     *
     * @param integer $nbCliTelValidML
     * @return KpiCapture
     */
    public function setNbCliTelValidML($nbCliTelValidML)
    {
        $this->nbCliTelValidML = $nbCliTelValidML;

        return $this;
    }

    /**
     * Get nbCliTelValidML
     *
     * @return integer 
     */
    public function getNbCliTelValidML()
    {
        return $this->nbCliTelValidML;
    }

    /**
     * Set nbCliTelNonvalidML
     *
     * @param integer $nbCliTelNonvalidML
     * @return KpiCapture
     */
    public function setNbCliTelNonvalidML($nbCliTelNonvalidML)
    {
        $this->nbCliTelNonvalidML = $nbCliTelNonvalidML;

        return $this;
    }

    /**
     * Get nbCliTelNonvalidML
     *
     * @return integer 
     */
    public function getNbCliTelNonvalidML()
    {
        return $this->nbCliTelNonvalidML;
    }

    /**
     * Set nbCliTelNonrensML
     *
     * @param integer $nbCliTelNonrensML
     * @return KpiCapture
     */
    public function setNbCliTelNonrensML($nbCliTelNonrensML)
    {
        $this->nbCliTelNonrensML = $nbCliTelNonrensML;

        return $this;
    }

    /**
     * Get nbCliTelNonrensML
     *
     * @return integer 
     */
    public function getNbCliTelNonrensML()
    {
        return $this->nbCliTelNonrensML;
    }

    /**
     * Set nbCliAddValidML
     *
     * @param integer $nbCliAddValidML
     * @return KpiCapture
     */
    public function setNbCliAddValidML($nbCliAddValidML)
    {
        $this->nbCliAddValidML = $nbCliAddValidML;

        return $this;
    }

    /**
     * Get nbCliAddValidML
     *
     * @return integer 
     */
    public function getNbCliAddValidML()
    {
        return $this->nbCliAddValidML;
    }

    /**
     * Set nbCliAddNonvalidML
     *
     * @param integer $nbCliAddNonvalidML
     * @return KpiCapture
     */
    public function setNbCliAddNonvalidML($nbCliAddNonvalidML)
    {
        $this->nbCliAddNonvalidML = $nbCliAddNonvalidML;

        return $this;
    }

    /**
     * Get nbCliAddNonvalidML
     *
     * @return integer 
     */
    public function getNbCliAddNonvalidML()
    {
        return $this->nbCliAddNonvalidML;
    }

    /**
     * Set nbCliAddNonrensML
     *
     * @param integer $nbCliAddNonrensML
     * @return KpiCapture
     */
    public function setNbCliAddNonrensML($nbCliAddNonrensML)
    {
        $this->nbCliAddNonrensML = $nbCliAddNonrensML;

        return $this;
    }

    /**
     * Get nbCliAddNonrensML
     *
     * @return integer 
     */
    public function getNbCliAddNonrensML()
    {
        return $this->nbCliAddNonrensML;
    }

    /**
     * Set nbOptinYL
     *
     * @param integer $nbOptinYL
     * @return KpiCapture
     */
    public function setNbOptinYL($nbOptinYL)
    {
        $this->nbOptinYL = $nbOptinYL;

        return $this;
    }

    /**
     * Get nbOptinYL
     *
     * @return integer 
     */
    public function getNbOptinYL()
    {
        return $this->nbOptinYL;
    }

    /**
     * Set nbOptoutYL
     *
     * @param integer $nbOptoutYL
     * @return KpiCapture
     */
    public function setNbOptoutYL($nbOptoutYL)
    {
        $this->nbOptoutYL = $nbOptoutYL;

        return $this;
    }

    /**
     * Get nbOptoutYL
     *
     * @return integer 
     */
    public function getNbOptoutYL()
    {
        return $this->nbOptoutYL;
    }

    /**
     * Set pctOptinYL
     *
     * @param string $pctOptinYL
     * @return KpiCapture
     */
    public function setPctOptinYL($pctOptinYL)
    {
        $this->pctOptinYL = $pctOptinYL;

        return $this;
    }

    /**
     * Get pctOptinYL
     *
     * @return string 
     */
    public function getPctOptinYL()
    {
        return $this->pctOptinYL;
    }

    /**
     * Set pctOptoutYL
     *
     * @param string $pctOptoutYL
     * @return KpiCapture
     */
    public function setPctOptoutYL($pctOptoutYL)
    {
        $this->pctOptoutYL = $pctOptoutYL;

        return $this;
    }

    /**
     * Get pctOptoutYL
     *
     * @return string 
     */
    public function getPctOptoutYL()
    {
        return $this->pctOptoutYL;
    }

    /**
     * Set nbCliCoordValidYL
     *
     * @param integer $nbCliCoordValidYL
     * @return KpiCapture
     */
    public function setNbCliCoordValidYL($nbCliCoordValidYL)
    {
        $this->nbCliCoordValidYL = $nbCliCoordValidYL;

        return $this;
    }

    /**
     * Get nbCliCoordValidYL
     *
     * @return integer 
     */
    public function getNbCliCoordValidYL()
    {
        return $this->nbCliCoordValidYL;
    }

    /**
     * Set nbCliCoordNonvalidYL
     *
     * @param integer $nbCliCoordNonvalidYL
     * @return KpiCapture
     */
    public function setNbCliCoordNonvalidYL($nbCliCoordNonvalidYL)
    {
        $this->nbCliCoordNonvalidYL = $nbCliCoordNonvalidYL;

        return $this;
    }

    /**
     * Get nbCliCoordNonvalidYL
     *
     * @return integer 
     */
    public function getNbCliCoordNonvalidYL()
    {
        return $this->nbCliCoordNonvalidYL;
    }

    /**
     * Set nbCliCoordNonrensYL
     *
     * @param integer $nbCliCoordNonrensYL
     * @return KpiCapture
     */
    public function setNbCliCoordNonrensYL($nbCliCoordNonrensYL)
    {
        $this->nbCliCoordNonrensYL = $nbCliCoordNonrensYL;

        return $this;
    }

    /**
     * Get nbCliCoordNonrensYL
     *
     * @return integer 
     */
    public function getNbCliCoordNonrensYL()
    {
        return $this->nbCliCoordNonrensYL;
    }

    /**
     * Set nbCliEmailValidYL
     *
     * @param integer $nbCliEmailValidYL
     * @return KpiCapture
     */
    public function setNbCliEmailValidYL($nbCliEmailValidYL)
    {
        $this->nbCliEmailValidYL = $nbCliEmailValidYL;

        return $this;
    }

    /**
     * Get nbCliEmailValidYL
     *
     * @return integer 
     */
    public function getNbCliEmailValidYL()
    {
        return $this->nbCliEmailValidYL;
    }

    /**
     * Set nbCliEmailNonvalidYL
     *
     * @param integer $nbCliEmailNonvalidYL
     * @return KpiCapture
     */
    public function setNbCliEmailNonvalidYL($nbCliEmailNonvalidYL)
    {
        $this->nbCliEmailNonvalidYL = $nbCliEmailNonvalidYL;

        return $this;
    }

    /**
     * Get nbCliEmailNonvalidYL
     *
     * @return integer 
     */
    public function getNbCliEmailNonvalidYL()
    {
        return $this->nbCliEmailNonvalidYL;
    }

    /**
     * Set nbCliEmailNonrensYL
     *
     * @param integer $nbCliEmailNonrensYL
     * @return KpiCapture
     */
    public function setNbCliEmailNonrensYL($nbCliEmailNonrensYL)
    {
        $this->nbCliEmailNonrensYL = $nbCliEmailNonrensYL;

        return $this;
    }

    /**
     * Get nbCliEmailNonrensYL
     *
     * @return integer 
     */
    public function getNbCliEmailNonrensYL()
    {
        return $this->nbCliEmailNonrensYL;
    }

    /**
     * Set nbCliTelValidYL
     *
     * @param integer $nbCliTelValidYL
     * @return KpiCapture
     */
    public function setNbCliTelValidYL($nbCliTelValidYL)
    {
        $this->nbCliTelValidYL = $nbCliTelValidYL;

        return $this;
    }

    /**
     * Get nbCliTelValidYL
     *
     * @return integer 
     */
    public function getNbCliTelValidYL()
    {
        return $this->nbCliTelValidYL;
    }

    /**
     * Set nbCliTelNonvalidYL
     *
     * @param integer $nbCliTelNonvalidYL
     * @return KpiCapture
     */
    public function setNbCliTelNonvalidYL($nbCliTelNonvalidYL)
    {
        $this->nbCliTelNonvalidYL = $nbCliTelNonvalidYL;

        return $this;
    }

    /**
     * Get nbCliTelNonvalidYL
     *
     * @return integer 
     */
    public function getNbCliTelNonvalidYL()
    {
        return $this->nbCliTelNonvalidYL;
    }

    /**
     * Set nbCliTelNonrensYL
     *
     * @param integer $nbCliTelNonrensYL
     * @return KpiCapture
     */
    public function setNbCliTelNonrensYL($nbCliTelNonrensYL)
    {
        $this->nbCliTelNonrensYL = $nbCliTelNonrensYL;

        return $this;
    }

    /**
     * Get nbCliTelNonrensYL
     *
     * @return integer 
     */
    public function getNbCliTelNonrensYL()
    {
        return $this->nbCliTelNonrensYL;
    }

    /**
     * Set nbCliAddValidYL
     *
     * @param integer $nbCliAddValidYL
     * @return KpiCapture
     */
    public function setNbCliAddValidYL($nbCliAddValidYL)
    {
        $this->nbCliAddValidYL = $nbCliAddValidYL;

        return $this;
    }

    /**
     * Get nbCliAddValidYL
     *
     * @return integer 
     */
    public function getNbCliAddValidYL()
    {
        return $this->nbCliAddValidYL;
    }

    /**
     * Set nbCliAddNonvalidYL
     *
     * @param integer $nbCliAddNonvalidYL
     * @return KpiCapture
     */
    public function setNbCliAddNonvalidYL($nbCliAddNonvalidYL)
    {
        $this->nbCliAddNonvalidYL = $nbCliAddNonvalidYL;

        return $this;
    }

    /**
     * Get nbCliAddNonvalidYL
     *
     * @return integer 
     */
    public function getNbCliAddNonvalidYL()
    {
        return $this->nbCliAddNonvalidYL;
    }

    /**
     * Set nbCliAddNonrensYL
     *
     * @param integer $nbCliAddNonrensYL
     * @return KpiCapture
     */
    public function setNbCliAddNonrensYL($nbCliAddNonrensYL)
    {
        $this->nbCliAddNonrensYL = $nbCliAddNonrensYL;

        return $this;
    }

    /**
     * Get nbCliAddNonrensYL
     *
     * @return integer 
     */
    public function getNbCliAddNonrensYL()
    {
        return $this->nbCliAddNonrensYL;
    }
}
