<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Session\Session;

use AppBundle\Entity\Campaign;
use AppBundle\Entity\Client;
use AppBundle\Entity\Recipient;

use ApplicationSonataUserBundle\Entity\User;

use AppBundle\Form\ExcludeClientFromCampaignType;
use AppBundle\Form\RecipientType;
use AppBundle\Form\RecipientCommentType;
use AppBundle\Form\RecipientValidateContactType;
use AppBundle\Form\ChangeChannelRecipientType;
use AppBundle\Form\ClientType;
use AppBundle\Form\CampaignType;
use AppBundle\Form\SendEmailType;
use AppBundle\Form\ClientsFilterType;
use AppBundle\Form\ValidationType;

use AppBundle\Form\ValidationLaterType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

// Annotaitonss :
// Pour gérer les autorisations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
// Pour gérer le ParamConverter et utiliser un entité en parametre à la place d'une simple variable
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CampaignController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        
        /*if( !in_array("campaign", $modules) ){
            throw new AccessDeniedHttpException();
        }*/

        //Handle session variables for email
        $session = $request->getSession();

        $session->remove('email_message');
        $session->remove('email_vendeur');
        $session->remove('email_language');
        $session->remove('email_subject');
        $session->remove('template_number');
        $session->remove('email_dest');
        $session->remove('email_signature');
        $session->remove('email_opera');

        $em = $this->getDoctrine()->getManager();

        //$campaigns = $em->getRepository('AppBundle:Campaign')->getCampaigns();
        $campaigns = $em->getRepository('AppBundle:Campaign')->getActiveCampaigns();
        //$campaigns = $em->getRepository('AppBundle:Campaign')->getActiveCampaignsList();
        
        if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
            foreach ($campaigns as $key => $campaign) {
                $campaign->setNbOptOut($em->getRepository('AppBundle:Recipient')->getNbOptOut($campaign));
                $campaign->setNbClients($em->getRepository('AppBundle:Recipient')->getTotalRecipientsForCampaign($campaign));
                $campaign->setNbContacted($em->getRepository('AppBundle:Recipient')->getNbContacted($campaign));
            }
        }
        elseif( $user->getRole() == 'ROLE_RETAIL_MANAGER' ) {
            foreach ($campaigns as $key => $campaign) {
                $campaign->setNbOptOut($em->getRepository('AppBundle:Recipient')->getNbOptOutRm($campaign, $user));
                $campaign->setNbClients($em->getRepository('AppBundle:Recipient')->getTotalRecipientsForCampaignRm($campaign, $user));
                $campaign->setNbContacted($em->getRepository('AppBundle:Recipient')->getNbContactedRm($campaign, $user));
            }
        }
        elseif( $user->getRole() == 'ROLE_DIRECTEUR' ) {
            foreach ($campaigns as $key => $campaign) {
                $campaign->setNbOptOut($em->getRepository('AppBundle:Recipient')->getNbOptOutDr($campaign, $user));
                $campaign->setNbClients($em->getRepository('AppBundle:Recipient')->getTotalRecipientsForCampaignDr($campaign, $user));
                $campaign->setNbContacted($em->getRepository('AppBundle:Recipient')->getNbContactedDr($campaign, $user));
            }
        }
        elseif( $user->getRole() == 'ROLE_BOUTIQUE' ) {
            foreach ($campaigns as $key => $campaign) {
                $campaign->setNbOptOut($em->getRepository('AppBundle:Recipient')->getNbOptOutStore($campaign, $user));
                $campaign->setNbClients($em->getRepository('AppBundle:Recipient')->getTotalRecipientsForCampaignStore($campaign, $user));
                $campaign->setNbContacted($em->getRepository('AppBundle:Recipient')->getNbContactedStore($campaign, $user));
            }
        }

        $em->flush();

        // replace this example code with whatever you need
        return $this->render('AppBundle:Campaign:index.html.twig', array(
            'campaigns' => $campaigns,
            'session' => $_SESSION
            )
        );
    }

    /**
     * @ParamConverter("campaign", options={"mapping": {"campaign_id": "id"}})
     */
    public function viewCampaignClientsListAction(Campaign $campaign, Request $request)
    {
        if( !$campaign->getActiveCampaign() )
        {
             throw new AccessDeniedHttpException();
        }

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();   

        $session = $request->getSession();

        //Mauvais argument, mais bug sinon, affiche tout les retails
        $dataRequest = $request->request->get('appbundle_clients_filter');

        //Si le numero de page est dans la requete on le recupère
        if( isset($dataRequest['page']) )  {
            if ($dataRequest['page'] != null && $dataRequest['page'] > 0)
                $page = $dataRequest['page'];
            else 
                $page = 1;
        }
        else 
            $page = 1;

        //Init var
        $local      = "";
        $fullName   = "";
        $filters    = "";
        $dr         = "";
        $codevendeur = "";

        if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
            if( $dataRequest['retailManager'] != '' )  {
                $rm = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('id' => $dataRequest['retailManager']));
                $rm = $rm->getLibelle();
                $session->set('filtre_trigger_client_RM', $rm);

            }
            else{
                if ( $request->getMethod() == 'POST' ) {
                    $session->remove('filtre_trigger_client_RM');
                    $rm = "";
                }
                else
                { 
                    if (  $session->get('filtre_trigger_client_RM') != null)
                    {
                        $rm = $session->get('filtre_trigger_client_RM');
                    }
                    else
                    {
                        $rm = "";
                    }
                }
            }

            if( $dataRequest['libelleBoutiqueRattachement'] != '' && $rm != "") {
                $libelleBoutiqueRattachement = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('id' => $dataRequest['libelleBoutiqueRattachement']));
                $session->set('filtre_trigger_client_boutique', $libelleBoutiqueRattachement);

                if ($libelleBoutiqueRattachement->getRetailManager() != $rm) {
                    $dataRequest['libelleBoutiqueRattachement'] = '';
                    $session->remove('filtre_trigger_client_boutique');

                }
            }
        }
        elseif ( $user->getRole() == 'ROLE_RETAIL_MANAGER' ) {
            $rm = $user->getLibelle();
            $session->set('filtre_trigger_client_RM', $rm);
        }
        elseif ( $user->getRole() == 'ROLE_DIRECTEUR' ) {
            $rm = "";
            $dr = $user->getLibelle();
            $session->set('filtre_trigger_client_dr', $dr);
        }
        elseif ( $user->getRole() == 'ROLE_BOUTIQUE' ) {
            $rm = "";
            $dr = "";
            $session->set('filtre_trigger_client_boutique', $user->getLibelle());
        }
                   
        $form = $this->createForm(new ClientsFilterType($em, $user, $rm));
        $form->handleRequest($request);        

        $data = $form->getData();

        //Si la donnée topClient local est dans la requête on la récupère
        if( isset($data['retailManager']) )  {
            $rm = $data['retailManager']->getLibelle();
        }
        //Si la donnée topClient local est dans la requête on la récupère
        if( isset($data['libelleBoutiqueRattachement']) )  {
            $libelleBoutiqueRattachement = $data['libelleBoutiqueRattachement']->getLibelle();
        }
        elseif($user->getRole() == "ROLE_BOUTIQUE"){
            $libelleBoutiqueRattachement = $user->getLibelle();
        }
        else
            $libelleBoutiqueRattachement = "";
        //Si la donnée topClient local est dans la requête on la récupère
        if( isset($data['local']) )  {
            $local = $data['local'];
        }
        //Si la donnée topClient fullName est dans la requête on la récupère
        if( isset($data['fullName']) )  {
            $fullName = $data['fullName'];
        }
        if( isset($data['filters']) )  {
            $filters = $data['filters'];
        }
        if( isset($data['codevendeur']) )  {
            $codevendeur = $data['codevendeur'];
        }

        if ( $request->getMethod() == 'POST' ) {

            if($libelleBoutiqueRattachement == '' ){
                $session->remove('filtre_trigger_client_boutique');
            }
            else{
                $session->set('filtre_trigger_client_boutique', $libelleBoutiqueRattachement);
            }

            if($local == '' ){
                $session->remove('filtre_trigger_client_local');
            }
            else{
                $session->set('filtre_trigger_client_local', $local);
            }

            if($fullName == '' ){
                $session->remove('filtre_trigger_client_fullname');
            }
            else{
                $session->set('filtre_trigger_client_fullname', $fullName);
            }

            if($filters == '' ){
                $session->remove('filtre_trigger_client_filters');
            }
            else{
                $session->set('filtre_trigger_client_filters', $filters);
            }

            if($dr == '' ){
                $session->remove('filtre_trigger_client_dr');
            }
            else{
                $session->set('filtre_trigger_client_dr', $dr);
            }

            if($codevendeur == '' ){
                $session->remove('filtre_trigger_client_codevendeur');
            }
            else{
                $session->set('filtre_trigger_client_codevendeur', $codevendeur);
            }
        }
        $options = array(
            'campaign'      => $campaign,
            'local'         => $session->get('filtre_trigger_client_local'),
            'fullname'      => $session->get('filtre_trigger_client_fullname'),
            'filters'       => $session->get('filtre_trigger_client_filters'),
            'libelleBoutiqueRattachement'         => $session->get('filtre_trigger_client_boutique'),
            'rm'            => $session->get('filtre_trigger_client_RM'),
            'dr'            => $session->get('filtre_trigger_client_dr'),
            'codevendeur'    => $session->get('filtre_trigger_client_codevendeur'),            
        );


        if( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
            if ( $request->getMethod() == 'POST' ) {

                //var_dump( $retailManager->getLibelle() );die();
                if($session->get('filtre_trigger_client_boutique') != '' ){
                    $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheStore( $options );
                }
                elseif($session->get('filtre_trigger_client_RM') != '' ){
                    $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheRm( $options );
                }
                else{
                    $recipients = $em->getRepository('AppBundle:Recipient')->getClientsForCampaign( $options );
                }
            }
            else{
                if($session->get('filtre_trigger_client_boutique') != '' ){
                    $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheStore( $options );
                }
                elseif($session->get('filtre_trigger_client_RM') != '' ){
                    $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheRm( $options );
                }
                else
                    $recipients = $em->getRepository('AppBundle:Recipient')->getClientsForCampaign( $options );
            }
        }
        elseif( $user->getRole() == 'ROLE_RETAIL_MANAGER' ) {
            if ( $request->getMethod() == 'POST' ) {
                
                    $retailManager = $user;

                    if($session->get('filtre_trigger_client_boutique') != '' ){
                        $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheStore($options );
                    }
                    else{
                        $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheRm( $options );
                    }
            }
            else{
                if($session->get('filtre_trigger_client_boutique') != '' ){
                    $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheStore($options );
                }
                else
                    $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheRm( $options );
            }
        }
        elseif( $user->getRole() == 'ROLE_DIRECTEUR' ) {

            if ( $request->getMethod() == 'POST' ) {
                if($session->get('filtre_trigger_client_boutique') != '' ){
                    $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheStore($options );
                }
                else{
                    $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheDirector( $options );
                }
            }
            else{
                if($session->get('filtre_trigger_client_boutique') != '' ){
                    $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheStore($options );
                }
                else
                    $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheDirector( $options);
            }
        }
        else {
            $recipients = $em->getRepository('AppBundle:Recipient')->getClientsOfTheStore( $options );
        }

        if($session->get('filtre_trigger_client_RM') != null && $request->getMethod() == 'GET' && $user->getRole() == "ROLE_SIEGE"){
            $form->get('retailManager')->setData($em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('libelle' => $session->get('filtre_trigger_client_RM'))));
        }
        if($session->get('filtre_trigger_client_boutique') != null && $request->getMethod() == 'GET' && ($user->getRole() == "ROLE_SIEGE" || $user->getRole() == "ROLE_DIRECTEUR" || $user->getRole() == "ROLE_RETAIL_MANAGER")){
            $form->get('libelleBoutiqueRattachement')->setData($em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('libelle' => $session->get('filtre_trigger_client_boutique'))));
        }

        if($session->get('filtre_trigger_client_local') != null && $request->getMethod() == 'GET'){
            $form->get('local')->setData($session->get('filtre_trigger_client_local'));
        }
        if($session->get('filtre_trigger_client_codevendeur') != null && $request->getMethod() == 'GET'){
            $form->get('codevendeur')->setData($session->get('filtre_trigger_client_codevendeur'));
        }
        if($session->get('filtre_trigger_client_fullname') != null && $request->getMethod() == 'GET'){
            $form->get('fullName')->setData($session->get('filtre_trigger_client_fullname'));
        }

        //Paginator : Pagination
        $recipients  = $this
                ->get('knp_paginator')
                ->paginate(
                    $recipients,
                    //$request->query->get('page', 1),//page number,
                    $page,
                    50//limit per page
        );



        // replace this example code with whatever you need
        return $this->render('AppBundle:Campaign:viewCampaignClientsList.html.twig', array(
            'campaign'      => $campaign,
            'recipients'    => $recipients,
            'form'          => $form->createView(),
            )
        );
    }

    /**
     * @ParamConverter("campaign", options={"mapping": {"campaign_id": "id"}})
     * @ParamConverter("client", options={"mapping": {"client_id": "id"}})
     */
    public function viewCampaignClientAction(Campaign $campaign, Client $client, Request $request)
    {   
        $user = $this->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $recipient = $em->getRepository('AppBundle:Recipient')->findOneBy(array('campaign' => $campaign, 'client' => $client));
        $dataRecipient = $em->getRepository('AppBundle:DataRecipient')->findOneBy(array('client' => $recipient->getClient(), 'idCampagneName' => $recipient->getIdCampagneName()));

        $isAuthorized = $this->get('app.is_authorized_client')->isAuthorized($user, $client, "trigger", $dataRecipient);

        if( !$isAuthorized || !$campaign->getActiveCampaign())
        {
             throw new AccessDeniedHttpException();
        }

        $form       =  $this->createForm(new ExcludeClientFromCampaignType(), $recipient);
        $formTwo    =  $this->createForm(new RecipientCommentType(), $recipient);
        $formThree  =  $this->createForm(new ChangeChannelRecipientType($recipient->getClient()), $recipient);
        $formSix    =  $this->createForm(new ChangeChannelRecipientType($recipient->getClient()), $recipient);
        $formFour   =  $this->createForm(new RecipientValidateContactType(), $recipient);
        $formFive   =  $this->createForm(new ValidationLaterType());

        $form->handleRequest($request);
        $formTwo->handleRequest($request);
        $formThree->handleRequest($request);
        $formFour->handleRequest($request);
        $formFive->handleRequest($request);
        $formSix->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            //persist inutile, Doctrine connait l'entité
            
            $client->setIsAdresseValide(!$client->getIsAdresseValide());
            $client->setIsEmailValide(!$client->getIsAdresseValide());
            $client->setIsTelValide(!$client->getIsAdresseValide());
            
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Client mis à jour.');

            return $this->redirect($this->generateUrl('app_campaign_clients_list', array('campaign_id' => $recipient->getCampaign()->getId())));
        }
        if ( $formTwo->isSubmitted() && $formTwo->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            //persist inutile, Doctrine connait l'entité

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Commentaire enregistré.');

            //return $this->redirect($this->generateUrl('app_campaign_clients_list', array('campaign_id' => $recipient->getCampaign()->getId())));
        }
        if ( $formThree->isSubmitted() && $formThree->isValid() ) {
            $em = $this->getDoctrine()->getManager();

            if($recipient->getCampaign()->getType() == "adHoc"){
                $recipient->setContactedAt(new \DateTime());

                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Client adHoc validé: ' . $recipient->getCanal() . '.'); 

                return $this->redirect($this->generateUrl('app_campaign_clients_list', array('campaign_id' => $recipient->getCampaign()->getId())));  
            }
            else{
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Canal du client modifié : ' . $recipient->getCanal() . '.');   
            }         
        }
        if ( $formFour->isSubmitted() && $formFour->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $recipient->setContactedAt(new \DateTime());

            $campaingTracking = $em->getRepository('AppBundle:Tracking')->findOneBy( array( "campaign" => $recipient->getCampaign() ) );
            
            if($campaingTracking == null){
                $campaingTracking = new campaingTracking();
                $campaingTracking->setCampaign( $recipient->getCampaign() );

                $em->persist($campaingTracking);
            }

            switch($recipient->getCanal()){
                case "Email":
                    $campaingTracking->increaseEmailsSent();
                break;
                case "Mail":
                    $campaingTracking->increaseMailsSent();
                break;
                case "Phone":
                    $campaingTracking->increasePhoneCalls();
                break;
                case "SMS":
                    $campaingTracking->increaseSmsSent();
                break;
            }

            //persist inutile, Doctrine connait l'entité
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Cible validée.');

            return $this->redirect($this->generateUrl('app_campaign_clients_list', array('campaign_id' => $recipient->getCampaign()->getId())));
        }
        if ( $formFive->isSubmitted() && $formFive->isValid() ) {
            $em = $this->getDoctrine()->getManager();

            $recipient->setContactLater(true);
            
            //persist inutile, Doctrine connait l'entité
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Contacter plus tard : ' . $recipient->getCanal() . '.');

            return $this->redirect($this->generateUrl('app_campaign_clients_list', array('campaign_id' => $recipient->getCampaign()->getId())));        
        }
        
        // replace this example code with whatever you need
        return $this->render('AppBundle:Campaign:viewCampaignClient.html.twig', array(
            'campaign'  => $campaign,
            'client'    => $client,
            'recipient' => $recipient,
            'form'      => $form->createView(),
            'formTwo'   => $formTwo->createView(),
            'formThree' => $formThree->createView(),
            'formFour'  => $formFour->createView(),
            'formFive'  => $formFive->createView(),
            'formSix'   => $formSix->createView(),
            )
        );
    }

    /**
     * @ParamConverter("recipient", options={"mapping": {"recipient_id": "id"}})
     */
    public function CampaignSendEmailAction(Recipient $recipient, Request $request)
    {   
        $user= $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $dataRecipient = $em->getRepository('AppBundle:DataRecipient')->findOneBy(array('client' => $recipient->getClient(), 'idCampagneName' => $recipient->getIdCampagneName()));

        $isAuthorized = $this->get('app.is_authorized_client')->isAuthorized($user, $recipient->getClient(), "trigger", $dataRecipient);

        if( !$isAuthorized || !$recipient->getCampaign()->getActiveCampaign() )
        {
             throw new AccessDeniedHttpException();
        }

        //Si on est pas admin et que l'email a déjà était envoyé on redirige vers la liste de contacts
        if($user->getLibelle() != "admin" && $recipient->getIsEmailSent()) {
            $request->getSession()->getFlashBag()->add('warning', 'Email déjà envoyé à '.$recipient->getClient()->getFullName().' pour cette campagne.');
            return $this->redirect($this->generateUrl('app_campaign_clients_list', array('campaign_id' => $recipient->getCampaign()->getId())));
        }


        $session = $request->getSession();        

        if( $dataRecipient->getLibelleBoutiqueAchat() == "E-Commerce" )
        {
            $eshop = 1;
        }
        else $eshop = null;

        //Init default option for email sending
        $emailOptions = $this->get('app.email_set_default_datas');
        $emailOptions->SetEmailDefaultDatas($recipient->GetCampaign()->getIdCampaignName(), $eshop, $session->get('template_number'));

        //$template = $session->get('email_language');

        $client = $recipient->getClient();
        $campaign = $recipient->getCampaign();

        if ($user->hasRole('ROLE_SUPER_ADMIN'))
        {
            $form   =  $this->createForm(new SendEmailType($session->get('template_number'), $user->getLibelle(), $recipient->getCampaign()->getIdCampaignName()));
        } 
        else{
            $form   =  $this->createForm(new SendEmailType($session->get('template_number'), $dataRecipient->getLibelleBoutiqueAchat(), $recipient->getCampaign()->getIdCampaignName()));
        }
        
        if ( $request->getMethod() == 'POST' ) {
            $form->handleRequest($request);
            $data = $form->getData();

            $session = $request->getSession();
            $session->set('email_message', $data['message']);
            $session->set('email_vendeur', $data['vendeur']);
            $session->set('email_subject', $data['subject']);
            $session->set('email_dest', $recipient->getClient()->getIdClient());
            $session->set('template_number', $data['template']);            

            if(in_array($session->get('template_number'), array(1,4,7,10,13,16)))
            {
                $session->set('email_language', "en");
            }
            elseif (in_array($session->get('template_number'), array(2,5,8,11,14,17)))
            {
                $session->set('email_language', "nl");
            }
            else{
                $session->set('email_language', "fr");
            }

            $lang = $session->get('email_language');

            $libelleBoutiqueRattachement = $dataRecipient->getLibelleBoutiqueAchat();
            
            /*if($libelleBoutiqueRattachement == "Opéra") {
                if( $lang == "fr")
                    $opera = "Pendant les travaux, nous vous accueillons dans notre boutique 24 rue de la Paix, Paris 2ème.";
                elseif( $lang == "en")
                    $opera = "During the maintenance work, we will be happy to welcome to our boutique at 24 rue de la Paix, 75002 Paris.";
                else
                    $opera = "";
            }
            else{
                $opera = "";
            }

            $session->set('email_opera', $opera);*/

            if($user->getRole() == "ROLE_BOUTIQUE") {
                $signature = $user->getSignature();
            }
            else{
                $libelleBoutiqueRattachement_libelle = $dataRecipient->getLibelleBoutiqueAchat();
                $libelleBoutiqueRattachement = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('libelle' => $libelleBoutiqueRattachement_libelle));
                if ($libelleBoutiqueRattachement != null)
                    $signature = $libelleBoutiqueRattachement->getSignature();
                else
                    $signature = "";
            }

            $session->set('email_signature', $signature);   

            return $this->redirectToRoute('app_campaign_validate_email', array('recipient_id' => $recipient->getId()));
        }

        return $this->render('AppBundle:Campaign:viewCampaignSendEmail.html.twig', array(
            'recipient'   => $recipient,
            'campaign'    => $campaign,
            'client'      => $client,
            'form'        => $form->createView(),
            )
        );
    }


    /**
     * @ParamConverter("recipient", options={"mapping": {"recipient_id": "id"}})
     */
    public function CampaignValidateEmailAction(Recipient $recipient, Request $request)
    {   
        $user= $this->get('security.context')->getToken()->getUser();

        //default connection
        $em = $this->getDoctrine()->getManager();
        $dataRecipient = $em->getRepository('AppBundle:DataRecipient')->findOneBy(array('client' => $recipient->getClient(), 'idCampagneName' => $recipient->getIdCampagneName()));

        $isAuthorized = $this->get('app.is_authorized_client')->isAuthorized($user, $recipient->getClient(), "trigger", $dataRecipient);

        if( !$isAuthorized || !$recipient->getCampaign()->getActiveCampaign() )
        {
             throw new AccessDeniedHttpException();
        }

        //Si on est pas admin et que l'email a déjà était envoyé on redirige vers la liste de contacts
        if($user->getLibelle() != "admin" && $recipient->getIsEmailSent()) {
            $request->getSession()->getFlashBag()->add('warning', 'Email déjà envoyé à'.$recipient->getClient()->getFullName().' pour cette campagne.');
            return $this->redirect($this->generateUrl('app_campaign_clients_list', array('campaign_id' => $recipient->getCampaign()->getId())));
        }

        $session = $request->getSession();

        if( $session->get('email_dest') != $recipient->getClient()->getIdClient() ) {
            return $this->redirectToRoute('app_home');
        }      

        $libelleBoutiqueRattachement = $em->getRepository("ApplicationSonataUserBundle:User")->findOneBy(array('libelle' => $dataRecipient->getLibelleBoutiqueAchat()));
        
        if($libelleBoutiqueRattachement->getEmailReply() != null and $libelleBoutiqueRattachement->getEmailReply() != ""){
             $libelleBoutiqueRattachementEmail = $libelleBoutiqueRattachement->getEmailReply();
        }
        else{
             $libelleBoutiqueRattachementEmail = $libelleBoutiqueRattachement->getEmail();
        }

        $lang = $session->get('email_language');

        /*$opera = $session->get("email_opera");*/

        if( $user ->getLibelle() == "E-Commerce" )
        {
            $eshop = 1;
        }
        else $eshop = null;

        //Init default option for email sending
        $emailOptions = $this->get('app.email_set_default_datas');
        $emailOptions->SetEmailDefaultDatas($recipient->getCampaign()->getIdCampaignName(), $eshop, $session->get('template_number'));
        
        $campaign = $recipient->getCampaign(); 
        $client = $recipient->getClient();
        $messageHtml = $session->get('email_message');
        $vendeur = $session->get('email_vendeur');
        $subject = $session->get('email_subject');
        $language = $session->get('email_language');
        $signature = $session->get('email_signature');

        if( $signature == null || $signature == "" ){
            $signature = "Votre boutique";
        }

        switch ($language){
            case 0 :
                $language = 'fr';
            break;
            case 1 :
                $language = 'en';
            break;
            default :
                $language = 'fr';
            break;
        }
        
        $setFooter = $this->get('app.set_email_footer');
        $footer = $setFooter->setEmailFooter($session->get('template_number'));

        $form = $this->createForm(new ValidationType());


        if ( $request->getMethod() == 'POST' ) {
            
            $now = new \DateTime();
            $dest = $recipient->getClient()->getEmail();

            $em->flush();

            $form->handleRequest($request);

            $data = $form->getData();

            # Outlook and gmail force the email user of From / Sender
            # Use gandi webmail instead
            $mailer_host = $this->getParameter("mailer_host_aws");
            $mailer_user = $this->getParameter("mailer_user_aws");
            $mailer_password = $this->getParameter("mailer_password_aws");

            $transport = \Swift_SmtpTransport::newInstance( $mailer_host, 587, 'tls' )
                        ->setUsername($mailer_user)
                        ->setPassword($mailer_password)
            ;

            //Create mailer with new Transport  credentials
            $mailer = \Swift_Mailer::newInstance($transport);

            $logger = new \Swift_Plugins_Loggers_ArrayLogger();
            $mailer->registerPlugin(new \Swift_Plugins_LoggerPlugin($logger));

            //Récupératiuon des liens
            /*$linksEm = $em->getRepository("AppBundle:Link")->findBy(array('campaign' => $recipient->getCampaign(), 'lang' => $session->get('email_language')));
            $linksId = array();
            $loop = 1;

            foreach ($linksEm as $key => $link) {
                $linksId[$loop] = $link->getId();
                $loop++;
            }*/
            
            //Setup message
            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                //->setFrom( array($user->getEmail() => "Jerome from") )
                //->setSender( array($user->getEmail() => "Jerome sender") )
                //->setFrom( array( $libelleBoutiqueRattachementEmail => $signature) )
                //->setSender( array( $libelleBoutiqueRattachementEmail => $signature) )
                ->setFrom( array( "j.rabahi@claravista.fr" => $signature) )
                //->setSender( array( "boutique.lancel@actions-pdv-l.fr" => $signature) )
                ->setReplyTo($libelleBoutiqueRattachementEmail)
                ->setTo($dest)
                //Adresse de retour pour les hard bounce
                #->setReturnPath("bounce@actions-pdv-l.fr")
                //->setTo("rabahi.jerome@gmail.com")
                ->setBody(
                    "Claravista Paris.",
                    'text/plain'
                )
                ->addPart(
                    $this->renderView(
                        // app/Resources/views/Emails/registration.html.twig
                        'AppBundle:Emails:demo.html.twig',
                        array(
                            'messageHtml'       => $messageHtml,
                            'vendeur'           => $vendeur,
                            'signature'         => $signature,
                            //'opera'             => $opera,
                            'footer'            => $footer,
                            'template_number'   => $session->get('template_number'),
                            //'linksId'           => $linksId,
                            //'now'               => $now,
                            //'campaignId'        => $recipient->getCampaign()->getIdCampaignName(),
                            //'clientId'          => $recipient->getClient()->getId(),
                        )
                    ),
                    'text/html'
                )
            ;

            $headers = $message->getHeaders();
            /*$headers->addPathHeader('X-Abuse-Reports-To', 'complaint@actions-pdv-l.fr');
            
            $headers->addPathHeader('Your-Header-Name', 'person@example.org');
                X-Abuse-Reports-To - abuse
                X-CSA-complaints - whitelist

            $headers->addTextHeader('X-Mine', 'something here');
            $headers->addParameterizedHeader(
                'Header-Name', ' header value'
              array('foo' => 'bar', 'foo2' => 'bar2')
            );

            var_dump($headers->get('Return-Path'));
            */
            $headers->addTextHeader('X-CampaignId', $recipient->getCampaign()->getIdCampaignName());
            
            $success = 1;

            //Try to send message and get exeption if fail
            try{
                $mailer->send($message);
            }
            catch(\Swift_TransportException $e){
                $success = 0;
                $response = $e->getMessage() ;
                $request->getSession()->getFlashBag()->add('notice', 'Erreur lors de l\'envoie de l\'email.');
                //var_dump($response); die();
            }

            //if message send is success update bdd
            if ($success) {

                $recipient->setContactedAt($now);
                $recipient->setLanguage($language);

                //si l'envoie est un succes et qu'on est admin alors on met à jour le flag d'envoie d'email pour ce recipient
                if($user->getLibelle() != "admin"){
                    $recipient->setIsEmailSent(true);
                }

                //persist inutile, Doctrine connait l'entité
                $em->flush();

                $session->remove('email_message');
                $session->remove('email_vendeur');
                $session->remove('email_language');
                $session->remove('email_subject');
                $session->remove('template_number');
                $session->remove('email_dest');
                $session->remove('email_signature');
                $session->remove('email_opera');

                $request->getSession()->getFlashBag()->add('success', 'Email envoyé à '.$recipient->getClient()->getFullName().' avec succès.');
                return $this->redirect($this->generateUrl('app_campaign_clients_list', array('campaign_id' => $recipient->getCampaign()->getId())));
            }
        }

        return $this->render('AppBundle:Campaign:viewValidateEmail.html.twig', array(
            'form'          => $form->createView(),
            'campaign'      => $campaign,
            'client'        => $client,
            'message'       => $messageHtml,
            //'opera'         => $opera, 
            'recipient'     => $recipient,
            //'session'   =>$_SESSION
            )
        );

    }

    /**
     * @ParamConverter("recipient", options={"mapping": {"recipient_id": "id"}})
     */
    public function PreviewEmailAction(Request $request)
    {
        $session = $request->getSession();
        $message = $session->get('email_message');

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        //$opera = $session->get('email_opera');

        $lang = $session->get('email_language');

        $vendeur = $session->get('email_vendeur');

        $template_number = $session->get('template_number');

        $signature = $session->get('email_signature');

        $setFooter = $this->get('app.set_email_footer');
        $footer = $setFooter->setEmailFooter($session->get('template_number'));       

        $data = $request->request->get('appbundle_send_email');
        /*$html = $this->renderView(
            'AppBundle:Emails:default.html.twig',
            array( 'message' => $message )
        );*/

        return $this->render('AppBundle:Campaign:previewEmail.html.twig', array(
            'messageHtml'       =>    $message,
            'signature'         =>    $signature,
            //'opera'             =>    $opera,
            'vendeur'           =>    $vendeur,
            'template_number'   =>    $template_number,
            'footer'            =>    $footer,
            )
        );
    }
}
