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
                case "trigger_A_E":
                    $this->session->set('template_number', 0);
                    $this->session->set('email_subject', "Déjà 1 an ...");
                    $this->session->set('email_language', 'fr');
                break;
                case "trigger_D_P":
                    $this->session->set('template_number', 0);
                    $this->session->set('email_subject', "Déjà 1 an ...");
                    $this->session->set('email_language', 'fr');
                break;
                case "trigger_C_P":
                    $this->session->set('template_number', 2);
                    $this->session->set('email_subject', "Votre invitation pour la présentation de la nouvelle collection 2017");
                    $this->session->set('email_language', 'fr');
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
                    $this->session->set('email_subject', "Votre invitation pour la présentation de la nouvelle collection 2017");
                    $this->session->set('email_language', 'fr');
                break;
                
                default:
                break;
            }
        }
    }
}