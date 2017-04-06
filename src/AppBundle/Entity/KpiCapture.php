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

    /**/

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_m", type="integer", nullable=true)
     */
    private $nb_cli_m;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_valid_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_coord_valid_m;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_valid_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_email_valid_m;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_nonvalid_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_email_nonvalid_m;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_nonrens_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_email_nonrens_m;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_valid_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_tel_valid_m;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_nonvalid_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_tel_nonvalid_m;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_nonrens_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_tel_nonrens_m;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_valid_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_add_valid_m;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_nonvalid_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_add_nonvalid_m;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_nonrens_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_add_nonrens_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_m", type="integer", nullable=true)
     */
    private $nb_cli_actifs_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_new_m", type="integer", nullable=true)
     */
    private $nb_cli_actifs_new_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_exist_m", type="integer", nullable=true)
     */
    private $nb_cli_actifs_exist_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_valid_m", type="integer", nullable=true)
     */
    private $nb_cli_coord_valid_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_nonvalid_m", type="integer", nullable=true)
     */
    private $nb_cli_coord_nonvalid_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_valid_m", type="integer", nullable=true)
     */
    private $nb_cli_email_valid_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_nonvalid_m", type="integer", nullable=true)
     */
    private $nb_cli_email_nonvalid_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_nonrens_m", type="integer", nullable=true)
     */
    private $nb_cli_email_nonrens_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_valid_m", type="integer", nullable=true)
     */
    private $nb_cli_tel_valid_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_nonvalid_m", type="integer", nullable=true)
     */
    private $nb_cli_tel_nonvalid_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_nonrens_m", type="integer", nullable=true)
     */
    private $nb_cli_tel_nonrens_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_valid_m", type="integer", nullable=true)
     */
    private $nb_cli_add_valid_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_nonvalid_m", type="integer", nullable=true)
     */
    private $nb_cli_add_nonvalid_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_nonrens_m", type="integer", nullable=true)
     */
    private $nb_cli_add_nonrens_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_trans_tot_m", type="integer", nullable=true)
     */
    private $nb_trans_tot_m;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_ytd", type="integer", nullable=true)
     */
    private $nb_cli_ytd;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_valid_ytd", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_coord_valid_ytd;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_nonvalid_ytd", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_coord_nonvalid_ytd;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_valid_ytd", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_email_valid_ytd;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_nonvalid_ytd", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_email_nonvalid_ytd;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_nonrens_ytd", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_email_nonrens_ytd;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_valid_ytd", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_tel_valid_ytd;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_nonvalid_ytd", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_tel_nonvalid_ytd;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_nonrens_ytd", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_tel_nonrens_ytd;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_valid_ytd", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_add_valid_ytd;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_nonvalid_ytd", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_add_nonvalid_ytd;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_nonrens_ytd", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_add_nonrens_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_email_ytd", type="integer", nullable=true)
     */
    private $nb_email_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_tel_ytd", type="integer", nullable=true)
     */
    private $nb_tel_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_adr_ytd", type="integer", nullable=true)
     */
    private $nb_adr_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_ytd", type="integer", nullable=true)
     */
    private $nb_cli_actifs_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_new_ytd", type="integer", nullable=true)
     */ 
    private $nb_cli_actifs_new_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_exist_ytd", type="integer", nullable=true)
     */
    private $nb_cli_actifs_exist_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_trans_tot_ytd", type="integer", nullable=true)
     */
    private $nb_trans_tot_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_valid_ytd", type="integer", nullable=true)
     */
    private $nb_cli_coord_valid_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_nonvalid_ytd", type="integer", nullable=true)
     */
    private $nb_cli_coord_nonvalid_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_valid_ytd", type="integer", nullable=true)
     */
    private $nb_cli_email_valid_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_nonvalid_ytd", type="integer", nullable=true)
     */ 
    private $nb_cli_email_nonvalid_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_nonrens_ytd", type="integer", nullable=true)
     */
    private $nb_cli_email_nonrens_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_valid_ytd", type="integer", nullable=true)
     */
    private $nb_cli_tel_valid_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_nonvalid_ytd", type="integer", nullable=true)
     */
    private $nb_cli_tel_nonvalid_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_nonrens_ytd", type="integer", nullable=true)
     */
    private $nb_cli_tel_nonrens_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_valid_ytd", type="integer", nullable=true)
     */
    private $nb_cli_add_valid_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_nonvalid_ytd", type="integer", nullable=true)
     */
    private $nb_cli_add_nonvalid_ytd;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_nonrens_ytd", type="integer", nullable=true)
     */
    private $nb_cli_add_nonrens_ytd;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_nonvalid_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pct_cli_coord_nonvalid_m;
    


    
                                   
    

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
     * Set nb_cli_m
     *
     * @param integer $nbCliM
     * @return KpiCapture
     */
    public function setNbCliM($nbCliM)
    {
        $this->nb_cli_m = $nbCliM;

        return $this;
    }

    /**
     * Get nb_cli_m
     *
     * @return integer 
     */
    public function getNbCliM()
    {
        return $this->nb_cli_m;
    }

    /**
     * Set pct_cli_coord_valid_m
     *
     * @param string $pctCliCoordValidM
     * @return KpiCapture
     */
    public function setPctCliCoordValidM($pctCliCoordValidM)
    {
        $this->pct_cli_coord_valid_m = $pctCliCoordValidM;

        return $this;
    }

    /**
     * Get pct_cli_coord_valid_m
     *
     * @return string 
     */
    public function getPctCliCoordValidM()
    {
        return $this->pct_cli_coord_valid_m;
    }

    /**
     * Set pct_cli_email_valid_m
     *
     * @param string $pctCliEmailValidM
     * @return KpiCapture
     */
    public function setPctCliEmailValidM($pctCliEmailValidM)
    {
        $this->pct_cli_email_valid_m = $pctCliEmailValidM;

        return $this;
    }

    /**
     * Get pct_cli_email_valid_m
     *
     * @return string 
     */
    public function getPctCliEmailValidM()
    {
        return $this->pct_cli_email_valid_m;
    }

    /**
     * Set pct_cli_email_nonvalid_m
     *
     * @param string $pctCliEmailNonvalidM
     * @return KpiCapture
     */
    public function setPctCliEmailNonvalidM($pctCliEmailNonvalidM)
    {
        $this->pct_cli_email_nonvalid_m = $pctCliEmailNonvalidM;

        return $this;
    }

    /**
     * Get pct_cli_email_nonvalid_m
     *
     * @return string 
     */
    public function getPctCliEmailNonvalidM()
    {
        return $this->pct_cli_email_nonvalid_m;
    }

    /**
     * Set pct_cli_email_nonrens_m
     *
     * @param string $pctCliEmailNonrensM
     * @return KpiCapture
     */
    public function setPctCliEmailNonrensM($pctCliEmailNonrensM)
    {
        $this->pct_cli_email_nonrens_m = $pctCliEmailNonrensM;

        return $this;
    }

    /**
     * Get pct_cli_email_nonrens_m
     *
     * @return string 
     */
    public function getPctCliEmailNonrensM()
    {
        return $this->pct_cli_email_nonrens_m;
    }

    /**
     * Set pct_cli_tel_valid_m
     *
     * @param string $pctCliTelValidM
     * @return KpiCapture
     */
    public function setPctCliTelValidM($pctCliTelValidM)
    {
        $this->pct_cli_tel_valid_m = $pctCliTelValidM;

        return $this;
    }

    /**
     * Get pct_cli_tel_valid_m
     *
     * @return string 
     */
    public function getPctCliTelValidM()
    {
        return $this->pct_cli_tel_valid_m;
    }

    /**
     * Set pct_cli_tel_nonvalid_m
     *
     * @param string $pctCliTelNonvalidM
     * @return KpiCapture
     */
    public function setPctCliTelNonvalidM($pctCliTelNonvalidM)
    {
        $this->pct_cli_tel_nonvalid_m = $pctCliTelNonvalidM;

        return $this;
    }

    /**
     * Get pct_cli_tel_nonvalid_m
     *
     * @return string 
     */
    public function getPctCliTelNonvalidM()
    {
        return $this->pct_cli_tel_nonvalid_m;
    }

    /**
     * Set pct_cli_tel_nonrens_m
     *
     * @param string $pctCliTelNonrensM
     * @return KpiCapture
     */
    public function setPctCliTelNonrensM($pctCliTelNonrensM)
    {
        $this->pct_cli_tel_nonrens_m = $pctCliTelNonrensM;

        return $this;
    }

    /**
     * Get pct_cli_tel_nonrens_m
     *
     * @return string 
     */
    public function getPctCliTelNonrensM()
    {
        return $this->pct_cli_tel_nonrens_m;
    }

    /**
     * Set pct_cli_add_valid_m
     *
     * @param string $pctCliAddValidM
     * @return KpiCapture
     */
    public function setPctCliAddValidM($pctCliAddValidM)
    {
        $this->pct_cli_add_valid_m = $pctCliAddValidM;

        return $this;
    }

    /**
     * Get pct_cli_add_valid_m
     *
     * @return string 
     */
    public function getPctCliAddValidM()
    {
        return $this->pct_cli_add_valid_m;
    }

    /**
     * Set pct_cli_add_nonvalid_m
     *
     * @param string $pctCliAddNonvalidM
     * @return KpiCapture
     */
    public function setPctCliAddNonvalidM($pctCliAddNonvalidM)
    {
        $this->pct_cli_add_nonvalid_m = $pctCliAddNonvalidM;

        return $this;
    }

    /**
     * Get pct_cli_add_nonvalid_m
     *
     * @return string 
     */
    public function getPctCliAddNonvalidM()
    {
        return $this->pct_cli_add_nonvalid_m;
    }

    /**
     * Set pct_cli_add_nonrens_m
     *
     * @param string $pctCliAddNonrensM
     * @return KpiCapture
     */
    public function setPctCliAddNonrensM($pctCliAddNonrensM)
    {
        $this->pct_cli_add_nonrens_m = $pctCliAddNonrensM;

        return $this;
    }

    /**
     * Get pct_cli_add_nonrens_m
     *
     * @return string 
     */
    public function getPctCliAddNonrensM()
    {
        return $this->pct_cli_add_nonrens_m;
    }

    /**
     * Set nb_cli_actifs_m
     *
     * @param integer $nbCliActifsM
     * @return KpiCapture
     */
    public function setNbCliActifsM($nbCliActifsM)
    {
        $this->nb_cli_actifs_m = $nbCliActifsM;

        return $this;
    }

    /**
     * Get nb_cli_actifs_m
     *
     * @return integer 
     */
    public function getNbCliActifsM()
    {
        return $this->nb_cli_actifs_m;
    }

    /**
     * Set nb_cli_actifs_new_m
     *
     * @param integer $nbCliActifsNewM
     * @return KpiCapture
     */
    public function setNbCliActifsNewM($nbCliActifsNewM)
    {
        $this->nb_cli_actifs_new_m = $nbCliActifsNewM;

        return $this;
    }

    /**
     * Get nb_cli_actifs_new_m
     *
     * @return integer 
     */
    public function getNbCliActifsNewM()
    {
        return $this->nb_cli_actifs_new_m;
    }

    /**
     * Set nb_cli_actifs_exist_m
     *
     * @param integer $nbCliActifsExistM
     * @return KpiCapture
     */
    public function setNbCliActifsExistM($nbCliActifsExistM)
    {
        $this->nb_cli_actifs_exist_m = $nbCliActifsExistM;

        return $this;
    }

    /**
     * Get nb_cli_actifs_exist_m
     *
     * @return integer 
     */
    public function getNbCliActifsExistM()
    {
        return $this->nb_cli_actifs_exist_m;
    }

    /**
     * Set nb_cli_coord_valid_m
     *
     * @param integer $nbCliCoordValidM
     * @return KpiCapture
     */
    public function setNbCliCoordValidM($nbCliCoordValidM)
    {
        $this->nb_cli_coord_valid_m = $nbCliCoordValidM;

        return $this;
    }

    /**
     * Get nb_cli_coord_valid_m
     *
     * @return integer 
     */
    public function getNbCliCoordValidM()
    {
        return $this->nb_cli_coord_valid_m;
    }

    /**
     * Set nb_cli_coord_nonvalid_m
     *
     * @param integer $nbCliCoordNonvalidM
     * @return KpiCapture
     */
    public function setNbCliCoordNonvalidM($nbCliCoordNonvalidM)
    {
        $this->nb_cli_coord_nonvalid_m = $nbCliCoordNonvalidM;

        return $this;
    }

    /**
     * Get nb_cli_coord_nonvalid_m
     *
     * @return integer 
     */
    public function getNbCliCoordNonvalidM()
    {
        return $this->nb_cli_coord_nonvalid_m;
    }

    /**
     * Set nb_cli_email_valid_m
     *
     * @param integer $nbCliEmailValidM
     * @return KpiCapture
     */
    public function setNbCliEmailValidM($nbCliEmailValidM)
    {
        $this->nb_cli_email_valid_m = $nbCliEmailValidM;

        return $this;
    }

    /**
     * Get nb_cli_email_valid_m
     *
     * @return integer 
     */
    public function getNbCliEmailValidM()
    {
        return $this->nb_cli_email_valid_m;
    }

    /**
     * Set nb_cli_email_nonvalid_m
     *
     * @param integer $nbCliEmailNonvalidM
     * @return KpiCapture
     */
    public function setNbCliEmailNonvalidM($nbCliEmailNonvalidM)
    {
        $this->nb_cli_email_nonvalid_m = $nbCliEmailNonvalidM;

        return $this;
    }

    /**
     * Get nb_cli_email_nonvalid_m
     *
     * @return integer 
     */
    public function getNbCliEmailNonvalidM()
    {
        return $this->nb_cli_email_nonvalid_m;
    }

    /**
     * Set nb_cli_email_nonrens_m
     *
     * @param integer $nbCliEmailNonrensM
     * @return KpiCapture
     */
    public function setNbCliEmailNonrensM($nbCliEmailNonrensM)
    {
        $this->nb_cli_email_nonrens_m = $nbCliEmailNonrensM;

        return $this;
    }

    /**
     * Get nb_cli_email_nonrens_m
     *
     * @return integer 
     */
    public function getNbCliEmailNonrensM()
    {
        return $this->nb_cli_email_nonrens_m;
    }

    /**
     * Set nb_cli_tel_valid_m
     *
     * @param integer $nbCliTelValidM
     * @return KpiCapture
     */
    public function setNbCliTelValidM($nbCliTelValidM)
    {
        $this->nb_cli_tel_valid_m = $nbCliTelValidM;

        return $this;
    }

    /**
     * Get nb_cli_tel_valid_m
     *
     * @return integer 
     */
    public function getNbCliTelValidM()
    {
        return $this->nb_cli_tel_valid_m;
    }

    /**
     * Set nb_cli_tel_nonvalid_m
     *
     * @param integer $nbCliTelNonvalidM
     * @return KpiCapture
     */
    public function setNbCliTelNonvalidM($nbCliTelNonvalidM)
    {
        $this->nb_cli_tel_nonvalid_m = $nbCliTelNonvalidM;

        return $this;
    }

    /**
     * Get nb_cli_tel_nonvalid_m
     *
     * @return integer 
     */
    public function getNbCliTelNonvalidM()
    {
        return $this->nb_cli_tel_nonvalid_m;
    }

    /**
     * Set nb_cli_tel_nonrens_m
     *
     * @param integer $nbCliTelNonrensM
     * @return KpiCapture
     */
    public function setNbCliTelNonrensM($nbCliTelNonrensM)
    {
        $this->nb_cli_tel_nonrens_m = $nbCliTelNonrensM;

        return $this;
    }

    /**
     * Get nb_cli_tel_nonrens_m
     *
     * @return integer 
     */
    public function getNbCliTelNonrensM()
    {
        return $this->nb_cli_tel_nonrens_m;
    }

    /**
     * Set nb_cli_add_valid_m
     *
     * @param integer $nbCliAddValidM
     * @return KpiCapture
     */
    public function setNbCliAddValidM($nbCliAddValidM)
    {
        $this->nb_cli_add_valid_m = $nbCliAddValidM;

        return $this;
    }

    /**
     * Get nb_cli_add_valid_m
     *
     * @return integer 
     */
    public function getNbCliAddValidM()
    {
        return $this->nb_cli_add_valid_m;
    }

    /**
     * Set nb_cli_add_nonvalid_m
     *
     * @param integer $nbCliAddNonvalidM
     * @return KpiCapture
     */
    public function setNbCliAddNonvalidM($nbCliAddNonvalidM)
    {
        $this->nb_cli_add_nonvalid_m = $nbCliAddNonvalidM;

        return $this;
    }

    /**
     * Get nb_cli_add_nonvalid_m
     *
     * @return integer 
     */
    public function getNbCliAddNonvalidM()
    {
        return $this->nb_cli_add_nonvalid_m;
    }

    /**
     * Set nb_cli_add_nonrens_m
     *
     * @param integer $nbCliAddNonrensM
     * @return KpiCapture
     */
    public function setNbCliAddNonrensM($nbCliAddNonrensM)
    {
        $this->nb_cli_add_nonrens_m = $nbCliAddNonrensM;

        return $this;
    }

    /**
     * Get nb_cli_add_nonrens_m
     *
     * @return integer 
     */
    public function getNbCliAddNonrensM()
    {
        return $this->nb_cli_add_nonrens_m;
    }

    /**
     * Set nb_trans_tot_m
     *
     * @param integer $nbTransTotM
     * @return KpiCapture
     */
    public function setNbTransTotM($nbTransTotM)
    {
        $this->nb_trans_tot_m = $nbTransTotM;

        return $this;
    }

    /**
     * Get nb_trans_tot_m
     *
     * @return integer 
     */
    public function getNbTransTotM()
    {
        return $this->nb_trans_tot_m;
    }

    /**
     * Set nb_cli_ytd
     *
     * @param integer $nbCliYtd
     * @return KpiCapture
     */
    public function setNbCliYtd($nbCliYtd)
    {
        $this->nb_cli_ytd = $nbCliYtd;

        return $this;
    }

    /**
     * Get nb_cli_ytd
     *
     * @return integer 
     */
    public function getNbCliYtd()
    {
        return $this->nb_cli_ytd;
    }

    /**
     * Set pct_cli_coord_valid_ytd
     *
     * @param string $pctCliCoordValidYtd
     * @return KpiCapture
     */
    public function setPctCliCoordValidYtd($pctCliCoordValidYtd)
    {
        $this->pct_cli_coord_valid_ytd = $pctCliCoordValidYtd;

        return $this;
    }

    /**
     * Get pct_cli_coord_valid_ytd
     *
     * @return string 
     */
    public function getPctCliCoordValidYtd()
    {
        return $this->pct_cli_coord_valid_ytd;
    }

    /**
     * Set pct_cli_coord_nonvalid_ytd
     *
     * @param string $pctCliCoordNonvalidYtd
     * @return KpiCapture
     */
    public function setPctCliCoordNonvalidYtd($pctCliCoordNonvalidYtd)
    {
        $this->pct_cli_coord_nonvalid_ytd = $pctCliCoordNonvalidYtd;

        return $this;
    }

    /**
     * Get pct_cli_coord_nonvalid_ytd
     *
     * @return string 
     */
    public function getPctCliCoordNonvalidYtd()
    {
        return $this->pct_cli_coord_nonvalid_ytd;
    }

    /**
     * Set pct_cli_email_valid_ytd
     *
     * @param string $pctCliEmailValidYtd
     * @return KpiCapture
     */
    public function setPctCliEmailValidYtd($pctCliEmailValidYtd)
    {
        $this->pct_cli_email_valid_ytd = $pctCliEmailValidYtd;

        return $this;
    }

    /**
     * Get pct_cli_email_valid_ytd
     *
     * @return string 
     */
    public function getPctCliEmailValidYtd()
    {
        return $this->pct_cli_email_valid_ytd;
    }

    /**
     * Set pct_cli_email_nonvalid_ytd
     *
     * @param string $pctCliEmailNonvalidYtd
     * @return KpiCapture
     */
    public function setPctCliEmailNonvalidYtd($pctCliEmailNonvalidYtd)
    {
        $this->pct_cli_email_nonvalid_ytd = $pctCliEmailNonvalidYtd;

        return $this;
    }

    /**
     * Get pct_cli_email_nonvalid_ytd
     *
     * @return string 
     */
    public function getPctCliEmailNonvalidYtd()
    {
        return $this->pct_cli_email_nonvalid_ytd;
    }

    /**
     * Set pct_cli_email_nonrens_ytd
     *
     * @param string $pctCliEmailNonrensYtd
     * @return KpiCapture
     */
    public function setPctCliEmailNonrensYtd($pctCliEmailNonrensYtd)
    {
        $this->pct_cli_email_nonrens_ytd = $pctCliEmailNonrensYtd;

        return $this;
    }

    /**
     * Get pct_cli_email_nonrens_ytd
     *
     * @return string 
     */
    public function getPctCliEmailNonrensYtd()
    {
        return $this->pct_cli_email_nonrens_ytd;
    }

    /**
     * Set pct_cli_tel_valid_ytd
     *
     * @param string $pctCliTelValidYtd
     * @return KpiCapture
     */
    public function setPctCliTelValidYtd($pctCliTelValidYtd)
    {
        $this->pct_cli_tel_valid_ytd = $pctCliTelValidYtd;

        return $this;
    }

    /**
     * Get pct_cli_tel_valid_ytd
     *
     * @return string 
     */
    public function getPctCliTelValidYtd()
    {
        return $this->pct_cli_tel_valid_ytd;
    }

    /**
     * Set pct_cli_tel_nonvalid_ytd
     *
     * @param string $pctCliTelNonvalidYtd
     * @return KpiCapture
     */
    public function setPctCliTelNonvalidYtd($pctCliTelNonvalidYtd)
    {
        $this->pct_cli_tel_nonvalid_ytd = $pctCliTelNonvalidYtd;

        return $this;
    }

    /**
     * Get pct_cli_tel_nonvalid_ytd
     *
     * @return string 
     */
    public function getPctCliTelNonvalidYtd()
    {
        return $this->pct_cli_tel_nonvalid_ytd;
    }

    /**
     * Set pct_cli_tel_nonrens_ytd
     *
     * @param string $pctCliTelNonrensYtd
     * @return KpiCapture
     */
    public function setPctCliTelNonrensYtd($pctCliTelNonrensYtd)
    {
        $this->pct_cli_tel_nonrens_ytd = $pctCliTelNonrensYtd;

        return $this;
    }

    /**
     * Get pct_cli_tel_nonrens_ytd
     *
     * @return string 
     */
    public function getPctCliTelNonrensYtd()
    {
        return $this->pct_cli_tel_nonrens_ytd;
    }

    /**
     * Set pct_cli_add_valid_ytd
     *
     * @param string $pctCliAddValidYtd
     * @return KpiCapture
     */
    public function setPctCliAddValidYtd($pctCliAddValidYtd)
    {
        $this->pct_cli_add_valid_ytd = $pctCliAddValidYtd;

        return $this;
    }

    /**
     * Get pct_cli_add_valid_ytd
     *
     * @return string 
     */
    public function getPctCliAddValidYtd()
    {
        return $this->pct_cli_add_valid_ytd;
    }

    /**
     * Set pct_cli_add_nonvalid_ytd
     *
     * @param string $pctCliAddNonvalidYtd
     * @return KpiCapture
     */
    public function setPctCliAddNonvalidYtd($pctCliAddNonvalidYtd)
    {
        $this->pct_cli_add_nonvalid_ytd = $pctCliAddNonvalidYtd;

        return $this;
    }

    /**
     * Get pct_cli_add_nonvalid_ytd
     *
     * @return string 
     */
    public function getPctCliAddNonvalidYtd()
    {
        return $this->pct_cli_add_nonvalid_ytd;
    }

    /**
     * Set pct_cli_add_nonrens_ytd
     *
     * @param string $pctCliAddNonrensYtd
     * @return KpiCapture
     */
    public function setPctCliAddNonrensYtd($pctCliAddNonrensYtd)
    {
        $this->pct_cli_add_nonrens_ytd = $pctCliAddNonrensYtd;

        return $this;
    }

    /**
     * Get pct_cli_add_nonrens_ytd
     *
     * @return string 
     */
    public function getPctCliAddNonrensYtd()
    {
        return $this->pct_cli_add_nonrens_ytd;
    }

    /**
     * Set nb_email_ytd
     *
     * @param integer $nbEmailYtd
     * @return KpiCapture
     */
    public function setNbEmailYtd($nbEmailYtd)
    {
        $this->nb_email_ytd = $nbEmailYtd;

        return $this;
    }

    /**
     * Get nb_email_ytd
     *
     * @return integer 
     */
    public function getNbEmailYtd()
    {
        return $this->nb_email_ytd;
    }

    /**
     * Set nb_tel_ytd
     *
     * @param integer $nbTelYtd
     * @return KpiCapture
     */
    public function setNbTelYtd($nbTelYtd)
    {
        $this->nb_tel_ytd = $nbTelYtd;

        return $this;
    }

    /**
     * Get nb_tel_ytd
     *
     * @return integer 
     */
    public function getNbTelYtd()
    {
        return $this->nb_tel_ytd;
    }

    /**
     * Set nb_adr_ytd
     *
     * @param integer $nbAdrYtd
     * @return KpiCapture
     */
    public function setNbAdrYtd($nbAdrYtd)
    {
        $this->nb_adr_ytd = $nbAdrYtd;

        return $this;
    }

    /**
     * Get nb_adr_ytd
     *
     * @return integer 
     */
    public function getNbAdrYtd()
    {
        return $this->nb_adr_ytd;
    }

    /**
     * Set nb_cli_actifs_ytd
     *
     * @param integer $nbCliActifsYtd
     * @return KpiCapture
     */
    public function setNbCliActifsYtd($nbCliActifsYtd)
    {
        $this->nb_cli_actifs_ytd = $nbCliActifsYtd;

        return $this;
    }

    /**
     * Get nb_cli_actifs_ytd
     *
     * @return integer 
     */
    public function getNbCliActifsYtd()
    {
        return $this->nb_cli_actifs_ytd;
    }

    /**
     * Set nb_cli_actifs_new_ytd
     *
     * @param integer $nbCliActifsNewYtd
     * @return KpiCapture
     */
    public function setNbCliActifsNewYtd($nbCliActifsNewYtd)
    {
        $this->nb_cli_actifs_new_ytd = $nbCliActifsNewYtd;

        return $this;
    }

    /**
     * Get nb_cli_actifs_new_ytd
     *
     * @return integer 
     */
    public function getNbCliActifsNewYtd()
    {
        return $this->nb_cli_actifs_new_ytd;
    }

    /**
     * Set nb_cli_actifs_exist_ytd
     *
     * @param integer $nbCliActifsExistYtd
     * @return KpiCapture
     */
    public function setNbCliActifsExistYtd($nbCliActifsExistYtd)
    {
        $this->nb_cli_actifs_exist_ytd = $nbCliActifsExistYtd;

        return $this;
    }

    /**
     * Get nb_cli_actifs_exist_ytd
     *
     * @return integer 
     */
    public function getNbCliActifsExistYtd()
    {
        return $this->nb_cli_actifs_exist_ytd;
    }

    /**
     * Set nb_trans_tot_ytd
     *
     * @param integer $nbTransTotYtd
     * @return KpiCapture
     */
    public function setNbTransTotYtd($nbTransTotYtd)
    {
        $this->nb_trans_tot_ytd = $nbTransTotYtd;

        return $this;
    }

    /**
     * Get nb_trans_tot_ytd
     *
     * @return integer 
     */
    public function getNbTransTotYtd()
    {
        return $this->nb_trans_tot_ytd;
    }

    /**
     * Set nb_cli_coord_valid_ytd
     *
     * @param integer $nbCliCoordValidYtd
     * @return KpiCapture
     */
    public function setNbCliCoordValidYtd($nbCliCoordValidYtd)
    {
        $this->nb_cli_coord_valid_ytd = $nbCliCoordValidYtd;

        return $this;
    }

    /**
     * Get nb_cli_coord_valid_ytd
     *
     * @return integer 
     */
    public function getNbCliCoordValidYtd()
    {
        return $this->nb_cli_coord_valid_ytd;
    }

    /**
     * Set nb_cli_coord_nonvalid_ytd
     *
     * @param integer $nbCliCoordNonvalidYtd
     * @return KpiCapture
     */
    public function setNbCliCoordNonvalidYtd($nbCliCoordNonvalidYtd)
    {
        $this->nb_cli_coord_nonvalid_ytd = $nbCliCoordNonvalidYtd;

        return $this;
    }

    /**
     * Get nb_cli_coord_nonvalid_ytd
     *
     * @return integer 
     */
    public function getNbCliCoordNonvalidYtd()
    {
        return $this->nb_cli_coord_nonvalid_ytd;
    }

    /**
     * Set nb_cli_email_valid_ytd
     *
     * @param integer $nbCliEmailValidYtd
     * @return KpiCapture
     */
    public function setNbCliEmailValidYtd($nbCliEmailValidYtd)
    {
        $this->nb_cli_email_valid_ytd = $nbCliEmailValidYtd;

        return $this;
    }

    /**
     * Get nb_cli_email_valid_ytd
     *
     * @return integer 
     */
    public function getNbCliEmailValidYtd()
    {
        return $this->nb_cli_email_valid_ytd;
    }

    /**
     * Set nb_cli_email_nonvalid_ytd
     *
     * @param integer $nbCliEmailNonvalidYtd
     * @return KpiCapture
     */
    public function setNbCliEmailNonvalidYtd($nbCliEmailNonvalidYtd)
    {
        $this->nb_cli_email_nonvalid_ytd = $nbCliEmailNonvalidYtd;

        return $this;
    }

    /**
     * Get nb_cli_email_nonvalid_ytd
     *
     * @return integer 
     */
    public function getNbCliEmailNonvalidYtd()
    {
        return $this->nb_cli_email_nonvalid_ytd;
    }

    /**
     * Set nb_cli_email_nonrens_ytd
     *
     * @param integer $nbCliEmailNonrensYtd
     * @return KpiCapture
     */
    public function setNbCliEmailNonrensYtd($nbCliEmailNonrensYtd)
    {
        $this->nb_cli_email_nonrens_ytd = $nbCliEmailNonrensYtd;

        return $this;
    }

    /**
     * Get nb_cli_email_nonrens_ytd
     *
     * @return integer 
     */
    public function getNbCliEmailNonrensYtd()
    {
        return $this->nb_cli_email_nonrens_ytd;
    }

    /**
     * Set nb_cli_tel_valid_ytd
     *
     * @param integer $nbCliTelValidYtd
     * @return KpiCapture
     */
    public function setNbCliTelValidYtd($nbCliTelValidYtd)
    {
        $this->nb_cli_tel_valid_ytd = $nbCliTelValidYtd;

        return $this;
    }

    /**
     * Get nb_cli_tel_valid_ytd
     *
     * @return integer 
     */
    public function getNbCliTelValidYtd()
    {
        return $this->nb_cli_tel_valid_ytd;
    }

    /**
     * Set nb_cli_tel_nonvalid_ytd
     *
     * @param integer $nbCliTelNonvalidYtd
     * @return KpiCapture
     */
    public function setNbCliTelNonvalidYtd($nbCliTelNonvalidYtd)
    {
        $this->nb_cli_tel_nonvalid_ytd = $nbCliTelNonvalidYtd;

        return $this;
    }

    /**
     * Get nb_cli_tel_nonvalid_ytd
     *
     * @return integer 
     */
    public function getNbCliTelNonvalidYtd()
    {
        return $this->nb_cli_tel_nonvalid_ytd;
    }

    /**
     * Set nb_cli_tel_nonrens_ytd
     *
     * @param integer $nbCliTelNonrensYtd
     * @return KpiCapture
     */
    public function setNbCliTelNonrensYtd($nbCliTelNonrensYtd)
    {
        $this->nb_cli_tel_nonrens_ytd = $nbCliTelNonrensYtd;

        return $this;
    }

    /**
     * Get nb_cli_tel_nonrens_ytd
     *
     * @return integer 
     */
    public function getNbCliTelNonrensYtd()
    {
        return $this->nb_cli_tel_nonrens_ytd;
    }

    /**
     * Set nb_cli_add_valid_ytd
     *
     * @param integer $nbCliAddValidYtd
     * @return KpiCapture
     */
    public function setNbCliAddValidYtd($nbCliAddValidYtd)
    {
        $this->nb_cli_add_valid_ytd = $nbCliAddValidYtd;

        return $this;
    }

    /**
     * Get nb_cli_add_valid_ytd
     *
     * @return integer 
     */
    public function getNbCliAddValidYtd()
    {
        return $this->nb_cli_add_valid_ytd;
    }

    /**
     * Set nb_cli_add_nonvalid_ytd
     *
     * @param integer $nbCliAddNonvalidYtd
     * @return KpiCapture
     */
    public function setNbCliAddNonvalidYtd($nbCliAddNonvalidYtd)
    {
        $this->nb_cli_add_nonvalid_ytd = $nbCliAddNonvalidYtd;

        return $this;
    }

    /**
     * Get nb_cli_add_nonvalid_ytd
     *
     * @return integer 
     */
    public function getNbCliAddNonvalidYtd()
    {
        return $this->nb_cli_add_nonvalid_ytd;
    }

    /**
     * Set nb_cli_add_nonrens_ytd
     *
     * @param integer $nbCliAddNonrensYtd
     * @return KpiCapture
     */
    public function setNbCliAddNonrensYtd($nbCliAddNonrensYtd)
    {
        $this->nb_cli_add_nonrens_ytd = $nbCliAddNonrensYtd;

        return $this;
    }

    /**
     * Get nb_cli_add_nonrens_ytd
     *
     * @return integer 
     */
    public function getNbCliAddNonrensYtd()
    {
        return $this->nb_cli_add_nonrens_ytd;
    }

    /**
     * Set pct_cli_coord_nonvalid_m
     *
     * @param string $pctCliCoordNonvalidM
     * @return KpiCapture
     */
    public function setPctCliCoordNonvalidM($pctCliCoordNonvalidM)
    {
        $this->pct_cli_coord_nonvalid_m = $pctCliCoordNonvalidM;

        return $this;
    }

    /**
     * Get pct_cli_coord_nonvalid_m
     *
     * @return string 
     */
    public function getPctCliCoordNonvalidM()
    {
        return $this->pct_cli_coord_nonvalid_m;
    }
}
