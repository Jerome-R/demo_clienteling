<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ClientFilterService
{
    private $container;
    private $session;
    private $em;

    public function __construct(ContainerInterface $container, EntityManager $entityManager)
    {

        $this->container = $container;
        $this->em = $entityManager;
        $this->session = $this->container->get('session');

    }

    public function initVars($user, $request)
    {
        //Init var
        $local      = "";
        $fullName   = "";
        $filters    = "";
        $libelleBoutiqueRattachement      = "";
        $dr         = "";
        $vendorCode = "";

        $dataRequest = $request->request->get('appbundle_clients_filter');

        //Set up options Filtre dynamique en focntion du role de l'utilisateur connecté.
        if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
            if( $dataRequest['retailManager'] != '' )
            {                
                $rm = $this->em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('id' => $dataRequest['retailManager']));
                $rm = $rm->getLibelle();
                $this->session->set('filtre_trigger_client_RM_tc', $rm);
            }
            else{
                if ( $request->getMethod() == 'POST' ) {
                    $this->session->remove('filtre_trigger_client_RM_tc');
                    $rm = "";
                }
                else
                { 
                    if (  $this->session->get('filtre_trigger_client_RM_tc') != null)
                    {
                        $rm = $this->session->get('filtre_trigger_client_RM_tc');
                    }
                    else
                    {
                        $rm = "";
                    }
                }
            }

            if( $dataRequest['libelleBoutiqueRattachement'] != '' && $rm != "") {
                $libelleBoutiqueRattachement = $this->em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('id' => $dataRequest['libelleBoutiqueRattachement']));
                $this->session->set('filtre_trigger_client_boutique_tc', $libelleBoutiqueRattachement);

                if ($libelleBoutiqueRattachement->getRetailManager() != $rm) {
                    $dataRequest['libelleBoutiqueRattachement'] = '';
                    $this->session->remove('filtre_trigger_client_boutique_tc');
                }
            }
        }
        elseif ( $user->getRole() == 'ROLE_RETAIL_MANAGER' ) {
            $rm = $user->getLibelle();
            $this->session->set('filtre_trigger_client_RM_tc', $rm);
        }
        elseif ( $user->getRole() == 'ROLE_DIRECTEUR' ) {
            $rm = "";
            $dr = $user->getLibelle();
            $this->session->set('filtre_trigger_client_dr_tc', $dr);
        }
        elseif ( $user->getRole() == 'ROLE_BOUTIQUE' ) {
            $rm = "";
            $dr = "";
            $this->session->set('filtre_trigger_client_boutique_tc', $user->getLibelle());
        }

        $vars = array(  $local,
                        $fullName,
                        $filters,
                        $libelleBoutiqueRattachement,
                        $dr,
                        $vendorCode,
                        $rm
                );

        return $vars;
    }

    public function updateSessionVars($local,$fullName,$filters,$libelleBoutiqueRattachement,$dr,$vendorCode,$rm){

        if($libelleBoutiqueRattachement == '' ){
            $this->session->remove('filtre_trigger_client_boutique_tc');
        }
        else{
            $this->session->set('filtre_trigger_client_boutique_tc', $libelleBoutiqueRattachement);
        }

        if($local == '' ){
            $this->session->remove('filtre_trigger_client_local_tc');
        }
        else{
            $this->session->set('filtre_trigger_client_local_tc', $local);
        }

        if($fullName == '' ){
            $this->session->remove('filtre_trigger_client_fullname_tc');
        }
        else{
            $this->session->set('filtre_trigger_client_fullname_tc', $fullName);
        }

        if($filters == '' ){
            $this->session->remove('filtre_trigger_client_filters_tc');
        }
        else{
            $this->session->set('filtre_trigger_client_filters_tc', $filters);
        }

        if($dr == '' ){
            $this->session->remove('filtre_trigger_client_dr_tc');
        }
        else{
            $this->session->set('filtre_trigger_client_dr_tc', $dr);
        }

        if($vendorCode == '' ){
            $this->session->remove('filtre_trigger_client_vendorCode_tc');
        }
        else{
            $this->session->set('filtre_trigger_client_vendorCode_tc', $vendorCode);
        }

        return;
    }

    public function updateForm($user, $request, $form){
        if($this->session->get('filtre_trigger_client_RM_tc') != null && $request->getMethod() == 'GET' && $user->getRole() == "ROLE_SIEGE"){
            $form->get('retailManager')->setData($this->em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('libelle' => $this->session->get('filtre_trigger_client_RM_tc'))));
        }
        if($this->session->get('filtre_trigger_client_boutique_tc') != null && $request->getMethod() == 'GET' && ($user->getRole() == "ROLE_SIEGE" || $user->getRole() == "ROLE_DIRECTEUR" || $user->getRole() == "ROLE_RETAIL_MANAGER")){
            $form->get('libelleBoutiqueRattachement')->setData($this->em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('libelle' => $this->session->get('filtre_trigger_client_boutique_tc'))));
        }

        if($this->session->get('filtre_trigger_client_local_tc') != null && $request->getMethod() == 'GET'){
            $form->get('local')->setData($this->session->get('filtre_trigger_client_local_tc'));
        }
        if($this->session->get('filtre_trigger_client_vendorCode_tc') != null && $request->getMethod() == 'GET'){
            $form->get('vendorCode')->setData($this->session->get('filtre_trigger_client_vendorCode_tc'));
        }
        if($this->session->get('filtre_trigger_client_fullname_tc') != null && $request->getMethod() == 'GET'){
            $form->get('fullName')->setData($this->session->get('filtre_trigger_client_fullname_tc'));
        }
        if($this->session->get('filtre_trigger_client_filters_tc') != null && $request->getMethod() == 'GET'){
            $form->get('filters')->setData($this->session->get('filtre_trigger_client_filters_tc'));
        }

        return $form;
    }
}
