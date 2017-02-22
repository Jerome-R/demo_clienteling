<?php

namespace AppBundle\Controller;


// src/OC/PlatformBundle/Controller/AdvertController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Campaign;
use AppBundle\Entity\Client;
use AppBundle\Entity\Recipient;
use AppBundle\Entity\CampaignClient;
use Application\Sonata\UserBundle\Entity\User;
use AppBundle\Entity\ExportCsv;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

// Annotaitonss :
// Pour gérer les autorisations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
// Pour gérer le ParamConverter et utiliser un entité en parametre à la place d'une simple variable
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        if ($session->get('count_home') != null) {
            $count_home = $session->get('count_home') + 1;   
        }
        else{
            $count_home = 1;
        }

        $session->set('count_home', $count_home);

    	return $this->render('AppBundle:Home:index.html.twig', array(
                'count_home' => $count_home
            )
        );
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));*/
    }

    public function _impersonateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('ApplicationSonataUserBundle:User')->findBy(array());

        return $this->render('AppBundle::_impersonate.html.twig', array(
            'users' => $users
            )
        );
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));*/
    }

    public function _openAction($idClient, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('AppBundle::_open.html.twig', array(
            )
        );
    }

    //Monitoring
    public function _monitorAction($page, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb ->select("r")
            ->from('AppBundle:Recipient', 'r')
            ->where('r.user is null');

        //var_dump($qb->getDql());

        //$recipientsUser = $em->getRepository('AppBundle:Recipient')->findBy( array('user' => null), array('campaign' => 'ASC') );
        //Paginator : Pagination
        $recipientsUser  = $this
                ->get('knp_paginator')
                ->paginate(
                    $qb,
                    //$request->query->get('page', 1),//page number,
                    $page,
                    50//limit per page
        );

        $recipientsDataRecipient = $em->getRepository('AppBundle:Recipient')->findBy(array('dataRecipient' => null), array('campaign' => 'ASC'));

        return $this->render('AppBundle::_monitor.html.twig', array(
            'recipientsU' => $recipientsUser,
            'recipientsDR' => $recipientsDataRecipient,
            )
        );
    }

    public function logExportAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        $exports = $em->getRepository('AppBundle:ExportCsv')->findAll();
        

        return $this->render('AppBundle:Home:logExport.html.twig', array(
            'exports' => $exports
        ));
    }
    
    public function notFoundAction(Request $request)
    {   
        return $this->render('AppBundle:Home:not_found.html.twig', array(
            )
        );       
    }

}
