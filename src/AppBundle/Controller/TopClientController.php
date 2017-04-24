<?php

namespace AppBundle\Controller;


// src/OC/PlatformBundle/Controller/AdvertController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Campaign;
use AppBundle\Entity\Client;
use AppBundle\Entity\Recipient;
use AppBundle\Entity\ClientComment;
use AppBundle\Entity\DateImport;
use AppBundle\Entity\ExportCsv;

use ApplicationSonataUserBundle\Entity\User;

use AppBundle\Form\ClientsFilterType;
use AppBundle\Form\ClientCommentType;
use AppBundle\Form\DeleteCommentType;
use AppBundle\Form\EditCommentType;
use AppBundle\Form\ExportTopClientsType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

// Annotaitonss :
// Pour gérer les autorisations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
// Pour gérer le ParamConverter et utiliser un entité en parametre à la place d'une simple variable
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class TopClientController extends Controller
{
    public function indexAction(Request $request)
    {
        $date = new \DateTime();
        $date = $date->format('Ymd');

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();  

        $session = $request->getSession();

        //Mauvais argument, mais bug sinon, affiche tout les retails
        $dataRequest = $request->request->get('appbundle_clients_filter');

        //Utilisation du service clientFilter pour simplifier le code du contrôler et réutiliser le code ailleurs sans copier coller
        $clientFilterService = $this->container->get('app.client_filter');

        //Si le numero de page est dans la requete on le recupère
        if( isset($dataRequest['page']) )  {
            if ($dataRequest['page'] != null && $dataRequest['page'] > 0)
                $page = $dataRequest['page'];
            else 
                $page = 1;
        }
        else 
            $page = 1;

        //Set SQL query for export
        $sql = "SELECT tc.nom, tc.prenom, tc.email,tc.libelle_boutique_rattachement_topclient,tc.telephone1,tc.telephone2,tc.adresse1,tc.adresse2,tc.code_postal,tc.ville,tc.pays,tc.segment,tc.ca_3_ans,tc.ca_12_mois,tc.ca_histo,tc.prix_max_article_histo,tc.frequence_3_ans,tc.frequence_12_mois,tc.panier_moyen_histo,tc.date_1erachat,tc.date_dernier_achat FROM app_client AS tc ";

        //Init var
        $vars = $clientFilterService->initVars($user, $request);

        $local                              = $vars[0];
        $fullName                           = $vars[1];
        $filters                            = $vars[2];
        $libelleBoutiqueRattachement        = $vars[3];
        $dr                                 = $vars[4];
        $vendorCode                         = $vars[5];
        $rm                                 = $vars[6];

        //Création du Formulaire de filtre et remplissage si requête détecté.
        $form = $this->createForm(new ClientsFilterType($em, $user, $rm));
        $form->handleRequest($request); 

        //Creation du formulaire d'export CSV
        $form2 = $this->createForm(new ExportTopClientsType());
        $form2->handleRequest($request);       

        //Recuperation des données de la requete
        $data = $form->getData();
        
        //Récupération des données dans la requête
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
        if( isset($data['vendorCode']) )  {
            $vendorCode = $data['vendorCode'];
        }

        if ( $request->getMethod() == 'POST' ) {
            //Mise à jour des variable de session
            $clientFilterService->updateSessionVars($local,$fullName,$filters,$libelleBoutiqueRattachement,$dr,$vendorCode,$rm);
        }

        $options = array(
            'local'                         => $session->get('filtre_trigger_client_local_tc'),
            'fullname'                      => $session->get('filtre_trigger_client_fullname_tc'),
            'filters'                       => $session->get('filtre_trigger_client_filters_tc'),
            'libelleBoutiqueRattachement'   => $session->get('filtre_trigger_client_boutique_tc'),
            'dr'                            => $session->get('filtre_trigger_client_dr_tc'),
            'vendorCode'                    => "",
            'rm'                            => $session->get('filtre_trigger_client_RM_tc')       
        );

        //Recupération des toClients selon le role et les données du filtre
        if( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
            if ( $request->getMethod() == 'POST' ) {
                if( $session->get('filtre_trigger_client_boutique_tc') != '' ){
                    $libelleBoutiqueRattachement =  $session->get('filtre_trigger_client_boutique_tc');
                    $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheStore($options);
                    $csv_name = "".$libelleBoutiqueRattachement;
                    $sql .= "WHERE tc.is_topclient = 1 AND tc.libelle_boutique_rattachement_topclient = '$libelleBoutiqueRattachement' ";
                }
                elseif($session->get('filtre_trigger_client_RM_tc') != '' ){
                    $rm = $session->get('filtre_trigger_client_RM_tc');
                    $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheRm($options);
                    $csv_name =  "".$rm;
                    $sql .= "LEFT JOIN fos_user_user AS u ON u.libelle = tc.libelle_boutique_rattachement_topclient WHERE u.retail_manager = '$rm' AND tc.is_topclient = 1 ";
                }
                else{  
                    $findTopClients = $em->getRepository('AppBundle:Client')->getAllTopClients($options);
                    $sql .= "WHERE tc.is_topclient = 1 ";
                    $csv_name = "";
                }
            }
            else{
                if( $session->get('filtre_trigger_client_boutique_tc') != '' ){
                    $libelleBoutiqueRattachement =  $session->get('filtre_trigger_client_boutique_tc');
                    $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheStore($options);
                    $csv_name = "".$libelleBoutiqueRattachement;
                    $sql .= "WHERE tc.is_topclient = 1 AND tc.libelle_boutique_rattachement_topclient = '$libelleBoutiqueRattachement' ";
                }
                elseif($session->get('filtre_trigger_client_RM_tc') != '' ){
                    $rm = $session->get('filtre_trigger_client_RM_tc');
                    $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheRm($options);
                    $csv_name =  "".$rm;
                    $sql .= "LEFT JOIN fos_user_user AS u ON u.libelle = tc.libelle_boutique_rattachement_topclient WHERE u.retail_manager = '$rm' AND tc.is_topclient = 1 ";
                }
                else{
                    $findTopClients = $em->getRepository('AppBundle:Client')->getAllTopClients($options);
                    $sql .= "WHERE tc.is_topclient = 1 ";
                    $csv_name = "";
                }
            }
        }
        elseif( $user->getRole() == 'ROLE_RETAIL_MANAGER' ) {
            if ( $request->getMethod() == 'POST' ) {

                    if( $session->get('filtre_trigger_client_boutique_tc') != '' ){
                        $libelleBoutiqueRattachement =  $session->get('filtre_trigger_client_boutique_tc');
                        $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheStore($options);
                        $csv_name = "".$libelleBoutiqueRattachement;
                        $sql .= "WHERE tc.is_topclient = 1 AND tc.libelle_boutique_rattachement_topclient = '$libelleBoutiqueRattachement' ";
                    }
                    else{
                        $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheRm($options);
                        $csv_name =  "".$user->getLibelle();
                        $sql .= "LEFT JOIN fos_user_user AS u ON u.libelle = tc.libelle_boutique_rattachement_topclient WHERE u.retail_manager = '$rm' AND tc.is_topclient = 1 ";
                    }
            }
            else{
                if( $session->get('filtre_trigger_client_boutique_tc') != '' ){
                    $libelleBoutiqueRattachement =  $session->get('filtre_trigger_client_boutique_tc');
                    $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheStore($options);
                    $csv_name = "".$libelleBoutiqueRattachement;
                    $sql .= "WHERE tc.is_topclient = 1 AND tc.libelle_boutique_rattachement_topclient = '$libelleBoutiqueRattachement' ";
                }
                else{
                    $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheRm($options);
                    $csv_name =  "".$user->getLibelle();
                    $sql .= "LEFT JOIN fos_user_user AS u ON u.libelle = tc.libelle_boutique_rattachement_topclient WHERE u.retail_manager = '$rm' AND tc.is_topclient = 1 ";
                }
            }
        }
        elseif( $user->getRole() == 'ROLE_DIRECTEUR' ) {
            
            if ( $request->getMethod() == 'POST' ) {
                if( $session->get('filtre_trigger_client_boutique_tc') != '' ){
                    $libelleBoutiqueRattachement =  $session->get('filtre_trigger_client_boutique_tc');
                    $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheStore($options);
                    $csv_name = "".$user->getLibelle();
                    $sql .= "WHERE tc.is_topclient = 1 AND tc.libelle_boutique_rattachement_topclient = '$libelleBoutiqueRattachement' ";
                }
                else{
                    $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheDirector($options);
                    $csv_name = "".$user->getLibelle();
                    $sql .= "LEFT JOIN fos_user_user AS u ON u.libelle = tc.libelle_boutique_rattachement_topclient WHERE u.directeur = '$dr' AND tc.is_topclient = 1 ";
                }
            }
            else{
                if( $session->get('filtre_trigger_client_boutique_tc') != '' ){
                    $libelleBoutiqueRattachement =  $session->get('filtre_trigger_client_boutique_tc');
                    $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheStore($options);
                    $csv_name = "".$libelleBoutiqueRattachement;
                    $sql .= "WHERE tc.is_topclient = 1 AND tc.libelle_boutique_rattachement_topclient = '$libelleBoutiqueRattachement' ";
                }
                else {
                    $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheDirector($options);
                    $csv_name = "".$user->getLibelle();
                    $sql .= "LEFT JOIN fos_user_user AS u ON u.libelle = tc.libelle_boutique_rattachement_topclient WHERE u.directeur = '$dr' AND tc.is_topclient = 1 ";
                }
            }
        }
        else {
            $findTopClients = $em->getRepository('AppBundle:Client')->getTopClientsOfTheStore($options);            
            $csv_name = "".$user->getLibelle();
            $sql .= "WHERE tc.is_topclient = 1 AND tc.libelle_boutique_rattachement_topclient = '$libelleBoutiqueRattachement' ";
        }

        //Mise à jour de la requête SQL en fonction de la valeur du topClient Lacal et ORDER
        if ($local != null ||  $local != ''){
            $sql .= "AND tc.local = '$local' ";
        }
        if ($fullName != null ||  $fullName != ''){
            $name = explode( " ", $fullName);

            foreach ($name as $key => $val) {
                $sql .= " AND (tc.prenom LIKE '%$val%' OR tc.nom LIKE '%$val%') ";
            }            
        }
        if ($vendorCode != null ||  $vendorCode != ''){
            $sql .= " AND tc.codeVendeur = '$vendorCode' ";
        }

        if ($filters != null ||  $filters != '') {
            foreach ($filters as $key => $option) {

                switch($option) {
                    case 'inactif' :
                        $dateInactif = date("Y-m-d", strtotime("-6 months"));
                        $sql .= ' AND tc.date_dernier_achat < "'.$dateInactif.'" ' ;
                        ;
                    break;
                    case 'actif' :
                        $dateInactif = date("Y-m-d", strtotime("-6 months"));
                        $sql .= ' AND tc.date_dernier_achat > "'.$dateInactif.'" ' ;
                        ;
                    break;
                    case 'top' :
                        $sql .= ' AND tc.ca3ans > 1635 ' ;
                        ;
                    break;
                    case 'optin' :
                        $sql .= ' AND (tc.optin = "Oui" OR tc.optin = "In" OR tc.optin = "IN") ' ;
                        ;
                    break;
                    case 'newClient' :
                        $oneTimer = "%One-timer%";
                        $sql .= ' AND tc.date_dernier_achat LIKE "%One-timer%"" ' ;
                        ;
                    break;
                }           
            }
        }

        $sql .= "ORDER BY tc.ca_3_ans DESC";

        //stockage de la requete en session pour le submit du form2
        if (!$form2->isSubmitted()) {
            //On créer la variable uniquement si on a pas submit le form2
            $session->set('topcliente_sql', $sql);
        }
        
        //Paginator : Pagination
        $topClients  = $this
                ->get('knp_paginator')
                ->paginate(
                    $findTopClients,
                    //$request->query->get('page', 1),//page number,
                    $page,
                    50//limit per page
        );
        //Download CSV file
        if ($form2->isSubmitted()) {
            //Creation du fichier CSV et du header
            $handle     = fopen('php://memory', 'r+');
            $header     = array('Nom ','Prénom','Email', 'Libelle Boutique de Rattachement','Téléphone 1','Téléphone 2','Adresse','Complément','Code postal','Ville','Pays','Segment','CA 3 ans','Ca 12 mois','CA Histo','Prix max','Fréquence 3 ans','Fréquence 12 mois','Panier Moyen ','Date premier achat ','Date dernier achat');            

            //Creation de l'entête du fichier pour être lisible dans Exel
            fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            fputcsv($handle, $header, ';');

            //Initialisation de la connection à la BDD            
            $pdo = $this->container->get('app.pdo_connect');
            $pdo = $pdo->initPdoClienteling();

            //Préparation et execution de la requête
            //var_dump($sql);
            $stmt = $pdo->prepare($session->get('topcliente_sql'));
            $stmt->execute();

            //Remplissage du fichier csv.
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $row["code_postal"] = '="'.$row["code_postal"].'"';
                $row["telephone1"] = '="'.$row["telephone1"].'"';
                $row["telephone2"] = '="'.$row["telephone2"].'"';
                fputcsv($handle, $row, ';');
            }

            //Fermeture du fichier
            rewind($handle);
            $content = stream_get_contents($handle);
            fclose($handle);

            $export = new ExportCsv();
            $export->setUser($user->getId());
            $export->setCreatedAt(new \DateTime());
            $export->setRequest($session->get('topcliente_sql'));

            $em->persist($export);
            $em->flush();

            //suppression de la variable de session
            //$session->remove('topcliente_sql');
            
            //Reponse : Téléchargement du fichier
            return new Response($content, 200, array(
                'Content-Type' => 'application/force-download; text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="export_top_client_'.$csv_name.'_'.$date.'.csv"'
            ));

        }

        $dateImport = $em->getRepository("AppBundle:DateImport")->findBy(array("module" => "top_clients"), array("id" => "DESC"), 1);

        //Update form values
        $form = $clientFilterService->updateForm($user, $request, $form);

        // replace this example code with whatever you need
        return $this->render('AppBundle:TopClient:index.html.twig', array(
            'topClients'    => $topClients,
            'form'          => $form->createView(),
            'form2'         => $form2->createView(),
            'dateImport'    => $dateImport[0],
            'session'       => $_SESSION
            )
        );
    }

    /**
     * @ParamConverter("topClient", options={"mapping": {"top_client_id": "id"}})
     */
    public function viewTopClientAction(Client $topClient, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();

        $isAuthorized = $this->get('app.is_authorized_client')->isAuthorized($user, $topClient, "topclient", null);

        if( !$isAuthorized )
        {
             throw new AccessDeniedHttpException();
        }

        $topClient = $em->getRepository('AppBundle:Client')->findOneBy( array('id' => $topClient->getId()) );

        $form = $this->createForm(new ClientCommentType());
        //$form2 = $this->createForm(new DeleteCommentType());
        $form->handleRequest($request);

        $form3 = array();
        $form3view = array();

        if($form->isSubmitted() ) {            
            $data = $request->request->get('appbundle_client_comment');

            $comment = new ClientComment();
            $comment->setClient($topClient);
            $comment->setAuthor($user->getLibelle());
            $comment->setIdClient($topClient->getIdClient());
            $comment->setComment($data['comment']);

            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('app_top_client_view', array('top_client_id' => $topClient->getId()));
        }

        $comments = $em->getRepository('AppBundle:ClientComment')->findBy( array('client' => $topClient), array('id' => 'desc'), 10 );

        foreach ($comments as $key => $comment) {
            $form3[$key] = $this->createForm( new EditCommentType($key), $comment);
            $form3[$key]->handleRequest($request);
            $form3view[$key] = $form3[$key]->createView();
        }

        foreach ($form3 as $key => $editCommentForm) {
            if($editCommentForm->isSubmitted() ) {            

                $em->flush();

                return $this->redirectToRoute('app_top_client_view', array('top_client_id' => $topClient->getId()));
            }
        }

        $year = new \DateTime();
        $year = intval($year->format('Y'));
        $limite = 2006;

        $panels = array();
        $years = array();
        $key = 0;

        for($i = $year; $i >= $limite; $i--){   
            $tickets = $em->getRepository('AppBundle:Ticket')->getTicketsOfYear($topClient, $i);        
            $panels[] = $tickets;
            if( empty($panels[$key]) ) {
                unset($panels[$key]);
            }            
            $key++;
        }

        foreach ($panels as $key => $panel) {
            $dateFacture = $panel[0]->getDateFacture();
            $years[] = $dateFacture->format('Y');
        }

        return $this->render('AppBundle:TopClient:viewTopClient.html.twig', array(  
            'topClient'     => $topClient,
            'comments'      => $comments,
            'panels'        => $panels,
            'years'         => $years,
            'form'          => $form->createView(),
            //'form2'         => $form2->createView(),
            'form3'         => $form3view
            )
        );
    }

    /**
     * @ParamConverter("clientComment", options={"mapping": {"client_comment_id": "id"}})
     */
    public function deleteCommentAction(ClientComment $clientComment)
    {
        //if($request->getMethod() == 'POST'){
            $id = $clientComment->getClient()->getId();
            $em = $this->getDoctrine()->getManager();

            $em->remove($clientComment);
            $em->flush();

            return $this->redirectToRoute('app_top_client_view', array('top_client_id' => $id));
        //}
    }
    
}