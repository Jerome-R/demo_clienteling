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



    /******** MENS_NON_LOC ********/


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_m_nl", type="integer", nullable=true)
     */
    private $nbCliMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_valid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliCoordValidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_nonvalid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliCoordNonvalidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_nonrens_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliCoordNonrensMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_valid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliEmailValidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_nonvalid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliEmailNonvalidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_nonrens_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliEmailNonrensMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_valid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliTelValidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_nonvalid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliTelNonvalidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_nonrens_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliTelNonrensMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_valid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliAddValidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_nonrens_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliAddNonrensMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_nonvalid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliAddNonvalidMNL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_m_nl", type="integer", nullable=true)
     */
    private $nbCliActifsMNL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_new_m_nl", type="integer", nullable=true)
     */
    private $nbCliActifsNewMNL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_exist_m_nl", type="integer", nullable=true)
     */
    private $nbCliActifsExistMNL;


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


    /******** YEAR_NON_LOC ********/


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_y_nl", type="integer", nullable=true)
     */
    private $nbCliYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_valid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliCoordValidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_nonvalid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliCoordNonvalidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_coord_nonrens_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliCoordNonrensYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_valid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliEmailValidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_nonvalid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliEmailNonvalidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_email_nonrens_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliEmailNonrensYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_valid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliTelValidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_nonvalid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliTelNonvalidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_tel_nonrens_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliTelNonrensYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_valid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliAddValidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_nonrens_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliAddNonrensYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_cli_add_nonvalid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctCliAddNonvalidYNL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_y_nl", type="integer", nullable=true)
     */
    private $nbCliActifsYNL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_new_y_nl", type="integer", nullable=true)
     */
    private $nbCliActifsNewYNL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_actifs_exist_y_nl", type="integer", nullable=true)
     */
    private $nbCliActifsExistYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_email_y_nl", type="integer", nullable=true)
     */
    private $nbEmailYNL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_tel_y_nl", type="integer", nullable=true)
     */
    private $nbTelYNL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_adr_y_nl", type="integer", nullable=true)
     */
    private $nbAdrYNL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="pct_cli_donnees_nonvalid_y_nl", type="integer", nullable=true)
     */
    private $pctCliDonneesNonvalidYNL;


    
    /*******PROSPECTS********/

    /*******YNL********/

    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_y_nl", type="integer", nullable=true)
     */
    private $nbProspYNL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_email_nonvalid_y_nl", type="integer", nullable=true)
     */
    private $nbEmailNonvalidYNL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_tel_nonvalid_y_nl", type="integer", nullable=true)
     */
    private $nbTelNonvalidYNL;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_adr_nonvalid_y_nl", type="integer", nullable=true)
     */
    private $nbAdrNonvalidYNL;         

    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_coord_valid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspCoordValidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_coord_nonvalid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspCoordNonvalidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_coord_nonrens_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspCoordNonrensYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_email_valid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspEmailValidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_email_nonvalid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspEmailNonvalidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_email_nonrens_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspEmailNonrensYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_tel_valid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspTelValidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_tel_nonvalid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspTelNonvalidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_tel_nonrens_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspTelNonrensYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_add_valid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspAddValidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_add_nonvalid_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspAddNonvalidYNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_add_nonrens_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspAddNonrensYNL;


    /*******YL********/

    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_y_l", type="integer", nullable=true)
     */
    private $nbProspYL;
    
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
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_coord_valid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspCoordValidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_coord_nonvalid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspCoordNonvalidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_coord_nonrens_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspCoordNonrensYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_email_valid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspEmailValidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_email_nonvalid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspEmailNonvalidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_email_nonrens_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspEmailNonrensYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_tel_valid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspTelValidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_tel_nonvalid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspTelNonvalidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_tel_nonrens_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspTelNonrensYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_add_valid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspAddValidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_add_nonvalid_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspAddNonvalidYL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_add_nonrens_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspAddNonrensYL;


    /*******ML********/

    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_m_l", type="integer", nullable=true)
     */
    private $nbProspML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_coord_valid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspCoordValidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_coord_nonvalid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspCoordNonvalidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_coord_nonrens_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspCoordNonrensML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_email_valid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspEmailValidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_email_nonvalid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspEmailNonvalidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_email_nonrens_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspEmailNonrensML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_tel_valid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspTelValidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_tel_nonvalid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspTelNonvalidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_tel_nonrens_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspTelNonrensML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_add_valid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspAddValidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_add_nonvalid_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspAddNonvalidML;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_add_nonrens_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspAddNonrensML;


    /*******MNL********/

    
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_m_nl", type="integer", nullable=true)
     */
    private $nbProspMNL; 
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_coord_valid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspCoordValidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_coord_nonvalid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspCoordNonvalidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_coord_nonrens_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspCoordNonrensMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_email_valid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspEmailValidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_email_nonvalid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspEmailNonvalidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_email_nonrens_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspEmailNonrensMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_tel_valid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspTelValidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_tel_nonvalid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspTelNonvalidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_tel_nonrens_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspTelNonrensMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_add_valid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspAddValidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_add_nonvalid_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspAddNonvalidMNL;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_add_nonrens_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspAddNonrensMNL;


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
     * @ORM\Column(name="nb_trans_local_y", type="integer", nullable=true)
     */
    private $nbTransLocalY;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_trans_local_y", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctTransLocalY;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="nb_trans_nlocal_y", type="integer", nullable=true)
     */
    private $nbTransNlocalY;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_trans_nlocal_y", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctTransNlocalY;
    
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
     * @ORM\Column(name="nb_trans_local_m", type="integer", nullable=true)
     */
    private $nbTransLocalM;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_trans_local_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctTransLocalM;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="nb_trans_nlocal_m", type="integer", nullable=true)
     */
    private $nbTransNlocalM;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_trans_nlocal_m", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctTransNlocalM;
    
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

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_coord_valid_m_l", type="integer", nullable=true)
     */
    private $nbProspCoordValidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_coord_nonvalid_m_l", type="integer", nullable=true)
     */
    private $nbProspCoordNonvalidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_coord_nonrens_m_l", type="integer", nullable=true)
     */
    private $nbProspCoordNonrensML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_email_valid_m_l", type="integer", nullable=true)
     */
    private $nbProspEmailValidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_email_nonvalid_m_l", type="integer", nullable=true)
     */
    private $nbProspEmailNonvalidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_email_nonrens_m_l", type="integer", nullable=true)
     */
    private $nbProspEmailNonrensML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_tel_valid_m_l", type="integer", nullable=true)
     */
    private $nbProspTelValidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_tel_nonvalid_m_l", type="integer", nullable=true)
     */
    private $nbProspTelNonvalidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_tel_nonrens_m_l", type="integer", nullable=true)
     */
    private $nbProspTelNonrensML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_add_valid_m_l", type="integer", nullable=true)
     */
    private $nbProspAddValidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_add_nonvalid_m_l", type="integer", nullable=true)
     */
    private $nbProspAddNonvalidML;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_add_nonrens_m_l", type="integer", nullable=true)
     */
    private $nbProspAddNonrensML;



    /***** NOMBRE COMPLEMENT AUX POURCENTAGES *****/

    /* MNL */



    /**
     * @var integer
     *
     * @ORM\Column(name="nb_optin_m_nl", type="integer", nullable=true)
     */
    private $nbOptinMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_optout_m_nl", type="integer", nullable=true)
     */
    private $nbOptoutMNL;

    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_optin_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctOptinMNL;

    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_optout_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctOptoutMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_valid_m_nl", type="integer", nullable=true)
     */
    private $nbCliCoordValidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_nonvalid_m_nl", type="integer", nullable=true)
     */
    private $nbCliCoordNonvalidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_nonrens_m_nl", type="integer", nullable=true)
     */
    private $nbCliCoordNonrensMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_valid_m_nl", type="integer", nullable=true)
     */
    private $nbCliEmailValidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_nonvalid_m_nl", type="integer", nullable=true)
     */
    private $nbCliEmailNonvalidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_nonrens_m_nl", type="integer", nullable=true)
     */
    private $nbCliEmailNonrensMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_valid_m_nl", type="integer", nullable=true)
     */
    private $nbCliTelValidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_nonvalid_m_nl", type="integer", nullable=true)
     */
    private $nbCliTelNonvalidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_nonrens_m_nl", type="integer", nullable=true)
     */
    private $nbCliTelNonrensMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_valid_m_nl", type="integer", nullable=true)
     */
    private $nbCliAddValidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_nonvalid_m_nl", type="integer", nullable=true)
     */
    private $nbCliAddNonvalidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_nonrens_m_nl", type="integer", nullable=true)
     */
    private $nbCliAddNonrensMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_coord_valid_m_nl", type="integer", nullable=true)
     */
    private $nbProspCoordValidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_coord_nonvalid_m_nl", type="integer", nullable=true)
     */
    private $nbProspCoordNonvalidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_coord_nonrens_m_nl", type="integer", nullable=true)
     */
    private $nbProspCoordNonrensMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_email_valid_m_nl", type="integer", nullable=true)
     */
    private $nbProspEmailValidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_email_nonvalid_m_nl", type="integer", nullable=true)
     */
    private $nbProspEmailNonvalidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_email_nonrens_m_nl", type="integer", nullable=true)
     */
    private $nbProspEmailNonrensMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_tel_valid_m_nl", type="integer", nullable=true)
     */
    private $nbProspTelValidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_tel_nonvalid_m_nl", type="integer", nullable=true)
     */
    private $nbProspTelNonvalidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_tel_nonrens_m_nl", type="integer", nullable=true)
     */
    private $nbProspTelNonrensMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_add_valid_m_nl", type="integer", nullable=true)
     */
    private $nbProspAddValidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_add_nonvalid_m_nl", type="integer", nullable=true)
     */
    private $nbProspAddNonvalidMNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_add_nonrens_m_nl", type="integer", nullable=true)
     */
    private $nbProspAddNonrensMNL;



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
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_coord_valid_y_l", type="integer", nullable=true)
     */
    private $nbProspCoordValidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_coord_nonvalid_y_l", type="integer", nullable=true)
     */
    private $nbProspCoordNonvalidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_coord_nonrens_y_l", type="integer", nullable=true)
     */
    private $nbProspCoordNonrensYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_email_valid_y_l", type="integer", nullable=true)
     */
    private $nbProspEmailValidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_email_nonvalid_y_l", type="integer", nullable=true)
     */
    private $nbProspEmailNonvalidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_email_nonrens_y_l", type="integer", nullable=true)
     */
    private $nbProspEmailNonrensYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_tel_valid_y_l", type="integer", nullable=true)
     */
    private $nbProspTelValidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_tel_nonvalid_y_l", type="integer", nullable=true)
     */
    private $nbProspTelNonvalidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_tel_nonrens_y_l", type="integer", nullable=true)
     */
    private $nbProspTelNonrensYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_add_valid_y_l", type="integer", nullable=true)
     */
    private $nbProspAddValidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_add_nonvalid_y_l", type="integer", nullable=true)
     */
    private $nbProspAddNonvalidYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_add_nonrens_y_l", type="integer", nullable=true)
     */
    private $nbProspAddNonrensYL;



    /***** NOMBRE COMPLEMENT AUX POURCENTAGES *****/

    /* YNL */



    /**
     * @var integer
     *
     * @ORM\Column(name="nb_optin_y_nl", type="integer", nullable=true)
     */
    private $nbOptinYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_optout_y_nl", type="integer", nullable=true)
     */
    private $nbOptoutYNL;

    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_optin_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctOptinYNL;

    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_optout_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctOptoutYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_valid_y_nl", type="integer", nullable=true)
     */
    private $nbCliCoordValidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_nonvalid_y_nl", type="integer", nullable=true)
     */
    private $nbCliCoordNonvalidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_coord_nonrens_y_nl", type="integer", nullable=true)
     */
    private $nbCliCoordNonrensYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_valid_y_nl", type="integer", nullable=true)
     */
    private $nbCliEmailValidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_nonvalid_y_nl", type="integer", nullable=true)
     */
    private $nbCliEmailNonvalidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_email_nonrens_y_nl", type="integer", nullable=true)
     */
    private $nbCliEmailNonrensYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_valid_y_nl", type="integer", nullable=true)
     */
    private $nbCliTelValidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_nonvalid_y_nl", type="integer", nullable=true)
     */
    private $nbCliTelNonvalidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_tel_nonrens_y_nl", type="integer", nullable=true)
     */
    private $nbCliTelNonrensYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_valid_y_nl", type="integer", nullable=true)
     */
    private $nbCliAddValidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_nonvalid_y_nl", type="integer", nullable=true)
     */
    private $nbCliAddNonvalidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_cli_add_nonrens_y_nl", type="integer", nullable=true)
     */
    private $nbCliAddNonrensYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_coord_valid_y_nl", type="integer", nullable=true)
     */
    private $nbProspCoordValidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_coord_nonvalid_y_nl", type="integer", nullable=true)
     */
    private $nbProspCoordNonvalidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_coord_nonrens_y_nl", type="integer", nullable=true)
     */
    private $nbProspCoordNonrensYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_email_valid_y_nl", type="integer", nullable=true)
     */
    private $nbProspEmailValidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_email_nonvalid_y_nl", type="integer", nullable=true)
     */
    private $nbProspEmailNonvalidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_email_nonrens_y_nl", type="integer", nullable=true)
     */
    private $nbProspEmailNonrensYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_tel_valid_y_nl", type="integer", nullable=true)
     */
    private $nbProspTelValidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_tel_nonvalid_y_nl", type="integer", nullable=true)
     */
    private $nbProspTelNonvalidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_tel_nonrens_y_nl", type="integer", nullable=true)
     */
    private $nbProspTelNonrensYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_add_valid_y_nl", type="integer", nullable=true)
     */
    private $nbProspAddValidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_add_nonvalid_y_nl", type="integer", nullable=true)
     */
    private $nbProspAddNonvalidYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_add_nonrens_y_nl", type="integer", nullable=true)
     */
    private $nbProspAddNonrensYNL;


    /**** VALEUR + % PROSPECT OPTOUT *****/


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_optout_y_l", type="integer", nullable=true)
     */
    private $nbProspOptoutYL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_optout_y_nl", type="integer", nullable=true)
     */
    private $nbProspOptoutYNL;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_optout_m_l", type="integer", nullable=true)
     */
    private $nbProspOptoutMl;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_prosp_optout_m_nl", type="integer", nullable=true)
     */
    private $nbProspOptoutMNL;

    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_optout_y_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspOptoutYL;

    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_optout_y_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspOptoutYNL;

    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_optout_m_l", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspOptoutMl;

    /**
     * @var decimal
     *
     * @ORM\Column(name="pct_prosp_optout_m_nl", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $pctProspOptoutMNL;
    
                                   
    

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return kpiCapture
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return kpiCapture
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
     * Set codeBoutiqueVendeur
     *
     * @param string $codeBoutiqueVendeur
     *
     * @return kpiCapture
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
     * Set niveau
     *
     * @param string $niveau
     *
     * @return kpiCapture
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
        return $this->getCodeBoutiqueVendeur();
    }

    /******************************/
    /******************************/

    

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
     * Set nbCliMNL
     *
     * @param integer $nbCliMNL
     * @return KpiCapture
     */
    public function setNbCliMNL($nbCliMNL)
    {
        $this->nbCliMNL = $nbCliMNL;

        return $this;
    }

    /**
     * Get nbCliMNL
     *
     * @return integer 
     */
    public function getNbCliMNL()
    {
        return $this->nbCliMNL;
    }

    /**
     * Set pctCliCoordValidMNL
     *
     * @param string $pctCliCoordValidMNL
     * @return KpiCapture
     */
    public function setPctCliCoordValidMNL($pctCliCoordValidMNL)
    {
        $this->pctCliCoordValidMNL = $pctCliCoordValidMNL;

        return $this;
    }

    /**
     * Get pctCliCoordValidMNL
     *
     * @return string 
     */
    public function getPctCliCoordValidMNL()
    {
        return $this->pctCliCoordValidMNL;
    }

    /**
     * Set pctCliCoordNonvalidMNL
     *
     * @param string $pctCliCoordNonvalidMNL
     * @return KpiCapture
     */
    public function setPctCliCoordNonvalidMNL($pctCliCoordNonvalidMNL)
    {
        $this->pctCliCoordNonvalidMNL = $pctCliCoordNonvalidMNL;

        return $this;
    }

    /**
     * Get pctCliCoordNonvalidMNL
     *
     * @return string 
     */
    public function getPctCliCoordNonvalidMNL()
    {
        return $this->pctCliCoordNonvalidMNL;
    }

    /**
     * Set pctCliCoordNonrensMNL
     *
     * @param string $pctCliCoordNonrensMNL
     * @return KpiCapture
     */
    public function setPctCliCoordNonrensMNL($pctCliCoordNonrensMNL)
    {
        $this->pctCliCoordNonrensMNL = $pctCliCoordNonrensMNL;

        return $this;
    }

    /**
     * Get pctCliCoordNonrensMNL
     *
     * @return string 
     */
    public function getPctCliCoordNonrensMNL()
    {
        return $this->pctCliCoordNonrensMNL;
    }

    /**
     * Set pctCliEmailValidMNL
     *
     * @param string $pctCliEmailValidMNL
     * @return KpiCapture
     */
    public function setPctCliEmailValidMNL($pctCliEmailValidMNL)
    {
        $this->pctCliEmailValidMNL = $pctCliEmailValidMNL;

        return $this;
    }

    /**
     * Get pctCliEmailValidMNL
     *
     * @return string 
     */
    public function getPctCliEmailValidMNL()
    {
        return $this->pctCliEmailValidMNL;
    }

    /**
     * Set pctCliEmailNonvalidMNL
     *
     * @param string $pctCliEmailNonvalidMNL
     * @return KpiCapture
     */
    public function setPctCliEmailNonvalidMNL($pctCliEmailNonvalidMNL)
    {
        $this->pctCliEmailNonvalidMNL = $pctCliEmailNonvalidMNL;

        return $this;
    }

    /**
     * Get pctCliEmailNonvalidMNL
     *
     * @return string 
     */
    public function getPctCliEmailNonvalidMNL()
    {
        return $this->pctCliEmailNonvalidMNL;
    }

    /**
     * Set pctCliEmailNonrensMNL
     *
     * @param string $pctCliEmailNonrensMNL
     * @return KpiCapture
     */
    public function setPctCliEmailNonrensMNL($pctCliEmailNonrensMNL)
    {
        $this->pctCliEmailNonrensMNL = $pctCliEmailNonrensMNL;

        return $this;
    }

    /**
     * Get pctCliEmailNonrensMNL
     *
     * @return string 
     */
    public function getPctCliEmailNonrensMNL()
    {
        return $this->pctCliEmailNonrensMNL;
    }

    /**
     * Set pctCliTelValidMNL
     *
     * @param string $pctCliTelValidMNL
     * @return KpiCapture
     */
    public function setPctCliTelValidMNL($pctCliTelValidMNL)
    {
        $this->pctCliTelValidMNL = $pctCliTelValidMNL;

        return $this;
    }

    /**
     * Get pctCliTelValidMNL
     *
     * @return string 
     */
    public function getPctCliTelValidMNL()
    {
        return $this->pctCliTelValidMNL;
    }

    /**
     * Set pctCliTelNonvalidMNL
     *
     * @param string $pctCliTelNonvalidMNL
     * @return KpiCapture
     */
    public function setPctCliTelNonvalidMNL($pctCliTelNonvalidMNL)
    {
        $this->pctCliTelNonvalidMNL = $pctCliTelNonvalidMNL;

        return $this;
    }

    /**
     * Get pctCliTelNonvalidMNL
     *
     * @return string 
     */
    public function getPctCliTelNonvalidMNL()
    {
        return $this->pctCliTelNonvalidMNL;
    }

    /**
     * Set pctCliTelNonrensMNL
     *
     * @param string $pctCliTelNonrensMNL
     * @return KpiCapture
     */
    public function setPctCliTelNonrensMNL($pctCliTelNonrensMNL)
    {
        $this->pctCliTelNonrensMNL = $pctCliTelNonrensMNL;

        return $this;
    }

    /**
     * Get pctCliTelNonrensMNL
     *
     * @return string 
     */
    public function getPctCliTelNonrensMNL()
    {
        return $this->pctCliTelNonrensMNL;
    }

    /**
     * Set pctCliAddValidMNL
     *
     * @param string $pctCliAddValidMNL
     * @return KpiCapture
     */
    public function setPctCliAddValidMNL($pctCliAddValidMNL)
    {
        $this->pctCliAddValidMNL = $pctCliAddValidMNL;

        return $this;
    }

    /**
     * Get pctCliAddValidMNL
     *
     * @return string 
     */
    public function getPctCliAddValidMNL()
    {
        return $this->pctCliAddValidMNL;
    }

    /**
     * Set pctCliAddNonrensMNL
     *
     * @param string $pctCliAddNonrensMNL
     * @return KpiCapture
     */
    public function setPctCliAddNonrensMNL($pctCliAddNonrensMNL)
    {
        $this->pctCliAddNonrensMNL = $pctCliAddNonrensMNL;

        return $this;
    }

    /**
     * Get pctCliAddNonrensMNL
     *
     * @return string 
     */
    public function getPctCliAddNonrensMNL()
    {
        return $this->pctCliAddNonrensMNL;
    }

    /**
     * Set pctCliAddNonvalidMNL
     *
     * @param string $pctCliAddNonvalidMNL
     * @return KpiCapture
     */
    public function setPctCliAddNonvalidMNL($pctCliAddNonvalidMNL)
    {
        $this->pctCliAddNonvalidMNL = $pctCliAddNonvalidMNL;

        return $this;
    }

    /**
     * Get pctCliAddNonvalidMNL
     *
     * @return string 
     */
    public function getPctCliAddNonvalidMNL()
    {
        return $this->pctCliAddNonvalidMNL;
    }

    /**
     * Set nbCliActifsMNL
     *
     * @param integer $nbCliActifsMNL
     * @return KpiCapture
     */
    public function setNbCliActifsMNL($nbCliActifsMNL)
    {
        $this->nbCliActifsMNL = $nbCliActifsMNL;

        return $this;
    }

    /**
     * Get nbCliActifsMNL
     *
     * @return integer 
     */
    public function getNbCliActifsMNL()
    {
        return $this->nbCliActifsMNL;
    }

    /**
     * Set nbCliActifsNewMNL
     *
     * @param integer $nbCliActifsNewMNL
     * @return KpiCapture
     */
    public function setNbCliActifsNewMNL($nbCliActifsNewMNL)
    {
        $this->nbCliActifsNewMNL = $nbCliActifsNewMNL;

        return $this;
    }

    /**
     * Get nbCliActifsNewMNL
     *
     * @return integer 
     */
    public function getNbCliActifsNewMNL()
    {
        return $this->nbCliActifsNewMNL;
    }

    /**
     * Set nbCliActifsExistMNL
     *
     * @param integer $nbCliActifsExistMNL
     * @return KpiCapture
     */
    public function setNbCliActifsExistMNL($nbCliActifsExistMNL)
    {
        $this->nbCliActifsExistMNL = $nbCliActifsExistMNL;

        return $this;
    }

    /**
     * Get nbCliActifsExistMNL
     *
     * @return integer 
     */
    public function getNbCliActifsExistMNL()
    {
        return $this->nbCliActifsExistMNL;
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
     * Set nbCliYNL
     *
     * @param integer $nbCliYNL
     * @return KpiCapture
     */
    public function setNbCliYNL($nbCliYNL)
    {
        $this->nbCliYNL = $nbCliYNL;

        return $this;
    }

    /**
     * Get nbCliYNL
     *
     * @return integer 
     */
    public function getNbCliYNL()
    {
        return $this->nbCliYNL;
    }

    /**
     * Set pctCliCoordValidYNL
     *
     * @param string $pctCliCoordValidYNL
     * @return KpiCapture
     */
    public function setPctCliCoordValidYNL($pctCliCoordValidYNL)
    {
        $this->pctCliCoordValidYNL = $pctCliCoordValidYNL;

        return $this;
    }

    /**
     * Get pctCliCoordValidYNL
     *
     * @return string 
     */
    public function getPctCliCoordValidYNL()
    {
        return $this->pctCliCoordValidYNL;
    }

    /**
     * Set pctCliCoordNonvalidYNL
     *
     * @param string $pctCliCoordNonvalidYNL
     * @return KpiCapture
     */
    public function setPctCliCoordNonvalidYNL($pctCliCoordNonvalidYNL)
    {
        $this->pctCliCoordNonvalidYNL = $pctCliCoordNonvalidYNL;

        return $this;
    }

    /**
     * Get pctCliCoordNonvalidYNL
     *
     * @return string 
     */
    public function getPctCliCoordNonvalidYNL()
    {
        return $this->pctCliCoordNonvalidYNL;
    }

    /**
     * Set pctCliCoordNonrensYNL
     *
     * @param string $pctCliCoordNonrensYNL
     * @return KpiCapture
     */
    public function setPctCliCoordNonrensYNL($pctCliCoordNonrensYNL)
    {
        $this->pctCliCoordNonrensYNL = $pctCliCoordNonrensYNL;

        return $this;
    }

    /**
     * Get pctCliCoordNonrensYNL
     *
     * @return string 
     */
    public function getPctCliCoordNonrensYNL()
    {
        return $this->pctCliCoordNonrensYNL;
    }

    /**
     * Set pctCliEmailValidYNL
     *
     * @param string $pctCliEmailValidYNL
     * @return KpiCapture
     */
    public function setPctCliEmailValidYNL($pctCliEmailValidYNL)
    {
        $this->pctCliEmailValidYNL = $pctCliEmailValidYNL;

        return $this;
    }

    /**
     * Get pctCliEmailValidYNL
     *
     * @return string 
     */
    public function getPctCliEmailValidYNL()
    {
        return $this->pctCliEmailValidYNL;
    }

    /**
     * Set pctCliEmailNonvalidYNL
     *
     * @param string $pctCliEmailNonvalidYNL
     * @return KpiCapture
     */
    public function setPctCliEmailNonvalidYNL($pctCliEmailNonvalidYNL)
    {
        $this->pctCliEmailNonvalidYNL = $pctCliEmailNonvalidYNL;

        return $this;
    }

    /**
     * Get pctCliEmailNonvalidYNL
     *
     * @return string 
     */
    public function getPctCliEmailNonvalidYNL()
    {
        return $this->pctCliEmailNonvalidYNL;
    }

    /**
     * Set pctCliEmailNonrensYNL
     *
     * @param string $pctCliEmailNonrensYNL
     * @return KpiCapture
     */
    public function setPctCliEmailNonrensYNL($pctCliEmailNonrensYNL)
    {
        $this->pctCliEmailNonrensYNL = $pctCliEmailNonrensYNL;

        return $this;
    }

    /**
     * Get pctCliEmailNonrensYNL
     *
     * @return string 
     */
    public function getPctCliEmailNonrensYNL()
    {
        return $this->pctCliEmailNonrensYNL;
    }

    /**
     * Set pctCliTelValidYNL
     *
     * @param string $pctCliTelValidYNL
     * @return KpiCapture
     */
    public function setPctCliTelValidYNL($pctCliTelValidYNL)
    {
        $this->pctCliTelValidYNL = $pctCliTelValidYNL;

        return $this;
    }

    /**
     * Get pctCliTelValidYNL
     *
     * @return string 
     */
    public function getPctCliTelValidYNL()
    {
        return $this->pctCliTelValidYNL;
    }

    /**
     * Set pctCliTelNonvalidYNL
     *
     * @param string $pctCliTelNonvalidYNL
     * @return KpiCapture
     */
    public function setPctCliTelNonvalidYNL($pctCliTelNonvalidYNL)
    {
        $this->pctCliTelNonvalidYNL = $pctCliTelNonvalidYNL;

        return $this;
    }

    /**
     * Get pctCliTelNonvalidYNL
     *
     * @return string 
     */
    public function getPctCliTelNonvalidYNL()
    {
        return $this->pctCliTelNonvalidYNL;
    }

    /**
     * Set pctCliTelNonrensYNL
     *
     * @param string $pctCliTelNonrensYNL
     * @return KpiCapture
     */
    public function setPctCliTelNonrensYNL($pctCliTelNonrensYNL)
    {
        $this->pctCliTelNonrensYNL = $pctCliTelNonrensYNL;

        return $this;
    }

    /**
     * Get pctCliTelNonrensYNL
     *
     * @return string 
     */
    public function getPctCliTelNonrensYNL()
    {
        return $this->pctCliTelNonrensYNL;
    }

    /**
     * Set pctCliAddValidYNL
     *
     * @param string $pctCliAddValidYNL
     * @return KpiCapture
     */
    public function setPctCliAddValidYNL($pctCliAddValidYNL)
    {
        $this->pctCliAddValidYNL = $pctCliAddValidYNL;

        return $this;
    }

    /**
     * Get pctCliAddValidYNL
     *
     * @return string 
     */
    public function getPctCliAddValidYNL()
    {
        return $this->pctCliAddValidYNL;
    }

    /**
     * Set pctCliAddNonrensYNL
     *
     * @param string $pctCliAddNonrensYNL
     * @return KpiCapture
     */
    public function setPctCliAddNonrensYNL($pctCliAddNonrensYNL)
    {
        $this->pctCliAddNonrensYNL = $pctCliAddNonrensYNL;

        return $this;
    }

    /**
     * Get pctCliAddNonrensYNL
     *
     * @return string 
     */
    public function getPctCliAddNonrensYNL()
    {
        return $this->pctCliAddNonrensYNL;
    }

    /**
     * Set pctCliAddNonvalidYNL
     *
     * @param string $pctCliAddNonvalidYNL
     * @return KpiCapture
     */
    public function setPctCliAddNonvalidYNL($pctCliAddNonvalidYNL)
    {
        $this->pctCliAddNonvalidYNL = $pctCliAddNonvalidYNL;

        return $this;
    }

    /**
     * Get pctCliAddNonvalidYNL
     *
     * @return string 
     */
    public function getPctCliAddNonvalidYNL()
    {
        return $this->pctCliAddNonvalidYNL;
    }

    /**
     * Set nbCliActifsYNL
     *
     * @param integer $nbCliActifsYNL
     * @return KpiCapture
     */
    public function setNbCliActifsYNL($nbCliActifsYNL)
    {
        $this->nbCliActifsYNL = $nbCliActifsYNL;

        return $this;
    }

    /**
     * Get nbCliActifsYNL
     *
     * @return integer 
     */
    public function getNbCliActifsYNL()
    {
        return $this->nbCliActifsYNL;
    }

    /**
     * Set nbCliActifsNewYNL
     *
     * @param integer $nbCliActifsNewYNL
     * @return KpiCapture
     */
    public function setNbCliActifsNewYNL($nbCliActifsNewYNL)
    {
        $this->nbCliActifsNewYNL = $nbCliActifsNewYNL;

        return $this;
    }

    /**
     * Get nbCliActifsNewYNL
     *
     * @return integer 
     */
    public function getNbCliActifsNewYNL()
    {
        return $this->nbCliActifsNewYNL;
    }

    /**
     * Set nbCliActifsExistYNL
     *
     * @param integer $nbCliActifsExistYNL
     * @return KpiCapture
     */
    public function setNbCliActifsExistYNL($nbCliActifsExistYNL)
    {
        $this->nbCliActifsExistYNL = $nbCliActifsExistYNL;

        return $this;
    }

    /**
     * Get nbCliActifsExistYNL
     *
     * @return integer 
     */
    public function getNbCliActifsExistYNL()
    {
        return $this->nbCliActifsExistYNL;
    }

    /**
     * Set nbEmailYNL
     *
     * @param integer $nbEmailYNL
     * @return KpiCapture
     */
    public function setNbEmailYNL($nbEmailYNL)
    {
        $this->nbEmailYNL = $nbEmailYNL;

        return $this;
    }

    /**
     * Get nbEmailYNL
     *
     * @return integer 
     */
    public function getNbEmailYNL()
    {
        return $this->nbEmailYNL;
    }

    /**
     * Set nbTelYNL
     *
     * @param integer $nbTelYNL
     * @return KpiCapture
     */
    public function setNbTelYNL($nbTelYNL)
    {
        $this->nbTelYNL = $nbTelYNL;

        return $this;
    }

    /**
     * Get nbTelYNL
     *
     * @return integer 
     */
    public function getNbTelYNL()
    {
        return $this->nbTelYNL;
    }

    /**
     * Set nbAdrYNL
     *
     * @param integer $nbAdrYNL
     * @return KpiCapture
     */
    public function setNbAdrYNL($nbAdrYNL)
    {
        $this->nbAdrYNL = $nbAdrYNL;

        return $this;
    }

    /**
     * Get nbAdrYNL
     *
     * @return integer 
     */
    public function getNbAdrYNL()
    {
        return $this->nbAdrYNL;
    }

    /**
     * Set pctCliDonneesNonvalidYNL
     *
     * @param integer $pctCliDonneesNonvalidYNL
     * @return KpiCapture
     */
    public function setPctCliDonneesNonvalidYNL($pctCliDonneesNonvalidYNL)
    {
        $this->pctCliDonneesNonvalidYNL = $pctCliDonneesNonvalidYNL;

        return $this;
    }

    /**
     * Get pctCliDonneesNonvalidYNL
     *
     * @return integer 
     */
    public function getPctCliDonneesNonvalidYNL()
    {
        return $this->pctCliDonneesNonvalidYNL;
    }

    /**
     * Set nbProspYNL
     *
     * @param integer $nbProspYNL
     * @return KpiCapture
     */
    public function setNbProspYNL($nbProspYNL)
    {
        $this->nbProspYNL = $nbProspYNL;

        return $this;
    }

    /**
     * Get nbProspYNL
     *
     * @return integer 
     */
    public function getNbProspYNL()
    {
        return $this->nbProspYNL;
    }

    /**
     * Set nbEmailNonvalidYNL
     *
     * @param integer $nbEmailNonvalidYNL
     * @return KpiCapture
     */
    public function setNbEmailNonvalidYNL($nbEmailNonvalidYNL)
    {
        $this->nbEmailNonvalidYNL = $nbEmailNonvalidYNL;

        return $this;
    }

    /**
     * Get nbEmailNonvalidYNL
     *
     * @return integer 
     */
    public function getNbEmailNonvalidYNL()
    {
        return $this->nbEmailNonvalidYNL;
    }

    /**
     * Set nbTelNonvalidYNL
     *
     * @param integer $nbTelNonvalidYNL
     * @return KpiCapture
     */
    public function setNbTelNonvalidYNL($nbTelNonvalidYNL)
    {
        $this->nbTelNonvalidYNL = $nbTelNonvalidYNL;

        return $this;
    }

    /**
     * Get nbTelNonvalidYNL
     *
     * @return integer 
     */
    public function getNbTelNonvalidYNL()
    {
        return $this->nbTelNonvalidYNL;
    }

    /**
     * Set nbAdrNonvalidYNL
     *
     * @param integer $nbAdrNonvalidYNL
     * @return KpiCapture
     */
    public function setNbAdrNonvalidYNL($nbAdrNonvalidYNL)
    {
        $this->nbAdrNonvalidYNL = $nbAdrNonvalidYNL;

        return $this;
    }

    /**
     * Get nbAdrNonvalidYNL
     *
     * @return integer 
     */
    public function getNbAdrNonvalidYNL()
    {
        return $this->nbAdrNonvalidYNL;
    }

    /**
     * Set pctProspCoordValidYNL
     *
     * @param string $pctProspCoordValidYNL
     * @return KpiCapture
     */
    public function setPctProspCoordValidYNL($pctProspCoordValidYNL)
    {
        $this->pctProspCoordValidYNL = $pctProspCoordValidYNL;

        return $this;
    }

    /**
     * Get pctProspCoordValidYNL
     *
     * @return string 
     */
    public function getPctProspCoordValidYNL()
    {
        return $this->pctProspCoordValidYNL;
    }

    /**
     * Set pctProspCoordNonvalidYNL
     *
     * @param string $pctProspCoordNonvalidYNL
     * @return KpiCapture
     */
    public function setPctProspCoordNonvalidYNL($pctProspCoordNonvalidYNL)
    {
        $this->pctProspCoordNonvalidYNL = $pctProspCoordNonvalidYNL;

        return $this;
    }

    /**
     * Get pctProspCoordNonvalidYNL
     *
     * @return string 
     */
    public function getPctProspCoordNonvalidYNL()
    {
        return $this->pctProspCoordNonvalidYNL;
    }

    /**
     * Set pctProspCoordNonrensYNL
     *
     * @param string $pctProspCoordNonrensYNL
     * @return KpiCapture
     */
    public function setPctProspCoordNonrensYNL($pctProspCoordNonrensYNL)
    {
        $this->pctProspCoordNonrensYNL = $pctProspCoordNonrensYNL;

        return $this;
    }

    /**
     * Get pctProspCoordNonrensYNL
     *
     * @return string 
     */
    public function getPctProspCoordNonrensYNL()
    {
        return $this->pctProspCoordNonrensYNL;
    }

    /**
     * Set pctProspEmailValidYNL
     *
     * @param string $pctProspEmailValidYNL
     * @return KpiCapture
     */
    public function setPctProspEmailValidYNL($pctProspEmailValidYNL)
    {
        $this->pctProspEmailValidYNL = $pctProspEmailValidYNL;

        return $this;
    }

    /**
     * Get pctProspEmailValidYNL
     *
     * @return string 
     */
    public function getPctProspEmailValidYNL()
    {
        return $this->pctProspEmailValidYNL;
    }

    /**
     * Set pctProspEmailNonvalidYNL
     *
     * @param string $pctProspEmailNonvalidYNL
     * @return KpiCapture
     */
    public function setPctProspEmailNonvalidYNL($pctProspEmailNonvalidYNL)
    {
        $this->pctProspEmailNonvalidYNL = $pctProspEmailNonvalidYNL;

        return $this;
    }

    /**
     * Get pctProspEmailNonvalidYNL
     *
     * @return string 
     */
    public function getPctProspEmailNonvalidYNL()
    {
        return $this->pctProspEmailNonvalidYNL;
    }

    /**
     * Set pctProspEmailNonrensYNL
     *
     * @param string $pctProspEmailNonrensYNL
     * @return KpiCapture
     */
    public function setPctProspEmailNonrensYNL($pctProspEmailNonrensYNL)
    {
        $this->pctProspEmailNonrensYNL = $pctProspEmailNonrensYNL;

        return $this;
    }

    /**
     * Get pctProspEmailNonrensYNL
     *
     * @return string 
     */
    public function getPctProspEmailNonrensYNL()
    {
        return $this->pctProspEmailNonrensYNL;
    }

    /**
     * Set pctProspTelValidYNL
     *
     * @param string $pctProspTelValidYNL
     * @return KpiCapture
     */
    public function setPctProspTelValidYNL($pctProspTelValidYNL)
    {
        $this->pctProspTelValidYNL = $pctProspTelValidYNL;

        return $this;
    }

    /**
     * Get pctProspTelValidYNL
     *
     * @return string 
     */
    public function getPctProspTelValidYNL()
    {
        return $this->pctProspTelValidYNL;
    }

    /**
     * Set pctProspTelNonvalidYNL
     *
     * @param string $pctProspTelNonvalidYNL
     * @return KpiCapture
     */
    public function setPctProspTelNonvalidYNL($pctProspTelNonvalidYNL)
    {
        $this->pctProspTelNonvalidYNL = $pctProspTelNonvalidYNL;

        return $this;
    }

    /**
     * Get pctProspTelNonvalidYNL
     *
     * @return string 
     */
    public function getPctProspTelNonvalidYNL()
    {
        return $this->pctProspTelNonvalidYNL;
    }

    /**
     * Set pctProspTelNonrensYNL
     *
     * @param string $pctProspTelNonrensYNL
     * @return KpiCapture
     */
    public function setPctProspTelNonrensYNL($pctProspTelNonrensYNL)
    {
        $this->pctProspTelNonrensYNL = $pctProspTelNonrensYNL;

        return $this;
    }

    /**
     * Get pctProspTelNonrensYNL
     *
     * @return string 
     */
    public function getPctProspTelNonrensYNL()
    {
        return $this->pctProspTelNonrensYNL;
    }

    /**
     * Set pctProspAddValidYNL
     *
     * @param string $pctProspAddValidYNL
     * @return KpiCapture
     */
    public function setPctProspAddValidYNL($pctProspAddValidYNL)
    {
        $this->pctProspAddValidYNL = $pctProspAddValidYNL;

        return $this;
    }

    /**
     * Get pctProspAddValidYNL
     *
     * @return string 
     */
    public function getPctProspAddValidYNL()
    {
        return $this->pctProspAddValidYNL;
    }

    /**
     * Set pctProspAddNonvalidYNL
     *
     * @param string $pctProspAddNonvalidYNL
     * @return KpiCapture
     */
    public function setPctProspAddNonvalidYNL($pctProspAddNonvalidYNL)
    {
        $this->pctProspAddNonvalidYNL = $pctProspAddNonvalidYNL;

        return $this;
    }

    /**
     * Get pctProspAddNonvalidYNL
     *
     * @return string 
     */
    public function getPctProspAddNonvalidYNL()
    {
        return $this->pctProspAddNonvalidYNL;
    }

    /**
     * Set pctProspAddNonrensYNL
     *
     * @param string $pctProspAddNonrensYNL
     * @return KpiCapture
     */
    public function setPctProspAddNonrensYNL($pctProspAddNonrensYNL)
    {
        $this->pctProspAddNonrensYNL = $pctProspAddNonrensYNL;

        return $this;
    }

    /**
     * Get pctProspAddNonrensYNL
     *
     * @return string 
     */
    public function getPctProspAddNonrensYNL()
    {
        return $this->pctProspAddNonrensYNL;
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
     * Set pctProspCoordValidYL
     *
     * @param string $pctProspCoordValidYL
     * @return KpiCapture
     */
    public function setPctProspCoordValidYL($pctProspCoordValidYL)
    {
        $this->pctProspCoordValidYL = $pctProspCoordValidYL;

        return $this;
    }

    /**
     * Get pctProspCoordValidYL
     *
     * @return string 
     */
    public function getPctProspCoordValidYL()
    {
        return $this->pctProspCoordValidYL;
    }

    /**
     * Set pctProspCoordNonvalidYL
     *
     * @param string $pctProspCoordNonvalidYL
     * @return KpiCapture
     */
    public function setPctProspCoordNonvalidYL($pctProspCoordNonvalidYL)
    {
        $this->pctProspCoordNonvalidYL = $pctProspCoordNonvalidYL;

        return $this;
    }

    /**
     * Get pctProspCoordNonvalidYL
     *
     * @return string 
     */
    public function getPctProspCoordNonvalidYL()
    {
        return $this->pctProspCoordNonvalidYL;
    }

    /**
     * Set pctProspCoordNonrensYL
     *
     * @param string $pctProspCoordNonrensYL
     * @return KpiCapture
     */
    public function setPctProspCoordNonrensYL($pctProspCoordNonrensYL)
    {
        $this->pctProspCoordNonrensYL = $pctProspCoordNonrensYL;

        return $this;
    }

    /**
     * Get pctProspCoordNonrensYL
     *
     * @return string 
     */
    public function getPctProspCoordNonrensYL()
    {
        return $this->pctProspCoordNonrensYL;
    }

    /**
     * Set pctProspEmailValidYL
     *
     * @param string $pctProspEmailValidYL
     * @return KpiCapture
     */
    public function setPctProspEmailValidYL($pctProspEmailValidYL)
    {
        $this->pctProspEmailValidYL = $pctProspEmailValidYL;

        return $this;
    }

    /**
     * Get pctProspEmailValidYL
     *
     * @return string 
     */
    public function getPctProspEmailValidYL()
    {
        return $this->pctProspEmailValidYL;
    }

    /**
     * Set pctProspEmailNonvalidYL
     *
     * @param string $pctProspEmailNonvalidYL
     * @return KpiCapture
     */
    public function setPctProspEmailNonvalidYL($pctProspEmailNonvalidYL)
    {
        $this->pctProspEmailNonvalidYL = $pctProspEmailNonvalidYL;

        return $this;
    }

    /**
     * Get pctProspEmailNonvalidYL
     *
     * @return string 
     */
    public function getPctProspEmailNonvalidYL()
    {
        return $this->pctProspEmailNonvalidYL;
    }

    /**
     * Set pctProspEmailNonrensYL
     *
     * @param string $pctProspEmailNonrensYL
     * @return KpiCapture
     */
    public function setPctProspEmailNonrensYL($pctProspEmailNonrensYL)
    {
        $this->pctProspEmailNonrensYL = $pctProspEmailNonrensYL;

        return $this;
    }

    /**
     * Get pctProspEmailNonrensYL
     *
     * @return string 
     */
    public function getPctProspEmailNonrensYL()
    {
        return $this->pctProspEmailNonrensYL;
    }

    /**
     * Set pctProspTelValidYL
     *
     * @param string $pctProspTelValidYL
     * @return KpiCapture
     */
    public function setPctProspTelValidYL($pctProspTelValidYL)
    {
        $this->pctProspTelValidYL = $pctProspTelValidYL;

        return $this;
    }

    /**
     * Get pctProspTelValidYL
     *
     * @return string 
     */
    public function getPctProspTelValidYL()
    {
        return $this->pctProspTelValidYL;
    }

    /**
     * Set pctProspTelNonvalidYL
     *
     * @param string $pctProspTelNonvalidYL
     * @return KpiCapture
     */
    public function setPctProspTelNonvalidYL($pctProspTelNonvalidYL)
    {
        $this->pctProspTelNonvalidYL = $pctProspTelNonvalidYL;

        return $this;
    }

    /**
     * Get pctProspTelNonvalidYL
     *
     * @return string 
     */
    public function getPctProspTelNonvalidYL()
    {
        return $this->pctProspTelNonvalidYL;
    }

    /**
     * Set pctProspTelNonrensYL
     *
     * @param string $pctProspTelNonrensYL
     * @return KpiCapture
     */
    public function setPctProspTelNonrensYL($pctProspTelNonrensYL)
    {
        $this->pctProspTelNonrensYL = $pctProspTelNonrensYL;

        return $this;
    }

    /**
     * Get pctProspTelNonrensYL
     *
     * @return string 
     */
    public function getPctProspTelNonrensYL()
    {
        return $this->pctProspTelNonrensYL;
    }

    /**
     * Set pctProspAddValidYL
     *
     * @param string $pctProspAddValidYL
     * @return KpiCapture
     */
    public function setPctProspAddValidYL($pctProspAddValidYL)
    {
        $this->pctProspAddValidYL = $pctProspAddValidYL;

        return $this;
    }

    /**
     * Get pctProspAddValidYL
     *
     * @return string 
     */
    public function getPctProspAddValidYL()
    {
        return $this->pctProspAddValidYL;
    }

    /**
     * Set pctProspAddNonvalidYL
     *
     * @param string $pctProspAddNonvalidYL
     * @return KpiCapture
     */
    public function setPctProspAddNonvalidYL($pctProspAddNonvalidYL)
    {
        $this->pctProspAddNonvalidYL = $pctProspAddNonvalidYL;

        return $this;
    }

    /**
     * Get pctProspAddNonvalidYL
     *
     * @return string 
     */
    public function getPctProspAddNonvalidYL()
    {
        return $this->pctProspAddNonvalidYL;
    }

    /**
     * Set pctProspAddNonrensYL
     *
     * @param string $pctProspAddNonrensYL
     * @return KpiCapture
     */
    public function setPctProspAddNonrensYL($pctProspAddNonrensYL)
    {
        $this->pctProspAddNonrensYL = $pctProspAddNonrensYL;

        return $this;
    }

    /**
     * Get pctProspAddNonrensYL
     *
     * @return string 
     */
    public function getPctProspAddNonrensYL()
    {
        return $this->pctProspAddNonrensYL;
    }

    /**
     * Set nbProspML
     *
     * @param integer $nbProspML
     * @return KpiCapture
     */
    public function setNbProspML($nbProspML)
    {
        $this->nbProspML = $nbProspML;

        return $this;
    }

    /**
     * Get nbProspML
     *
     * @return integer 
     */
    public function getNbProspML()
    {
        return $this->nbProspML;
    }

    /**
     * Set pctProspCoordValidML
     *
     * @param string $pctProspCoordValidML
     * @return KpiCapture
     */
    public function setPctProspCoordValidML($pctProspCoordValidML)
    {
        $this->pctProspCoordValidML = $pctProspCoordValidML;

        return $this;
    }

    /**
     * Get pctProspCoordValidML
     *
     * @return string 
     */
    public function getPctProspCoordValidML()
    {
        return $this->pctProspCoordValidML;
    }

    /**
     * Set pctProspCoordNonvalidML
     *
     * @param string $pctProspCoordNonvalidML
     * @return KpiCapture
     */
    public function setPctProspCoordNonvalidML($pctProspCoordNonvalidML)
    {
        $this->pctProspCoordNonvalidML = $pctProspCoordNonvalidML;

        return $this;
    }

    /**
     * Get pctProspCoordNonvalidML
     *
     * @return string 
     */
    public function getPctProspCoordNonvalidML()
    {
        return $this->pctProspCoordNonvalidML;
    }

    /**
     * Set pctProspCoordNonrensML
     *
     * @param string $pctProspCoordNonrensML
     * @return KpiCapture
     */
    public function setPctProspCoordNonrensML($pctProspCoordNonrensML)
    {
        $this->pctProspCoordNonrensML = $pctProspCoordNonrensML;

        return $this;
    }

    /**
     * Get pctProspCoordNonrensML
     *
     * @return string 
     */
    public function getPctProspCoordNonrensML()
    {
        return $this->pctProspCoordNonrensML;
    }

    /**
     * Set pctProspEmailValidML
     *
     * @param string $pctProspEmailValidML
     * @return KpiCapture
     */
    public function setPctProspEmailValidML($pctProspEmailValidML)
    {
        $this->pctProspEmailValidML = $pctProspEmailValidML;

        return $this;
    }

    /**
     * Get pctProspEmailValidML
     *
     * @return string 
     */
    public function getPctProspEmailValidML()
    {
        return $this->pctProspEmailValidML;
    }

    /**
     * Set pctProspEmailNonvalidML
     *
     * @param string $pctProspEmailNonvalidML
     * @return KpiCapture
     */
    public function setPctProspEmailNonvalidML($pctProspEmailNonvalidML)
    {
        $this->pctProspEmailNonvalidML = $pctProspEmailNonvalidML;

        return $this;
    }

    /**
     * Get pctProspEmailNonvalidML
     *
     * @return string 
     */
    public function getPctProspEmailNonvalidML()
    {
        return $this->pctProspEmailNonvalidML;
    }

    /**
     * Set pctProspEmailNonrensML
     *
     * @param string $pctProspEmailNonrensML
     * @return KpiCapture
     */
    public function setPctProspEmailNonrensML($pctProspEmailNonrensML)
    {
        $this->pctProspEmailNonrensML = $pctProspEmailNonrensML;

        return $this;
    }

    /**
     * Get pctProspEmailNonrensML
     *
     * @return string 
     */
    public function getPctProspEmailNonrensML()
    {
        return $this->pctProspEmailNonrensML;
    }

    /**
     * Set pctProspTelValidML
     *
     * @param string $pctProspTelValidML
     * @return KpiCapture
     */
    public function setPctProspTelValidML($pctProspTelValidML)
    {
        $this->pctProspTelValidML = $pctProspTelValidML;

        return $this;
    }

    /**
     * Get pctProspTelValidML
     *
     * @return string 
     */
    public function getPctProspTelValidML()
    {
        return $this->pctProspTelValidML;
    }

    /**
     * Set pctProspTelNonvalidML
     *
     * @param string $pctProspTelNonvalidML
     * @return KpiCapture
     */
    public function setPctProspTelNonvalidML($pctProspTelNonvalidML)
    {
        $this->pctProspTelNonvalidML = $pctProspTelNonvalidML;

        return $this;
    }

    /**
     * Get pctProspTelNonvalidML
     *
     * @return string 
     */
    public function getPctProspTelNonvalidML()
    {
        return $this->pctProspTelNonvalidML;
    }

    /**
     * Set pctProspTelNonrensML
     *
     * @param string $pctProspTelNonrensML
     * @return KpiCapture
     */
    public function setPctProspTelNonrensML($pctProspTelNonrensML)
    {
        $this->pctProspTelNonrensML = $pctProspTelNonrensML;

        return $this;
    }

    /**
     * Get pctProspTelNonrensML
     *
     * @return string 
     */
    public function getPctProspTelNonrensML()
    {
        return $this->pctProspTelNonrensML;
    }

    /**
     * Set pctProspAddValidML
     *
     * @param string $pctProspAddValidML
     * @return KpiCapture
     */
    public function setPctProspAddValidML($pctProspAddValidML)
    {
        $this->pctProspAddValidML = $pctProspAddValidML;

        return $this;
    }

    /**
     * Get pctProspAddValidML
     *
     * @return string 
     */
    public function getPctProspAddValidML()
    {
        return $this->pctProspAddValidML;
    }

    /**
     * Set pctProspAddNonvalidML
     *
     * @param string $pctProspAddNonvalidML
     * @return KpiCapture
     */
    public function setPctProspAddNonvalidML($pctProspAddNonvalidML)
    {
        $this->pctProspAddNonvalidML = $pctProspAddNonvalidML;

        return $this;
    }

    /**
     * Get pctProspAddNonvalidML
     *
     * @return string 
     */
    public function getPctProspAddNonvalidML()
    {
        return $this->pctProspAddNonvalidML;
    }

    /**
     * Set pctProspAddNonrensML
     *
     * @param string $pctProspAddNonrensML
     * @return KpiCapture
     */
    public function setPctProspAddNonrensML($pctProspAddNonrensML)
    {
        $this->pctProspAddNonrensML = $pctProspAddNonrensML;

        return $this;
    }

    /**
     * Get pctProspAddNonrensML
     *
     * @return string 
     */
    public function getPctProspAddNonrensML()
    {
        return $this->pctProspAddNonrensML;
    }

    /**
     * Set nbProspMNL
     *
     * @param integer $nbProspMNL
     * @return KpiCapture
     */
    public function setNbProspMNL($nbProspMNL)
    {
        $this->nbProspMNL = $nbProspMNL;

        return $this;
    }

    /**
     * Get nbProspMNL
     *
     * @return integer 
     */
    public function getNbProspMNL()
    {
        return $this->nbProspMNL;
    }

    /**
     * Set pctProspCoordValidMNL
     *
     * @param string $pctProspCoordValidMNL
     * @return KpiCapture
     */
    public function setPctProspCoordValidMNL($pctProspCoordValidMNL)
    {
        $this->pctProspCoordValidMNL = $pctProspCoordValidMNL;

        return $this;
    }

    /**
     * Get pctProspCoordValidMNL
     *
     * @return string 
     */
    public function getPctProspCoordValidMNL()
    {
        return $this->pctProspCoordValidMNL;
    }

    /**
     * Set pctProspCoordNonvalidMNL
     *
     * @param string $pctProspCoordNonvalidMNL
     * @return KpiCapture
     */
    public function setPctProspCoordNonvalidMNL($pctProspCoordNonvalidMNL)
    {
        $this->pctProspCoordNonvalidMNL = $pctProspCoordNonvalidMNL;

        return $this;
    }

    /**
     * Get pctProspCoordNonvalidMNL
     *
     * @return string 
     */
    public function getPctProspCoordNonvalidMNL()
    {
        return $this->pctProspCoordNonvalidMNL;
    }

    /**
     * Set pctProspCoordNonrensMNL
     *
     * @param string $pctProspCoordNonrensMNL
     * @return KpiCapture
     */
    public function setPctProspCoordNonrensMNL($pctProspCoordNonrensMNL)
    {
        $this->pctProspCoordNonrensMNL = $pctProspCoordNonrensMNL;

        return $this;
    }

    /**
     * Get pctProspCoordNonrensMNL
     *
     * @return string 
     */
    public function getPctProspCoordNonrensMNL()
    {
        return $this->pctProspCoordNonrensMNL;
    }

    /**
     * Set pctProspEmailValidMNL
     *
     * @param string $pctProspEmailValidMNL
     * @return KpiCapture
     */
    public function setPctProspEmailValidMNL($pctProspEmailValidMNL)
    {
        $this->pctProspEmailValidMNL = $pctProspEmailValidMNL;

        return $this;
    }

    /**
     * Get pctProspEmailValidMNL
     *
     * @return string 
     */
    public function getPctProspEmailValidMNL()
    {
        return $this->pctProspEmailValidMNL;
    }

    /**
     * Set pctProspEmailNonvalidMNL
     *
     * @param string $pctProspEmailNonvalidMNL
     * @return KpiCapture
     */
    public function setPctProspEmailNonvalidMNL($pctProspEmailNonvalidMNL)
    {
        $this->pctProspEmailNonvalidMNL = $pctProspEmailNonvalidMNL;

        return $this;
    }

    /**
     * Get pctProspEmailNonvalidMNL
     *
     * @return string 
     */
    public function getPctProspEmailNonvalidMNL()
    {
        return $this->pctProspEmailNonvalidMNL;
    }

    /**
     * Set pctProspEmailNonrensMNL
     *
     * @param string $pctProspEmailNonrensMNL
     * @return KpiCapture
     */
    public function setPctProspEmailNonrensMNL($pctProspEmailNonrensMNL)
    {
        $this->pctProspEmailNonrensMNL = $pctProspEmailNonrensMNL;

        return $this;
    }

    /**
     * Get pctProspEmailNonrensMNL
     *
     * @return string 
     */
    public function getPctProspEmailNonrensMNL()
    {
        return $this->pctProspEmailNonrensMNL;
    }

    /**
     * Set pctProspTelValidMNL
     *
     * @param string $pctProspTelValidMNL
     * @return KpiCapture
     */
    public function setPctProspTelValidMNL($pctProspTelValidMNL)
    {
        $this->pctProspTelValidMNL = $pctProspTelValidMNL;

        return $this;
    }

    /**
     * Get pctProspTelValidMNL
     *
     * @return string 
     */
    public function getPctProspTelValidMNL()
    {
        return $this->pctProspTelValidMNL;
    }

    /**
     * Set pctProspTelNonvalidMNL
     *
     * @param string $pctProspTelNonvalidMNL
     * @return KpiCapture
     */
    public function setPctProspTelNonvalidMNL($pctProspTelNonvalidMNL)
    {
        $this->pctProspTelNonvalidMNL = $pctProspTelNonvalidMNL;

        return $this;
    }

    /**
     * Get pctProspTelNonvalidMNL
     *
     * @return string 
     */
    public function getPctProspTelNonvalidMNL()
    {
        return $this->pctProspTelNonvalidMNL;
    }

    /**
     * Set pctProspTelNonrensMNL
     *
     * @param string $pctProspTelNonrensMNL
     * @return KpiCapture
     */
    public function setPctProspTelNonrensMNL($pctProspTelNonrensMNL)
    {
        $this->pctProspTelNonrensMNL = $pctProspTelNonrensMNL;

        return $this;
    }

    /**
     * Get pctProspTelNonrensMNL
     *
     * @return string 
     */
    public function getPctProspTelNonrensMNL()
    {
        return $this->pctProspTelNonrensMNL;
    }

    /**
     * Set pctProspAddValidMNL
     *
     * @param string $pctProspAddValidMNL
     * @return KpiCapture
     */
    public function setPctProspAddValidMNL($pctProspAddValidMNL)
    {
        $this->pctProspAddValidMNL = $pctProspAddValidMNL;

        return $this;
    }

    /**
     * Get pctProspAddValidMNL
     *
     * @return string 
     */
    public function getPctProspAddValidMNL()
    {
        return $this->pctProspAddValidMNL;
    }

    /**
     * Set pctProspAddNonvalidMNL
     *
     * @param string $pctProspAddNonvalidMNL
     * @return KpiCapture
     */
    public function setPctProspAddNonvalidMNL($pctProspAddNonvalidMNL)
    {
        $this->pctProspAddNonvalidMNL = $pctProspAddNonvalidMNL;

        return $this;
    }

    /**
     * Get pctProspAddNonvalidMNL
     *
     * @return string 
     */
    public function getPctProspAddNonvalidMNL()
    {
        return $this->pctProspAddNonvalidMNL;
    }

    /**
     * Set pctProspAddNonrensMNL
     *
     * @param string $pctProspAddNonrensMNL
     * @return KpiCapture
     */
    public function setPctProspAddNonrensMNL($pctProspAddNonrensMNL)
    {
        $this->pctProspAddNonrensMNL = $pctProspAddNonrensMNL;

        return $this;
    }

    /**
     * Get pctProspAddNonrensMNL
     *
     * @return string 
     */
    public function getPctProspAddNonrensMNL()
    {
        return $this->pctProspAddNonrensMNL;
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
     * Set nbTransLocalM
     *
     * @param integer $nbTransLocalM
     * @return KpiCapture
     */
    public function setNbTransLocalM($nbTransLocalM)
    {
        $this->nbTransLocalM = $nbTransLocalM;

        return $this;
    }

    /**
     * Get nbTransLocalM
     *
     * @return integer 
     */
    public function getNbTransLocalM()
    {
        return $this->nbTransLocalM;
    }

    /**
     * Set pctTransLocalM
     *
     * @param string $pctTransLocalM
     * @return KpiCapture
     */
    public function setPctTransLocalM($pctTransLocalM)
    {
        $this->pctTransLocalM = $pctTransLocalM;

        return $this;
    }

    /**
     * Get pctTransLocalM
     *
     * @return string 
     */
    public function getPctTransLocalM()
    {
        return $this->pctTransLocalM;
    }

    /**
     * Set nbTransNlocalM
     *
     * @param integer $nbTransNlocalM
     * @return KpiCapture
     */
    public function setNbTransNlocalM($nbTransNlocalM)
    {
        $this->nbTransNlocalM = $nbTransNlocalM;

        return $this;
    }

    /**
     * Get nbTransNlocalM
     *
     * @return integer 
     */
    public function getNbTransNlocalM()
    {
        return $this->nbTransNlocalM;
    }

    /**
     * Set pctTransNlocalM
     *
     * @param string $pctTransNlocalM
     * @return KpiCapture
     */
    public function setPctTransNlocalM($pctTransNlocalM)
    {
        $this->pctTransNlocalM = $pctTransNlocalM;

        return $this;
    }

    /**
     * Get pctTransNlocalM
     *
     * @return string 
     */
    public function getPctTransNlocalM()
    {
        return $this->pctTransNlocalM;
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
     * Get nbTransTot_m
     *
     * @return integer 
     */
    public function getNbTransTotM()
    {
        return $this->nbTransTotM;
    }

    /**
     * Set NbOptinML
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
     * Get NbOptinML
     *
     * @return integer 
     */
    public function getNbOptinML()
    {
        return $this->nbOptinML;
    }

    /**
     * Set NbOptoutML
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
     * Get NbOptoutML
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
     * Set NbCliCoordValidML
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
     * Get NbCliCoordValidML
     *
     * @return integer 
     */
    public function getNbCliCoordValidML()
    {
        return $this->nbCliCoordValidML;
    }

    /**
     * Set NbCliCoordNonvalidML
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
     * Get NbCliCoordNonvalidML
     *
     * @return integer 
     */
    public function getNbCliCoordNonvalidML()
    {
        return $this->nbCliCoordNonvalidML;
    }

    /**
     * Set NbCliCoordNonrensML
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
     * Get NbCliCoordNonrensML
     *
     * @return integer 
     */
    public function getNbCliCoordNonrensML()
    {
        return $this->nbCliCoordNonrensML;
    }

    /**
     * Set NbCliEmailValidML
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
     * Get NbCliEmailValidML
     *
     * @return integer 
     */
    public function getNbCliEmailValidML()
    {
        return $this->nbCliEmailValidML;
    }

    /**
     * Set NbCliEmailNonvalidML
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
     * Get NbCliEmailNonvalidML
     *
     * @return integer 
     */
    public function getNbCliEmailNonvalidML()
    {
        return $this->nbCliEmailNonvalidML;
    }

    /**
     * Set NbCliEmailNonrensML
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
     * Get NbCliEmailNonrensML
     *
     * @return integer 
     */
    public function getNbCliEmailNonrensML()
    {
        return $this->nbCliEmailNonrensML;
    }

    /**
     * Set NbCliTelValidML
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
     * Get NbCliTelValidML
     *
     * @return integer 
     */
    public function getNbCliTelValidML()
    {
        return $this->nbCliTelValidML;
    }

    /**
     * Set NbCliTelNonvalidML
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
     * Get NbCliTelNonvalidML
     *
     * @return integer 
     */
    public function getNbCliTelNonvalidML()
    {
        return $this->nbCliTelNonvalidML;
    }

    /**
     * Set NbCliTelNonrensML
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
     * Get NbCliTelNonrensML
     *
     * @return integer 
     */
    public function getNbCliTelNonrensML()
    {
        return $this->nbCliTelNonrensML;
    }

    /**
     * Set NbCliAddValidML
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
     * Get NbCliAddValidML
     *
     * @return integer 
     */
    public function getNbCliAddValidML()
    {
        return $this->nbCliAddValidML;
    }

    /**
     * Set NbCliAddNonvalidML
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
     * Get NbCliAddNonvalidML
     *
     * @return integer 
     */
    public function getNbCliAddNonvalidML()
    {
        return $this->nbCliAddNonvalidML;
    }

    /**
     * Set NbCliAddNonrensML
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
     * Get NbCliAddNonrensML
     *
     * @return integer 
     */
    public function getNbCliAddNonrensML()
    {
        return $this->nbCliAddNonrensML;
    }

    /**
     * Set NbProspCoordValidML
     *
     * @param integer $nbProspCoordValidML
     * @return KpiCapture
     */
    public function setNbProspCoordValidML($nbProspCoordValidML)
    {
        $this->nbProspCoordValidML = $nbProspCoordValidML;

        return $this;
    }

    /**
     * Get NbProspCoordValidML
     *
     * @return integer 
     */
    public function getNbProspCoordValidML()
    {
        return $this->nbProspCoordValidML;
    }

    /**
     * Set NbProspCoordNonvalidML
     *
     * @param integer $nbProspCoordNonvalidML
     * @return KpiCapture
     */
    public function setNbProspCoordNonvalidML($nbProspCoordNonvalidML)
    {
        $this->nbProspCoordNonvalidML = $nbProspCoordNonvalidML;

        return $this;
    }

    /**
     * Get NbProspCoordNonvalidML
     *
     * @return integer 
     */
    public function getNbProspCoordNonvalidML()
    {
        return $this->nbProspCoordNonvalidML;
    }

    /**
     * Set NbProspCoordNonrensML
     *
     * @param integer $nbProspCoordNonrensML
     * @return KpiCapture
     */
    public function setNbProspCoordNonrensML($nbProspCoordNonrensML)
    {
        $this->nbProspCoordNonrensML = $nbProspCoordNonrensML;

        return $this;
    }

    /**
     * Get NbProspCoordNonrensML
     *
     * @return integer 
     */
    public function getNbProspCoordNonrensML()
    {
        return $this->nbProspCoordNonrensML;
    }

    /**
     * Set NbProspEmailValidML
     *
     * @param integer $nbProspEmailValidML
     * @return KpiCapture
     */
    public function setNbProspEmailValidML($nbProspEmailValidML)
    {
        $this->nbProspEmailValidML = $nbProspEmailValidML;

        return $this;
    }

    /**
     * Get NbProspEmailValidML
     *
     * @return integer 
     */
    public function getNbProspEmailValidML()
    {
        return $this->nbProspEmailValidML;
    }

    /**
     * Set NbProspEmailNonvalidML
     *
     * @param integer $nbProspEmailNonvalidML
     * @return KpiCapture
     */
    public function setNbProspEmailNonvalidML($nbProspEmailNonvalidML)
    {
        $this->nbProspEmailNonvalidML = $nbProspEmailNonvalidML;

        return $this;
    }

    /**
     * Get NbProspEmailNonvalidML
     *
     * @return integer 
     */
    public function getNbProspEmailNonvalidML()
    {
        return $this->nbProspEmailNonvalidML;
    }

    /**
     * Set NbProspEmailNonrensML
     *
     * @param integer $nbProspEmailNonrensML
     * @return KpiCapture
     */
    public function setNbProspEmailNonrensML($nbProspEmailNonrensML)
    {
        $this->nbProspEmailNonrensML = $nbProspEmailNonrensML;

        return $this;
    }

    /**
     * Get NbProspEmailNonrensML
     *
     * @return integer 
     */
    public function getNbProspEmailNonrensML()
    {
        return $this->nbProspEmailNonrensML;
    }

    /**
     * Set NbProspTelValidML
     *
     * @param integer $nbProspTelValidML
     * @return KpiCapture
     */
    public function setNbProspTelValidML($nbProspTelValidML)
    {
        $this->nbProspTelValidML = $nbProspTelValidML;

        return $this;
    }

    /**
     * Get NbProspTelValidML
     *
     * @return integer 
     */
    public function getNbProspTelValidML()
    {
        return $this->nbProspTelValidML;
    }

    /**
     * Set NbProspTelNonvalidML
     *
     * @param integer $nbProspTelNonvalidML
     * @return KpiCapture
     */
    public function setNbProspTelNonvalidML($nbProspTelNonvalidML)
    {
        $this->nbProspTelNonvalidML = $nbProspTelNonvalidML;

        return $this;
    }

    /**
     * Get NbProspTelNonvalidML
     *
     * @return integer 
     */
    public function getNbProspTelNonvalidML()
    {
        return $this->nbProspTelNonvalidML;
    }

    /**
     * Set NbProspTelNonrensML
     *
     * @param integer $nbProspTelNonrensML
     * @return KpiCapture
     */
    public function setNbProspTelNonrensML($nbProspTelNonrensML)
    {
        $this->nbProspTelNonrensML = $nbProspTelNonrensML;

        return $this;
    }

    /**
     * Get NbProspTelNonrensML
     *
     * @return integer 
     */
    public function getNbProspTelNonrensML()
    {
        return $this->nbProspTelNonrensML;
    }

    /**
     * Set NbProspAddValidML
     *
     * @param integer $nbProspAddValidML
     * @return KpiCapture
     */
    public function setNbProspAddValidML($nbProspAddValidML)
    {
        $this->nbProspAddValidML = $nbProspAddValidML;

        return $this;
    }

    /**
     * Get NbProspAddValidML
     *
     * @return integer 
     */
    public function getNbProspAddValidML()
    {
        return $this->nbProspAddValidML;
    }

    /**
     * Set NbProspAddNonvalidML
     *
     * @param integer $nbProspAddNonvalidML
     * @return KpiCapture
     */
    public function setNbProspAddNonvalidML($nbProspAddNonvalidML)
    {
        $this->nbProspAddNonvalidML = $nbProspAddNonvalidML;

        return $this;
    }

    /**
     * Get NbProspAddNonvalidML
     *
     * @return integer 
     */
    public function getNbProspAddNonvalidML()
    {
        return $this->nbProspAddNonvalidML;
    }

    /**
     * Set NbProspAddNonrensML
     *
     * @param integer $nbProspAddNonrensML
     * @return KpiCapture
     */
    public function setNbProspAddNonrensML($nbProspAddNonrensML)
    {
        $this->nbProspAddNonrensML = $nbProspAddNonrensML;

        return $this;
    }

    /**
     * Get NbProspAddNonrensML
     *
     * @return integer 
     */
    public function getNbProspAddNonrensML()
    {
        return $this->nbProspAddNonrensML;
    }

    /**
     * Set NbOptinMNL
     *
     * @param integer $nbOptinMNL
     * @return KpiCapture
     */
    public function setNbOptinMNL($nbOptinMNL)
    {
        $this->nbOptinMNL = $nbOptinMNL;

        return $this;
    }

    /**
     * Get NbOptinMNL
     *
     * @return integer 
     */
    public function getNbOptinMNL()
    {
        return $this->nbOptinMNL;
    }

    /**
     * Set NbOptoutMNL
     *
     * @param integer $nbOptoutMNL
     * @return KpiCapture
     */
    public function setNbOptoutMNL($nbOptoutMNL)
    {
        $this->nbOptoutMNL = $nbOptoutMNL;

        return $this;
    }

    /**
     * Get NbOptoutMNL
     *
     * @return integer 
     */
    public function getNbOptoutMNL()
    {
        return $this->nbOptoutMNL;
    }

    /**
     * Set pctOptinMNL
     *
     * @param string $pctOptinMNL
     * @return KpiCapture
     */
    public function setPctOptinMNL($pctOptinMNL)
    {
        $this->pctOptinMNL = $pctOptinMNL;

        return $this;
    }

    /**
     * Get pctOptinMNL
     *
     * @return string 
     */
    public function getPctOptinMNL()
    {
        return $this->pctOptinMNL;
    }

    /**
     * Set pctOptoutMNL
     *
     * @param string $pctOptoutMNL
     * @return KpiCapture
     */
    public function setPctOptoutMNL($pctOptoutMNL)
    {
        $this->pctOptoutMNL = $pctOptoutMNL;

        return $this;
    }

    /**
     * Get pctOptoutMNL
     *
     * @return string 
     */
    public function getPctOptoutMNL()
    {
        return $this->pctOptoutMNL;
    }

    /**
     * Set NbCliCoordValidMNL
     *
     * @param integer $nbCliCoordValidMNL
     * @return KpiCapture
     */
    public function setNbCliCoordValidMNL($nbCliCoordValidMNL)
    {
        $this->nbCliCoordValidMNL = $nbCliCoordValidMNL;

        return $this;
    }

    /**
     * Get NbCliCoordValidMNL
     *
     * @return integer 
     */
    public function getNbCliCoordValidMNL()
    {
        return $this->nbCliCoordValidMNL;
    }

    /**
     * Set NbCliCoordNonvalidMNL
     *
     * @param integer $nbCliCoordNonvalidMNL
     * @return KpiCapture
     */
    public function setNbCliCoordNonvalidMNL($nbCliCoordNonvalidMNL)
    {
        $this->nbCliCoordNonvalidMNL = $nbCliCoordNonvalidMNL;

        return $this;
    }

    /**
     * Get NbCliCoordNonvalidMNL
     *
     * @return integer 
     */
    public function getNbCliCoordNonvalidMNL()
    {
        return $this->nbCliCoordNonvalidMNL;
    }

    /**
     * Set NbCliCoordNonrensMNL
     *
     * @param integer $nbCliCoordNonrensMNL
     * @return KpiCapture
     */
    public function setNbCliCoordNonrensMNL($nbCliCoordNonrensMNL)
    {
        $this->nbCliCoordNonrensMNL = $nbCliCoordNonrensMNL;

        return $this;
    }

    /**
     * Get NbCliCoordNonrensMNL
     *
     * @return integer 
     */
    public function getNbCliCoordNonrensMNL()
    {
        return $this->nbCliCoordNonrensMNL;
    }

    /**
     * Set NbCliEmailValidMNL
     *
     * @param integer $nbCliEmailValidMNL
     * @return KpiCapture
     */
    public function setNbCliEmailValidMNL($nbCliEmailValidMNL)
    {
        $this->nbCliEmailValidMNL = $nbCliEmailValidMNL;

        return $this;
    }

    /**
     * Get NbCliEmailValidMNL
     *
     * @return integer 
     */
    public function getNbCliEmailValidMNL()
    {
        return $this->nbCliEmailValidMNL;
    }

    /**
     * Set NbCliEmailNonvalidMNL
     *
     * @param integer $nbCliEmailNonvalidMNL
     * @return KpiCapture
     */
    public function setNbCliEmailNonvalidMNL($nbCliEmailNonvalidMNL)
    {
        $this->nbCliEmailNonvalidMNL = $nbCliEmailNonvalidMNL;

        return $this;
    }

    /**
     * Get NbCliEmailNonvalidMNL
     *
     * @return integer 
     */
    public function getNbCliEmailNonvalidMNL()
    {
        return $this->nbCliEmailNonvalidMNL;
    }

    /**
     * Set NbCliEmailNonrensMNL
     *
     * @param integer $nbCliEmailNonrensMNL
     * @return KpiCapture
     */
    public function setNbCliEmailNonrensMNL($nbCliEmailNonrensMNL)
    {
        $this->nbCliEmailNonrensMNL = $nbCliEmailNonrensMNL;

        return $this;
    }

    /**
     * Get NbCliEmailNonrensMNL
     *
     * @return integer 
     */
    public function getNbCliEmailNonrensMNL()
    {
        return $this->nbCliEmailNonrensMNL;
    }

    /**
     * Set NbCliTelValidMNL
     *
     * @param integer $nbCliTelValidMNL
     * @return KpiCapture
     */
    public function setNbCliTelValidMNL($nbCliTelValidMNL)
    {
        $this->nbCliTelValidMNL = $nbCliTelValidMNL;

        return $this;
    }

    /**
     * Get NbCliTelValidMNL
     *
     * @return integer 
     */
    public function getNbCliTelValidMNL()
    {
        return $this->nbCliTelValidMNL;
    }

    /**
     * Set NbCliTelNonvalidMNL
     *
     * @param integer $nbCliTelNonvalidMNL
     * @return KpiCapture
     */
    public function setNbCliTelNonvalidMNL($nbCliTelNonvalidMNL)
    {
        $this->nbCliTelNonvalidMNL = $nbCliTelNonvalidMNL;

        return $this;
    }

    /**
     * Get NbCliTelNonvalidMNL
     *
     * @return integer 
     */
    public function getNbCliTelNonvalidMNL()
    {
        return $this->nbCliTelNonvalidMNL;
    }

    /**
     * Set NbCliTelNonrensMNL
     *
     * @param integer $nbCliTelNonrensMNL
     * @return KpiCapture
     */
    public function setNbCliTelNonrensMNL($nbCliTelNonrensMNL)
    {
        $this->nbCliTelNonrensMNL = $nbCliTelNonrensMNL;

        return $this;
    }

    /**
     * Get NbCliTelNonrensMNL
     *
     * @return integer 
     */
    public function getNbCliTelNonrensMNL()
    {
        return $this->nbCliTelNonrensMNL;
    }

    /**
     * Set NbCliAddValidMNL
     *
     * @param integer $nbCliAddValidMNL
     * @return KpiCapture
     */
    public function setNbCliAddValidMNL($nbCliAddValidMNL)
    {
        $this->nbCliAddValidMNL = $nbCliAddValidMNL;

        return $this;
    }

    /**
     * Get NbCliAddValidMNL
     *
     * @return integer 
     */
    public function getNbCliAddValidMNL()
    {
        return $this->nbCliAddValidMNL;
    }

    /**
     * Set NbCliAddNonvalidMNL
     *
     * @param integer $nbCliAddNonvalidMNL
     * @return KpiCapture
     */
    public function setNbCliAddNonvalidMNL($nbCliAddNonvalidMNL)
    {
        $this->nbCliAddNonvalidMNL = $nbCliAddNonvalidMNL;

        return $this;
    }

    /**
     * Get NbCliAddNonvalidMNL
     *
     * @return integer 
     */
    public function getNbCliAddNonvalidMNL()
    {
        return $this->nbCliAddNonvalidMNL;
    }

    /**
     * Set NbCliAddNonrensMNL
     *
     * @param integer $nbCliAddNonrensMNL
     * @return KpiCapture
     */
    public function setNbCliAddNonrensMNL($nbCliAddNonrensMNL)
    {
        $this->nbCliAddNonrensMNL = $nbCliAddNonrensMNL;

        return $this;
    }

    /**
     * Get NbCliAddNonrensMNL
     *
     * @return integer 
     */
    public function getNbCliAddNonrensMNL()
    {
        return $this->nbCliAddNonrensMNL;
    }

    /**
     * Set NbProspCoordValidMNL
     *
     * @param integer $nbProspCoordValidMNL
     * @return KpiCapture
     */
    public function setNbProspCoordValidMNL($nbProspCoordValidMNL)
    {
        $this->nbProspCoordValidMNL = $nbProspCoordValidMNL;

        return $this;
    }

    /**
     * Get NbProspCoordValidMNL
     *
     * @return integer 
     */
    public function getNbProspCoordValidMNL()
    {
        return $this->nbProspCoordValidMNL;
    }

    /**
     * Set NbProspCoordNonvalidMNL
     *
     * @param integer $nbProspCoordNonvalidMNL
     * @return KpiCapture
     */
    public function setNbProspCoordNonvalidMNL($nbProspCoordNonvalidMNL)
    {
        $this->nbProspCoordNonvalidMNL = $nbProspCoordNonvalidMNL;

        return $this;
    }

    /**
     * Get NbProspCoordNonvalidMNL
     *
     * @return integer 
     */
    public function getNbProspCoordNonvalidMNL()
    {
        return $this->nbProspCoordNonvalidMNL;
    }

    /**
     * Set NbProspCoordNonrensMNL
     *
     * @param integer $nbProspCoordNonrensMNL
     * @return KpiCapture
     */
    public function setNbProspCoordNonrensMNL($nbProspCoordNonrensMNL)
    {
        $this->nbProspCoordNonrensMNL = $nbProspCoordNonrensMNL;

        return $this;
    }

    /**
     * Get NbProspCoordNonrensMNL
     *
     * @return integer 
     */
    public function getNbProspCoordNonrensMNL()
    {
        return $this->nbProspCoordNonrensMNL;
    }

    /**
     * Set NbProspEmailValidMNL
     *
     * @param integer $nbProspEmailValidMNL
     * @return KpiCapture
     */
    public function setNbProspEmailValidMNL($nbProspEmailValidMNL)
    {
        $this->nbProspEmailValidMNL = $nbProspEmailValidMNL;

        return $this;
    }

    /**
     * Get NbProspEmailValidMNL
     *
     * @return integer 
     */
    public function getNbProspEmailValidMNL()
    {
        return $this->nbProspEmailValidMNL;
    }

    /**
     * Set NbProspEmailNonvalidMNL
     *
     * @param integer $nbProspEmailNonvalidMNL
     * @return KpiCapture
     */
    public function setNbProspEmailNonvalidMNL($nbProspEmailNonvalidMNL)
    {
        $this->nbProspEmailNonvalidMNL = $nbProspEmailNonvalidMNL;

        return $this;
    }

    /**
     * Get NbProspEmailNonvalidMNL
     *
     * @return integer 
     */
    public function getNbProspEmailNonvalidMNL()
    {
        return $this->nbProspEmailNonvalidMNL;
    }

    /**
     * Set NbProspEmailNonrensMNL
     *
     * @param integer $nbProspEmailNonrensMNL
     * @return KpiCapture
     */
    public function setNbProspEmailNonrensMNL($nbProspEmailNonrensMNL)
    {
        $this->nbProspEmailNonrensMNL = $nbProspEmailNonrensMNL;

        return $this;
    }

    /**
     * Get NbProspEmailNonrensMNL
     *
     * @return integer 
     */
    public function getNbProspEmailNonrensMNL()
    {
        return $this->nbProspEmailNonrensMNL;
    }

    /**
     * Set NbProspTelValidMNL
     *
     * @param integer $nbProspTelValidMNL
     * @return KpiCapture
     */
    public function setNbProspTelValidMNL($nbProspTelValidMNL)
    {
        $this->nbProspTelValidMNL = $nbProspTelValidMNL;

        return $this;
    }

    /**
     * Get NbProspTelValidMNL
     *
     * @return integer 
     */
    public function getNbProspTelValidMNL()
    {
        return $this->nbProspTelValidMNL;
    }

    /**
     * Set NbProspTelNonvalidMNL
     *
     * @param integer $nbProspTelNonvalidMNL
     * @return KpiCapture
     */
    public function setNbProspTelNonvalidMNL($nbProspTelNonvalidMNL)
    {
        $this->nbProspTelNonvalidMNL = $nbProspTelNonvalidMNL;

        return $this;
    }

    /**
     * Get NbProspTelNonvalidMNL
     *
     * @return integer 
     */
    public function getNbProspTelNonvalidMNL()
    {
        return $this->nbProspTelNonvalidMNL;
    }

    /**
     * Set NbProspTelNonrensMNL
     *
     * @param integer $nbProspTelNonrensMNL
     * @return KpiCapture
     */
    public function setNbProspTelNonrensMNL($nbProspTelNonrensMNL)
    {
        $this->nbProspTelNonrensMNL = $nbProspTelNonrensMNL;

        return $this;
    }

    /**
     * Get NbProspTelNonrensMNL
     *
     * @return integer 
     */
    public function getNbProspTelNonrensMNL()
    {
        return $this->nbProspTelNonrensMNL;
    }

    /**
     * Set NbProspAddValidMNL
     *
     * @param integer $nbProspAddValidMNL
     * @return KpiCapture
     */
    public function setNbProspAddValidMNL($nbProspAddValidMNL)
    {
        $this->nbProspAddValidMNL = $nbProspAddValidMNL;

        return $this;
    }

    /**
     * Get NbProspAddValidMNL
     *
     * @return integer 
     */
    public function getNbProspAddValidMNL()
    {
        return $this->nbProspAddValidMNL;
    }

    /**
     * Set NbProspAddNonvalidMNL
     *
     * @param integer $nbProspAddNonvalidMNL
     * @return KpiCapture
     */
    public function setNbProspAddNonvalidMNL($nbProspAddNonvalidMNL)
    {
        $this->nbProspAddNonvalidMNL = $nbProspAddNonvalidMNL;

        return $this;
    }

    /**
     * Get NbProspAddNonvalidMNL
     *
     * @return integer 
     */
    public function getNbProspAddNonvalidMNL()
    {
        return $this->nbProspAddNonvalidMNL;
    }

    /**
     * Set NbProspAddNonrensMNL
     *
     * @param integer $nbProspAddNonrensMNL
     * @return KpiCapture
     */
    public function setNbProspAddNonrensMNL($nbProspAddNonrensMNL)
    {
        $this->nbProspAddNonrensMNL = $nbProspAddNonrensMNL;

        return $this;
    }

    /**
     * Get NbProspAddNonrensMNL
     *
     * @return integer 
     */
    public function getNbProspAddNonrensMNL()
    {
        return $this->nbProspAddNonrensMNL;
    }

    /**
     * Set NbOptinYL
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
     * Get NbOptinYL
     *
     * @return integer 
     */
    public function getNbOptinYL()
    {
        return $this->nbOptinYL;
    }

    /**
     * Set NbOptoutYL
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
     * Get NbOptoutYL
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
     * Set NbCliCoordValidYL
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
     * Get NbCliCoordValidYL
     *
     * @return integer 
     */
    public function getNbCliCoordValidYL()
    {
        return $this->nbCliCoordValidYL;
    }

    /**
     * Set NbCliCoordNonvalidYL
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
     * Get NbCliCoordNonvalidYL
     *
     * @return integer 
     */
    public function getNbCliCoordNonvalidYL()
    {
        return $this->nbCliCoordNonvalidYL;
    }

    /**
     * Set NbCliCoordNonrensYL
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
     * Get NbCliCoordNonrensYL
     *
     * @return integer 
     */
    public function getNbCliCoordNonrensYL()
    {
        return $this->nbCliCoordNonrensYL;
    }

    /**
     * Set NbCliEmailValidYL
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
     * Get NbCliEmailValidYL
     *
     * @return integer 
     */
    public function getNbCliEmailValidYL()
    {
        return $this->nbCliEmailValidYL;
    }

    /**
     * Set NbCliEmailNonvalidYL
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
     * Get NbCliEmailNonvalidYL
     *
     * @return integer 
     */
    public function getNbCliEmailNonvalidYL()
    {
        return $this->nbCliEmailNonvalidYL;
    }

    /**
     * Set NbCliEmailNonrensYL
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
     * Get NbCliEmailNonrensYL
     *
     * @return integer 
     */
    public function getNbCliEmailNonrensYL()
    {
        return $this->nbCliEmailNonrensYL;
    }

    /**
     * Set NbCliTelValidYL
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
     * Get NbCliTelValidYL
     *
     * @return integer 
     */
    public function getNbCliTelValidYL()
    {
        return $this->nbCliTelValidYL;
    }

    /**
     * Set NbCliTelNonvalidYL
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
     * Get NbCliTelNonvalidYL
     *
     * @return integer 
     */
    public function getNbCliTelNonvalidYL()
    {
        return $this->nbCliTelNonvalidYL;
    }

    /**
     * Set NbCliTelNonrensYL
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
     * Get NbCliTelNonrensYL
     *
     * @return integer 
     */
    public function getNbCliTelNonrensYL()
    {
        return $this->nbCliTelNonrensYL;
    }

    /**
     * Set NbCliAddValidYL
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
     * Get NbCliAddValidYL
     *
     * @return integer 
     */
    public function getNbCliAddValidYL()
    {
        return $this->nbCliAddValidYL;
    }

    /**
     * Set NbCliAddNonvalidYL
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
     * Get NbCliAddNonvalidYL
     *
     * @return integer 
     */
    public function getNbCliAddNonvalidYL()
    {
        return $this->nbCliAddNonvalidYL;
    }

    /**
     * Set NbCliAddNonrensYL
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
     * Get NbCliAddNonrensYL
     *
     * @return integer 
     */
    public function getNbCliAddNonrensYL()
    {
        return $this->nbCliAddNonrensYL;
    }

    /**
     * Set NbProspCoordValidYL
     *
     * @param integer $nbProspCoordValidYL
     * @return KpiCapture
     */
    public function setNbProspCoordValidYL($nbProspCoordValidYL)
    {
        $this->nbProspCoordValidYL = $nbProspCoordValidYL;

        return $this;
    }

    /**
     * Get NbProspCoordValidYL
     *
     * @return integer 
     */
    public function getNbProspCoordValidYL()
    {
        return $this->nbProspCoordValidYL;
    }

    /**
     * Set NbProspCoordNonvalidYL
     *
     * @param integer $nbProspCoordNonvalidYL
     * @return KpiCapture
     */
    public function setNbProspCoordNonvalidYL($nbProspCoordNonvalidYL)
    {
        $this->nbProspCoordNonvalidYL = $nbProspCoordNonvalidYL;

        return $this;
    }

    /**
     * Get NbProspCoordNonvalidYL
     *
     * @return integer 
     */
    public function getNbProspCoordNonvalidYL()
    {
        return $this->nbProspCoordNonvalidYL;
    }

    /**
     * Set NbProspCoordNonrensYL
     *
     * @param integer $nbProspCoordNonrensYL
     * @return KpiCapture
     */
    public function setNbProspCoordNonrensYL($nbProspCoordNonrensYL)
    {
        $this->nbProspCoordNonrensYL = $nbProspCoordNonrensYL;

        return $this;
    }

    /**
     * Get NbProspCoordNonrensYL
     *
     * @return integer 
     */
    public function getNbProspCoordNonrensYL()
    {
        return $this->nbProspCoordNonrensYL;
    }

    /**
     * Set NbProspEmailValidYL
     *
     * @param integer $nbProspEmailValidYL
     * @return KpiCapture
     */
    public function setNbProspEmailValidYL($nbProspEmailValidYL)
    {
        $this->nbProspEmailValidYL = $nbProspEmailValidYL;

        return $this;
    }

    /**
     * Get NbProspEmailValidYL
     *
     * @return integer 
     */
    public function getNbProspEmailValidYL()
    {
        return $this->nbProspEmailValidYL;
    }

    /**
     * Set NbProspEmailNonvalidYL
     *
     * @param integer $nbProspEmailNonvalidYL
     * @return KpiCapture
     */
    public function setNbProspEmailNonvalidYL($nbProspEmailNonvalidYL)
    {
        $this->nbProspEmailNonvalidYL = $nbProspEmailNonvalidYL;

        return $this;
    }

    /**
     * Get NbProspEmailNonvalidYL
     *
     * @return integer 
     */
    public function getNbProspEmailNonvalidYL()
    {
        return $this->nbProspEmailNonvalidYL;
    }

    /**
     * Set NbProspEmailNonrensYL
     *
     * @param integer $nbProspEmailNonrensYL
     * @return KpiCapture
     */
    public function setNbProspEmailNonrensYL($nbProspEmailNonrensYL)
    {
        $this->nbProspEmailNonrensYL = $nbProspEmailNonrensYL;

        return $this;
    }

    /**
     * Get NbProspEmailNonrensYL
     *
     * @return integer 
     */
    public function getNbProspEmailNonrensYL()
    {
        return $this->nbProspEmailNonrensYL;
    }

    /**
     * Set NbProspTelValidYL
     *
     * @param integer $nbProspTelValidYL
     * @return KpiCapture
     */
    public function setNbProspTelValidYL($nbProspTelValidYL)
    {
        $this->nbProspTelValidYL = $nbProspTelValidYL;

        return $this;
    }

    /**
     * Get NbProspTelValidYL
     *
     * @return integer 
     */
    public function getNbProspTelValidYL()
    {
        return $this->nbProspTelValidYL;
    }

    /**
     * Set NbProspTelNonvalidYL
     *
     * @param integer $nbProspTelNonvalidYL
     * @return KpiCapture
     */
    public function setNbProspTelNonvalidYL($nbProspTelNonvalidYL)
    {
        $this->nbProspTelNonvalidYL = $nbProspTelNonvalidYL;

        return $this;
    }

    /**
     * Get NbProspTelNonvalidYL
     *
     * @return integer 
     */
    public function getNbProspTelNonvalidYL()
    {
        return $this->nbProspTelNonvalidYL;
    }

    /**
     * Set NbProspTelNonrensYL
     *
     * @param integer $nbProspTelNonrensYL
     * @return KpiCapture
     */
    public function setNbProspTelNonrensYL($nbProspTelNonrensYL)
    {
        $this->nbProspTelNonrensYL = $nbProspTelNonrensYL;

        return $this;
    }

    /**
     * Get NbProspTelNonrensYL
     *
     * @return integer 
     */
    public function getNbProspTelNonrensYL()
    {
        return $this->nbProspTelNonrensYL;
    }

    /**
     * Set NbProspAddValidYL
     *
     * @param integer $nbProspAddValidYL
     * @return KpiCapture
     */
    public function setNbProspAddValidYL($nbProspAddValidYL)
    {
        $this->nbProspAddValidYL = $nbProspAddValidYL;

        return $this;
    }

    /**
     * Get NbProspAddValidYL
     *
     * @return integer 
     */
    public function getNbProspAddValidYL()
    {
        return $this->nbProspAddValidYL;
    }

    /**
     * Set NbProspAddNonvalidYL
     *
     * @param integer $nbProspAddNonvalidYL
     * @return KpiCapture
     */
    public function setNbProspAddNonvalidYL($nbProspAddNonvalidYL)
    {
        $this->nbProspAddNonvalidYL = $nbProspAddNonvalidYL;

        return $this;
    }

    /**
     * Get NbProspAddNonvalidYL
     *
     * @return integer 
     */
    public function getNbProspAddNonvalidYL()
    {
        return $this->nbProspAddNonvalidYL;
    }

    /**
     * Set NbProspAddNonrensYL
     *
     * @param integer $nbProspAddNonrensYL
     * @return KpiCapture
     */
    public function setNbProspAddNonrensYL($nbProspAddNonrensYL)
    {
        $this->nbProspAddNonrensYL = $nbProspAddNonrensYL;

        return $this;
    }

    /**
     * Get NbProspAddNonrensYL
     *
     * @return integer 
     */
    public function getNbProspAddNonrensYL()
    {
        return $this->nbProspAddNonrensYL;
    }

    /**
     * Set NbOptinYNL
     *
     * @param integer $nbOptinYNL
     * @return KpiCapture
     */
    public function setNbOptinYNL($nbOptinYNL)
    {
        $this->nbOptinYNL = $nbOptinYNL;

        return $this;
    }

    /**
     * Get NbOptinYNL
     *
     * @return integer 
     */
    public function getNbOptinYNL()
    {
        return $this->nbOptinYNL;
    }

    /**
     * Set NbOptoutYNL
     *
     * @param integer $nbOptoutYNL
     * @return KpiCapture
     */
    public function setNbOptoutYNL($nbOptoutYNL)
    {
        $this->nbOptoutYNL = $nbOptoutYNL;

        return $this;
    }

    /**
     * Get NbOptoutYNL
     *
     * @return integer 
     */
    public function getNbOptoutYNL()
    {
        return $this->nbOptoutYNL;
    }

    /**
     * Set pctOptinYNL
     *
     * @param string $pctOptinYNL
     * @return KpiCapture
     */
    public function setPctOptinYNL($pctOptinYNL)
    {
        $this->pctOptinYNL = $pctOptinYNL;

        return $this;
    }

    /**
     * Get pctOptinYNL
     *
     * @return string 
     */
    public function getPctOptinYNL()
    {
        return $this->pctOptinYNL;
    }

    /**
     * Set pctOptoutYNL
     *
     * @param string $pctOptoutYNL
     * @return KpiCapture
     */
    public function setPctOptoutYNL($pctOptoutYNL)
    {
        $this->pctOptoutYNL = $pctOptoutYNL;

        return $this;
    }

    /**
     * Get pctOptoutYNL
     *
     * @return string 
     */
    public function getPctOptoutYNL()
    {
        return $this->pctOptoutYNL;
    }

    /**
     * Set NbCliCoordValidYNL
     *
     * @param integer $nbCliCoordValidYNL
     * @return KpiCapture
     */
    public function setNbCliCoordValidYNL($nbCliCoordValidYNL)
    {
        $this->nbCliCoordValidYNL = $nbCliCoordValidYNL;

        return $this;
    }

    /**
     * Get NbCliCoordValidYNL
     *
     * @return integer 
     */
    public function getNbCliCoordValidYNL()
    {
        return $this->nbCliCoordValidYNL;
    }

    /**
     * Set NbCliCoordNonvalidYNL
     *
     * @param integer $nbCliCoordNonvalidYNL
     * @return KpiCapture
     */
    public function setNbCliCoordNonvalidYNL($nbCliCoordNonvalidYNL)
    {
        $this->nbCliCoordNonvalidYNL = $nbCliCoordNonvalidYNL;

        return $this;
    }

    /**
     * Get NbCliCoordNonvalidYNL
     *
     * @return integer 
     */
    public function getNbCliCoordNonvalidYNL()
    {
        return $this->nbCliCoordNonvalidYNL;
    }

    /**
     * Set NbCliCoordNonrensYNL
     *
     * @param integer $nbCliCoordNonrensYNL
     * @return KpiCapture
     */
    public function setNbCliCoordNonrensYNL($nbCliCoordNonrensYNL)
    {
        $this->nbCliCoordNonrensYNL = $nbCliCoordNonrensYNL;

        return $this;
    }

    /**
     * Get NbCliCoordNonrensYNL
     *
     * @return integer 
     */
    public function getNbCliCoordNonrensYNL()
    {
        return $this->nbCliCoordNonrensYNL;
    }

    /**
     * Set NbCliEmailValidYNL
     *
     * @param integer $nbCliEmailValidYNL
     * @return KpiCapture
     */
    public function setNbCliEmailValidYNL($nbCliEmailValidYNL)
    {
        $this->nbCliEmailValidYNL = $nbCliEmailValidYNL;

        return $this;
    }

    /**
     * Get NbCliEmailValidYNL
     *
     * @return integer 
     */
    public function getNbCliEmailValidYNL()
    {
        return $this->nbCliEmailValidYNL;
    }

    /**
     * Set NbCliEmailNonvalidYNL
     *
     * @param integer $nbCliEmailNonvalidYNL
     * @return KpiCapture
     */
    public function setNbCliEmailNonvalidYNL($nbCliEmailNonvalidYNL)
    {
        $this->nbCliEmailNonvalidYNL = $nbCliEmailNonvalidYNL;

        return $this;
    }

    /**
     * Get NbCliEmailNonvalidYNL
     *
     * @return integer 
     */
    public function getNbCliEmailNonvalidYNL()
    {
        return $this->nbCliEmailNonvalidYNL;
    }

    /**
     * Set NbCliEmailNonrensYNL
     *
     * @param integer $nbCliEmailNonrensYNL
     * @return KpiCapture
     */
    public function setNbCliEmailNonrensYNL($nbCliEmailNonrensYNL)
    {
        $this->nbCliEmailNonrensYNL = $nbCliEmailNonrensYNL;

        return $this;
    }

    /**
     * Get NbCliEmailNonrensYNL
     *
     * @return integer 
     */
    public function getNbCliEmailNonrensYNL()
    {
        return $this->nbCliEmailNonrensYNL;
    }

    /**
     * Set NbCliTelValidYNL
     *
     * @param integer $nbCliTelValidYNL
     * @return KpiCapture
     */
    public function setNbCliTelValidYNL($nbCliTelValidYNL)
    {
        $this->nbCliTelValidYNL = $nbCliTelValidYNL;

        return $this;
    }

    /**
     * Get NbCliTelValidYNL
     *
     * @return integer 
     */
    public function getNbCliTelValidYNL()
    {
        return $this->nbCliTelValidYNL;
    }

    /**
     * Set NbCliTelNonvalidYNL
     *
     * @param integer $nbCliTelNonvalidYNL
     * @return KpiCapture
     */
    public function setNbCliTelNonvalidYNL($nbCliTelNonvalidYNL)
    {
        $this->nbCliTelNonvalidYNL = $nbCliTelNonvalidYNL;

        return $this;
    }

    /**
     * Get NbCliTelNonvalidYNL
     *
     * @return integer 
     */
    public function getNbCliTelNonvalidYNL()
    {
        return $this->nbCliTelNonvalidYNL;
    }

    /**
     * Set NbCliTelNonrensYNL
     *
     * @param integer $nbCliTelNonrensYNL
     * @return KpiCapture
     */
    public function setNbCliTelNonrensYNL($nbCliTelNonrensYNL)
    {
        $this->nbCliTelNonrensYNL = $nbCliTelNonrensYNL;

        return $this;
    }

    /**
     * Get NbCliTelNonrensYNL
     *
     * @return integer 
     */
    public function getNbCliTelNonrensYNL()
    {
        return $this->nbCliTelNonrensYNL;
    }

    /**
     * Set NbCliAddValidYNL
     *
     * @param integer $nbCliAddValidYNL
     * @return KpiCapture
     */
    public function setNbCliAddValidYNL($nbCliAddValidYNL)
    {
        $this->nbCliAddValidYNL = $nbCliAddValidYNL;

        return $this;
    }

    /**
     * Get NbCliAddValidYNL
     *
     * @return integer 
     */
    public function getNbCliAddValidYNL()
    {
        return $this->nbCliAddValidYNL;
    }

    /**
     * Set NbCliAddNonvalidYNL
     *
     * @param integer $nbCliAddNonvalidYNL
     * @return KpiCapture
     */
    public function setNbCliAddNonvalidYNL($nbCliAddNonvalidYNL)
    {
        $this->nbCliAddNonvalidYNL = $nbCliAddNonvalidYNL;

        return $this;
    }

    /**
     * Get NbCliAddNonvalidYNL
     *
     * @return integer 
     */
    public function getNbCliAddNonvalidYNL()
    {
        return $this->nbCliAddNonvalidYNL;
    }

    /**
     * Set NbCliAddNonrensYNL
     *
     * @param integer $nbCliAddNonrensYNL
     * @return KpiCapture
     */
    public function setNbCliAddNonrensYNL($nbCliAddNonrensYNL)
    {
        $this->nbCliAddNonrensYNL = $nbCliAddNonrensYNL;

        return $this;
    }

    /**
     * Get NbCliAddNonrensYNL
     *
     * @return integer 
     */
    public function getNbCliAddNonrensYNL()
    {
        return $this->nbCliAddNonrensYNL;
    }

    /**
     * Set NbProspCoordValidYNL
     *
     * @param integer $nbProspCoordValidYNL
     * @return KpiCapture
     */
    public function setNbProspCoordValidYNL($nbProspCoordValidYNL)
    {
        $this->nbProspCoordValidYNL = $nbProspCoordValidYNL;

        return $this;
    }

    /**
     * Get NbProspCoordValidYNL
     *
     * @return integer 
     */
    public function getNbProspCoordValidYNL()
    {
        return $this->nbProspCoordValidYNL;
    }

    /**
     * Set NbProspCoordNonvalidYNL
     *
     * @param integer $nbProspCoordNonvalidYNL
     * @return KpiCapture
     */
    public function setNbProspCoordNonvalidYNL($nbProspCoordNonvalidYNL)
    {
        $this->nbProspCoordNonvalidYNL = $nbProspCoordNonvalidYNL;

        return $this;
    }

    /**
     * Get NbProspCoordNonvalidYNL
     *
     * @return integer 
     */
    public function getNbProspCoordNonvalidYNL()
    {
        return $this->nbProspCoordNonvalidYNL;
    }

    /**
     * Set NbProspCoordNonrensYNL
     *
     * @param integer $nbProspCoordNonrensYNL
     * @return KpiCapture
     */
    public function setNbProspCoordNonrensYNL($nbProspCoordNonrensYNL)
    {
        $this->nbProspCoordNonrensYNL = $nbProspCoordNonrensYNL;

        return $this;
    }

    /**
     * Get NbProspCoordNonrensYNL
     *
     * @return integer 
     */
    public function getNbProspCoordNonrensYNL()
    {
        return $this->nbProspCoordNonrensYNL;
    }

    /**
     * Set NbProspEmailValidYNL
     *
     * @param integer $nbProspEmailValidYNL
     * @return KpiCapture
     */
    public function setNbProspEmailValidYNL($nbProspEmailValidYNL)
    {
        $this->nbProspEmailValidYNL = $nbProspEmailValidYNL;

        return $this;
    }

    /**
     * Get NbProspEmailValidYNL
     *
     * @return integer 
     */
    public function getNbProspEmailValidYNL()
    {
        return $this->nbProspEmailValidYNL;
    }

    /**
     * Set NbProspEmailNonvalidYNL
     *
     * @param integer $nbProspEmailNonvalidYNL
     * @return KpiCapture
     */
    public function setNbProspEmailNonvalidYNL($nbProspEmailNonvalidYNL)
    {
        $this->nbProspEmailNonvalidYNL = $nbProspEmailNonvalidYNL;

        return $this;
    }

    /**
     * Get NbProspEmailNonvalidYNL
     *
     * @return integer 
     */
    public function getNbProspEmailNonvalidYNL()
    {
        return $this->nbProspEmailNonvalidYNL;
    }

    /**
     * Set NbProspEmailNonrensYNL
     *
     * @param integer $nbProspEmailNonrensYNL
     * @return KpiCapture
     */
    public function setNbProspEmailNonrensYNL($nbProspEmailNonrensYNL)
    {
        $this->nbProspEmailNonrensYNL = $nbProspEmailNonrensYNL;

        return $this;
    }

    /**
     * Get NbProspEmailNonrensYNL
     *
     * @return integer 
     */
    public function getNbProspEmailNonrensYNL()
    {
        return $this->nbProspEmailNonrensYNL;
    }

    /**
     * Set NbProspTelValidYNL
     *
     * @param integer $nbProspTelValidYNL
     * @return KpiCapture
     */
    public function setNbProspTelValidYNL($nbProspTelValidYNL)
    {
        $this->nbProspTelValidYNL = $nbProspTelValidYNL;

        return $this;
    }

    /**
     * Get NbProspTelValidYNL
     *
     * @return integer 
     */
    public function getNbProspTelValidYNL()
    {
        return $this->nbProspTelValidYNL;
    }

    /**
     * Set NbProspTelNonvalidYNL
     *
     * @param integer $nbProspTelNonvalidYNL
     * @return KpiCapture
     */
    public function setNbProspTelNonvalidYNL($nbProspTelNonvalidYNL)
    {
        $this->nbProspTelNonvalidYNL = $nbProspTelNonvalidYNL;

        return $this;
    }

    /**
     * Get NbProspTelNonvalidYNL
     *
     * @return integer 
     */
    public function getNbProspTelNonvalidYNL()
    {
        return $this->nbProspTelNonvalidYNL;
    }

    /**
     * Set NbProspTelNonrensYNL
     *
     * @param integer $nbProspTelNonrensYNL
     * @return KpiCapture
     */
    public function setNbProspTelNonrensYNL($nbProspTelNonrensYNL)
    {
        $this->nbProspTelNonrensYNL = $nbProspTelNonrensYNL;

        return $this;
    }

    /**
     * Get NbProspTelNonrensYNL
     *
     * @return integer 
     */
    public function getNbProspTelNonrensYNL()
    {
        return $this->nbProspTelNonrensYNL;
    }

    /**
     * Set NbProspAddValidYNL
     *
     * @param integer $nbProspAddValidYNL
     * @return KpiCapture
     */
    public function setNbProspAddValidYNL($nbProspAddValidYNL)
    {
        $this->nbProspAddValidYNL = $nbProspAddValidYNL;

        return $this;
    }

    /**
     * Get NbProspAddValidYNL
     *
     * @return integer 
     */
    public function getNbProspAddValidYNL()
    {
        return $this->nbProspAddValidYNL;
    }

    /**
     * Set NbProspAddNonvalidYNL
     *
     * @param integer $nbProspAddNonvalidYNL
     * @return KpiCapture
     */
    public function setNbProspAddNonvalidYNL($nbProspAddNonvalidYNL)
    {
        $this->nbProspAddNonvalidYNL = $nbProspAddNonvalidYNL;

        return $this;
    }

    /**
     * Get NbProspAddNonvalidYNL
     *
     * @return integer 
     */
    public function getNbProspAddNonvalidYNL()
    {
        return $this->nbProspAddNonvalidYNL;
    }

    /**
     * Set NbProspAddNonrensYNL
     *
     * @param integer $nbProspAddNonrensYNL
     * @return KpiCapture
     */
    public function setNbProspAddNonrensYNL($nbProspAddNonrensYNL)
    {
        $this->nbProspAddNonrensYNL = $nbProspAddNonrensYNL;

        return $this;
    }

    /**
     * Get NbProspAddNonrensYNL
     *
     * @return integer 
     */
    public function getNbProspAddNonrensYNL()
    {
        return $this->nbProspAddNonrensYNL;
    }

    /**
     * Set nbProspOptoutYL
     *
     * @param integer $nbProspOptoutYL
     * @return KpiCapture
     */
    public function setNbProspOptoutYL($nbProspOptoutYL)
    {
        $this->nbProspOptoutYL = $nbProspOptoutYL;

        return $this;
    }

    /**
     * Get nbProspOptoutYL
     *
     * @return integer 
     */
    public function getNbProspOptoutYL()
    {
        return $this->nbProspOptoutYL;
    }

    /**
     * Set nbProspOptoutYNL
     *
     * @param integer $nbProspOptoutYNL
     * @return KpiCapture
     */
    public function setNbProspOptoutYNL($nbProspOptoutYNL)
    {
        $this->nbProspOptoutYNL = $nbProspOptoutYNL;

        return $this;
    }

    /**
     * Get nbProspOptoutYNL
     *
     * @return integer 
     */
    public function getNbProspOptoutYNL()
    {
        return $this->nbProspOptoutYNL;
    }

    /**
     * Set nbProspOptoutMl
     *
     * @param integer $nbProspOptoutMl
     * @return KpiCapture
     */
    public function setNbProspOptoutMl($nbProspOptoutMl)
    {
        $this->nbProspOptoutMl = $nbProspOptoutMl;

        return $this;
    }

    /**
     * Get nbProspOptoutMl
     *
     * @return integer 
     */
    public function getNbProspOptoutMl()
    {
        return $this->nbProspOptoutMl;
    }

    /**
     * Set nbProspOptoutMNL
     *
     * @param integer $nbProspOptoutMNL
     * @return KpiCapture
     */
    public function setNbProspOptoutMNL($nbProspOptoutMNL)
    {
        $this->nbProspOptoutMNL = $nbProspOptoutMNL;

        return $this;
    }

    /**
     * Get nbProspOptoutMNL
     *
     * @return integer 
     */
    public function getNbProspOptoutMNL()
    {
        return $this->nbProspOptoutMNL;
    }

    /**
     * Set pctProspOptoutYL
     *
     * @param string $pctProspOptoutYL
     * @return KpiCapture
     */
    public function setPctProspOptoutYL($pctProspOptoutYL)
    {
        $this->pctProspOptoutYL = $pctProspOptoutYL;

        return $this;
    }

    /**
     * Get pctProspOptoutYL
     *
     * @return string 
     */
    public function getPctProspOptoutYL()
    {
        return $this->pctProspOptoutYL;
    }

    /**
     * Set pctProspOptoutYNL
     *
     * @param string $pctProspOptoutYNL
     * @return KpiCapture
     */
    public function setPctProspOptoutYNL($pctProspOptoutYNL)
    {
        $this->pctProspOptoutYNL = $pctProspOptoutYNL;

        return $this;
    }

    /**
     * Get pctProspOptoutYNL
     *
     * @return string 
     */
    public function getPctProspOptoutYNL()
    {
        return $this->pctProspOptoutYNL;
    }

    /**
     * Set pctProspOptoutMl
     *
     * @param string $pctProspOptoutMl
     * @return KpiCapture
     */
    public function setPctProspOptoutMl($pctProspOptoutMl)
    {
        $this->pctProspOptoutMl = $pctProspOptoutMl;

        return $this;
    }

    /**
     * Get pctProspOptoutMl
     *
     * @return string 
     */
    public function getPctProspOptoutMl()
    {
        return $this->pctProspOptoutMl;
    }

    /**
     * Set pctProspOptoutMNL
     *
     * @param string $pctProspOptoutMNL
     * @return KpiCapture
     */
    public function setPctProspOptoutMNL($pctProspOptoutMNL)
    {
        $this->pctProspOptoutMNL = $pctProspOptoutMNL;

        return $this;
    }

    /**
     * Get pctProspOptoutMNL
     *
     * @return string 
     */
    public function getPctProspOptoutMNL()
    {
        return $this->pctProspOptoutMNL;
    }
}
