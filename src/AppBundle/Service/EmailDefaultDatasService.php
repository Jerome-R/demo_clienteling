<?php
 
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Application\Sonata\UserBundle\Entity\User;
 
class EmailDefaultDatasService
{
    private $container;
    private $session;
    private $id;

	public function __construct(ContainerInterface $container)
	{

    $this->container = $container;

    $this->session = $this->container->get('session');

	}


    public function SetEmailDefaultDatas ($id, $eshop, $template_number)
    {
        $this->id = $id;
        if ( $template_number == null )
        {
            switch($this->id){
                case "Trigger_AA_Boutique_1_E":
                    if($eshop == null)
                    {
                        $this->session->set('template_number', 0);
                        $this->session->set('email_subject', "Déjà 1 an ...");
                        $this->session->set('email_language', 'fr');
                    }
                    else
                    {
                        $this->session->set('template_number', 9);
                        $this->session->set('email_subject', "Déjà 1 an ...");
                        $this->session->set('email_language', 'fr');
                    }
                break;
                case "Trigger_WP_Boutique_1_E":
                    if($eshop == null)
                    {
                        $this->session->set('template_number', 3);
                        $this->session->set('email_subject', "Merci pour votre confiance");
                        $this->session->set('email_language', 'fr');
                    }
                    else
                    {
                        $this->session->set('template_number', 12);
                        $this->session->set('email_subject', "Merci pour votre confiance");
                        $this->session->set('email_language', 'fr');
                    }
                break;
                case "Trigger_WB_Boutique_1_E":
                    if($eshop == null)
                    {
                        $this->session->set('template_number', 6);
                        $this->session->set('email_subject', "Merci pour votre fidélité");
                        $this->session->set('email_language', 'fr');
                    }
                    else
                    {
                        $this->session->set('template_number', 15);
                        $this->session->set('email_subject', "Merci pour votre fidélité");
                        $this->session->set('email_language', 'fr');
                    }
                break;
                case "Trigger_AA_Boutique_1_P":
                    if($eshop == null)
                    {
                        $this->session->set('template_number', 0);
                        $this->session->set('email_subject', "Déjà 1 an ...");
                        $this->session->set('email_language', 'fr');
                    }
                    else
                    {
                        $this->session->set('template_number', 9);
                        $this->session->set('email_subject', "Déjà 1 an ...");
                        $this->session->set('email_language', 'fr');
                    }
                break;
                case "Trigger_WP_Boutique_1_P":
                    if($eshop == null)
                    {
                        $this->session->set('template_number', 3);
                        $this->session->set('email_subject', "Merci pour votre confiance");
                        $this->session->set('email_language', 'fr');
                    }
                    else
                    {
                        $this->session->set('template_number', 12);
                        $this->session->set('email_subject', "Merci pour votre confiance");
                        $this->session->set('email_language', 'fr');
                    }
                break;
                case "Trigger_WB_Boutique_1_P":
                    if($eshop == null)
                    {
                        $this->session->set('template_number', 6);
                        $this->session->set('email_subject', "Merci pour votre fidélité");
                        $this->session->set('email_language', 'fr');
                    }
                    else
                    {
                        $this->session->set('template_number', 15);
                        $this->session->set('email_subject', "Merci pour votre fidélité");
                        $this->session->set('email_language', 'fr');
                    }
                break;
                default:
                break;
            }
        }
        else{
            switch ($template_number) {
                case 0:
                    $this->session->set('email_subject', "Déjà 1 an ...");
                    $this->session->set('email_language', 'fr');
                break;
                case 1:
                    $this->session->set('email_subject', "Already 1 year ...");
                    $this->session->set('email_language', 'en');
                break;
                case 2:
                    $this->session->set('email_subject', "Alweer 1 jaar ...");
                    $this->session->set('email_language', 'nl');
                break;
                case 3:
                    $this->session->set('email_subject', "Merci pour votre confiance");
                    $this->session->set('email_language', 'fr');
                break;
                case 4:
                    $this->session->set('email_subject', "Thank you for your trust");
                    $this->session->set('email_language', 'en');
                break;
                case 5:
                    $this->session->set('email_subject', "Bedankt voor uw vertrouwen");
                    $this->session->set('email_language', 'nl');
                break;
                case 6:
                    $this->session->set('email_subject', "Merci pour votre fidélité");
                    $this->session->set('email_language', 'fr');
                break;
                case 7:
                    $this->session->set('email_subject', "Thank you for you loyalty");
                    $this->session->set('email_language', 'en');
                break;
                case 8:
                    $this->session->set('email_subject', "Bedankt voor uw loyaliteit");
                    $this->session->set('email_language', 'nl');
                break;
                case 9:
                    $this->session->set('email_subject', "Déjà 1 an ...");
                    $this->session->set('email_language', 'fr');
                break;
                case 10:
                    $this->session->set('email_subject', "Already 1 year ...");
                    $this->session->set('email_language', 'en');
                break;
                case 11:
                    $this->session->set('email_subject', "Alweer 1 jaar ...");
                    $this->session->set('email_language', 'nl');
                break;
                case 12:
                    $this->session->set('email_subject', "Merci pour votre confiance");
                    $this->session->set('email_language', 'fr');
                break;
                case 13:
                    $this->session->set('email_subject', "Thank you for your trust");
                    $this->session->set('email_language', 'en');
                break;
                case 14:
                    $this->session->set('email_subject', "Bedankt voor uw vertrouwen");
                    $this->session->set('email_language', 'nl');
                break;
                case 15:
                    $this->session->set('email_subject', "Merci pour votre fidélité");
                    $this->session->set('email_language', 'fr');
                break;
                case 16:
                    $this->session->set('email_subject', "Thank you for you loyalty");
                    $this->session->set('email_language', 'en');
                break;
                case 17:
                    $this->session->set('email_subject', "Bedankt voor uw loyaliteit");
                    $this->session->set('email_language', 'nl');
                break;
                
                default:
                    # code...
                    break;
            }
        }
    }
}