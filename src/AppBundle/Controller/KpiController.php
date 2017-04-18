<?php

namespace AppBundle\Controller;


// src/OC/PlatformBundle/Controller/AdvertController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Application\Sonata\UserBundle\Entity\User;
use AppBundle\Entity\KpiCapture;
use AppBundle\Entity\KpiTrigger;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use AppBundle\Form\KpiFilterType;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

// Annotaitonss :
// Pour gérer les autorisations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
// Pour gérer le ParamConverter et utiliser un entité en parametre à la place d'une simple variable
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class KpiController extends Controller
{
	public function monthLocauxAction(Request $request) {
		$em = $this->getDoctrine()->getManager();
		$user = $this->get('security.context')->getToken()->getUser(); 

		$session = $request->getSession();

		
		if($user->getRole() == 'ROLE_RETAIL_MANAGER'){
			$firstboutique = $user;
		}
		elseif($user->getRole() == 'ROLE_DIRECTEUR'){
			$firstboutique = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('directeur' => $user->getLibelle(), 'role' => "ROLE_BOUTIQUE"), array('libelle' => 'ASC'));
		}

		if($session->get('kpi_boutique_filtre') == null) {
			if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
				$lastKpiCapture = $em->getRepository('AppBundle:KpiCapture')->findOneBy(array('niveau' => "TOT"), array('date' => "DESC"));
			}
			else{
				$lastKpiCapture = $em->getRepository('AppBundle:KpiCapture')->findOneBy(array('libelle' => $firstboutique->getLibelle()), array('date' => "DESC"));
			}
		}
		else{
			$lastKpiCapture = $em->getRepository('AppBundle:KpiCapture')->findOneBy(array('libelle' => $session->get('kpi_boutique_filtre')), array('date' => "DESC"));
		}

		$date = $lastKpiCapture->getDate();

		//la derniere date est toujours celle du dernier kpicapture en base, la premiere varie de -12 à -24 mois
		//Affichage des données du dernier mois / mois selectionné : du premier à la fin du mois.
		//On test aussi les var de session month et year, car par defaut pour TOT la valeur est a null
		if($session->get('kpi_boutique_filtre') == null && $session->get('kpi_month_filtre') == null && $session->get('kpi_year_filtre') == null) {

			$month = $date->format('m');
			$year = $date->format('Y');

			$date2 = new \DateTime($date->format('Y-m-d'));
			$date2->modify('last day of this month');
			$date2 = $date2->format("Y-m-d");
		}
		//si on a une recherche active
		else{
			$month = $session->get('kpi_month_filtre');
			$year = $session->get('kpi_year_filtre');

			$date2 = $date2 = new \DateTime($year."-".$month."-01");
			$date2->modify('last day of this month');
			$date2 = $date2->format("Y-m-d");

			$date_check = new \DateTime($date2);
			if($date_check > $date) {
				$month = $date->format('m');
				$year = $date->format('Y');
				$session->set('kpi_month_filtre', $month);
				$session->set('kpi_year_filtre', $year);

				$date2 = new \DateTime($date->format('Y-m-d'));
				$date2->modify('last day of this month');
				$date2 = $date2->format("Y-m-d");
			}
		}


		$date1 = new \DateTime($date2);
		$date1->modify('-12 months')->modify('first day of this month');
		$date1 = $date1->format("Y-m-d");

		$form = $this->createForm(new KpiFilterType($em, $user, $month, $year));
        $form->handleRequest($request);        

        $data = $form->getData();

		$lastKpiCapture = null;

		//Get archives data
		if ( $request->getMethod() == 'POST' ) {

			//Set Session variable
			if($data['boutique'] == null ){
				$session->remove('kpi_boutique_filtre');
			}
			else{
				$session->set('kpi_boutique_filtre', $data['boutique']->getLibelle());
			}
			if($data['year'] == '' ){
				$session->remove('kpi_year_filtre');
			}
			else{
				$session->set('kpi_year_filtre', $data['year']);
			}
			if($data['month'] == '' ){
				$session->remove('kpi_month_filtre');
			}
			else{
				$session->set('kpi_month_filtre', $data['month']);
			}

			$month = $data['month'];
			$year = $data['year'];

			$date2 = $date2 = new \DateTime($year."-".$month."-01");
			$date2->modify('last day of this month');
			$date2 = $date2->format("Y-m-d");

			//vérification si date > à la dernière ligne en base
			$date_check = new \DateTime($date2);
			if($date_check > $date) {
				$month = $date->format('m');
				$year = $date->format('Y');
				$session->set('kpi_month_filtre', $data['month']);
				$session->set('kpi_year_filtre', $data['year']);

				$date2 = new \DateTime($date->format('Y-m-d'));
				$date2->modify('last day of this month');
				$date2 = $date2->format("Y-m-d");
			}else{
				$month = $data['month'];
				$year = $data['year'];

				$date2 = $date2 = new \DateTime($year."-".$month."-01");
				$date2->modify('last day of this month');
				$date2 = $date2->format("Y-m-d");
			}
			
			$date1 = new \DateTime($date2);
			$date1->modify('-12 months')->modify('first day of this month');
			$date1 = $date1->format("Y-m-d");


			if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
				if( $session->get('kpi_boutique_filtre') == null ){
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpisBetweenDatesSiege("TOT", $date1, $date2);
				}
				else{
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpisBetweenDatesSiegeBtq($session->get('kpi_boutique_filtre'), $date1, $date2);
				}				
			}
			elseif ( $user->getRole() == 'ROLE_RETAIL_MANAGER' ) {
				if( $session->get('kpi_boutique_filtre') == null ){
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpisBetweenDatesSiegeBtq($user->getLibelle(), $date1, $date2);
				}
				else{;
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpisBetweenDatesSiegeBtq($session->get('kpi_boutique_filtre'), $date1, $date2);
				}				
			}
			else{
				if($session->get('kpi_boutique_filtre') == null ){
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpisBetweenDatesBtq($date1, $date2, $firstboutique->getLibelle());
				}
				else{
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpisBetweenDatesBtq($date1, $date2,$session->get('kpi_boutique_filtre'));
				}	
			}
		}
		else{
			if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
				if ($session->get('kpi_boutique_filtre') == null) {
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpisBetweenDatesSiege("TOT", $date1, $date2);
				}
				else{
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpisBetweenDatesSiegeBtq($session->get('kpi_boutique_filtre'), $date1, $date2);
				}
			}
			else {
				if($session->get('kpi_boutique_filtre') == null ){
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpisBetweenDatesBtq($date1, $date2, $firstboutique->getLibelle());
				}
				else{
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpisBetweenDatesBtq($date1, $date2,$session->get('kpi_boutique_filtre'));
				}
			}
		}

		$kpiCurrentMonth = null;
		$currentMonth = null;

		foreach ($kpis as $key => $kpi) {
			if ( $key == 0 ) {
				$currentMonth = $kpi->getDate()->format("m");
				$kpiCurrentMonth = $kpi;
			}
		}


		if( $kpiCurrentMonth != null){
			/*$lastYearDate = $kpiCurrentMonth->getDate();
			$lastYear = $lastYearDate->format("Y")-1;
			$lastYearDateStart = $lastYear."-".$month."-01";

			if($month == 12){
				$lastYearDateEnd = ($lastYear + 1)."-01-01";
			}
			else
			{
				$lastYearDateEnd = $lastYear."-".($month+1)."-01";
			}*/
			$date3 = new \DateTime($date1);
			$date4 = new \DateTime($date2);
			$date3->modify("-12 months")->modify('first day of this month');
			$date4->modify("-12 months")->modify('last day of this month');
			$date3 = $date3->format("Y-m-d");
			$date4 = $date4->format("Y-m-d");

			$kpiLastYear = $em->getRepository('AppBundle:KpiCapture')->getUserKpiLastYear($date3, $date4, $kpiCurrentMonth->getCodeBoutiqueVendeur());
		}
		else{
			$kpiLastYear = null;
		}

        if($session->get('kpi_boutique_filtre') != null && $request->getMethod() == 'GET'){
        	$form->get('boutique')->setData($em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('libelle' => $session->get('kpi_boutique_filtre'))));
        	$form->get('year')->setData($year);
        	$form->get('month')->setData($month);
        }



        return $this->render('AppBundle:Kpi:month.html.twig', array(
        	'kpis' 				=> $kpis,
        	'kpiCurrentMonth' 	=> $kpiCurrentMonth,
        	'kpiLastYear' 		=> $kpiLastYear,
        	'month'				=> $month,
        	'currentMonth'		=> $currentMonth,
        	'user'				=> $user,
        	'form'          	=> $form->createView(),
        	)
        );
	}

	public function ytdLocauxAction(Request $request) {
		$em = $this->getDoctrine()->getManager();
		$user = $this->get('security.context')->getToken()->getUser(); 

		$session = $request->getSession();

		if($user->getRole() == 'ROLE_RETAIL_MANAGER'){
			$firstboutique = $user;
		}

		if($user->getRole() == 'ROLE_DIRECTEUR'){
			$firstboutique = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('directeur' => $user->getLibelle(), 'role' => "ROLE_BOUTIQUE"), array('libelle' => 'ASC'));
		}

		if($session->get('kpi_boutique_filtre') == null) {
			if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
				$lastKpiCapture = $em->getRepository('AppBundle:KpiCapture')->findOneBy(array('niveau' => "TOT"), array('date' => "DESC"));
			}
			else{
				$lastKpiCapture = $em->getRepository('AppBundle:KpiCapture')->findOneBy(array('libelle' => $firstboutique->getLibelle()), array('date' => "DESC"));
			}
		}
		else{
			$lastKpiCapture = $em->getRepository('AppBundle:KpiCapture')->findOneBy(array('libelle' => $session->get('kpi_boutique_filtre')), array('date' => "DESC"));
		}

		$date = $lastKpiCapture->getDate();

		//la derniere date est toujours celle du dernier kpicapture en base, la premiere varie de -12 à -24 mois
		//Affichage des données du dernier mois / mois selectionné de l'année en cours de puis le début de l'année
		if($session->get('kpi_boutique_filtre') == null && $session->get('kpi_month_filtre') == null && $session->get('kpi_year_filtre') == null) {

			$month = $date->format('m');
			$year = $date->format('Y');

			$date2 = new \DateTime($date->format('Y-m-d'));
			$date2->modify('last day of this month');
			$date2 = $date2->format("Y-m-d");
		}
		//si on a une recherche active
		else{
			$month = $session->get('kpi_month_filtre');
			$year = $session->get('kpi_year_filtre');

			$date2 = $date2 = new \DateTime($year."-".$month."-01");
			$date2->modify('last day of this month');
			$date2 = $date2->format("Y-m-d");

			$date_check = new \DateTime($date2);
			if($date_check > $date) {
				$month = $date->format('m');
				$year = $date->format('Y');
				$session->set('kpi_month_filtre', $month);
				$session->set('kpi_year_filtre', $year);

				$date2 = new \DateTime($date->format('Y-m-d'));
				$date2->modify('last day of this month');
				$date2 = $date2->format("Y-m-d");
			}
		}


		$date1 = new \DateTime($date2);
		$date1->modify('-12 months')->modify('first day of this month');
		$date1 = $date1->format("Y-m-d");

		$form = $this->createForm(new KpiFilterType($em, $user, $month, $year));
        $form->handleRequest($request);        

        $data = $form->getData();
		$lastKpiCapture = null;

		$form = $this->createForm(new KpiFilterType($em, $user, $month, $year));
        $form->handleRequest($request);        

        $data = $form->getData();

        if ( $request->getMethod() == 'POST' ) {
        	if($data['boutique'] == '' ){
				$session->remove('kpi_boutique_filtre');
			}
			else{
				$session->set('kpi_boutique_filtre', $data['boutique']->getLibelle());
			}

			if($data['year'] == '' ){
				$session->remove('kpi_year_filtre');
			}
			else{
				$session->set('kpi_year_filtre', $data['year']);
			}
			if($data['month'] == '' ){
				$session->remove('kpi_month_filtre');
			}
			else{
				$session->set('kpi_month_filtre', $data['month']);
			}

			$month = $data['month'];
			$year = $data['year'];

			$date2 = $date2 = new \DateTime($year."-".$month."-01");
			$date2->modify('last day of this month');
			$date2 = $date2->format("Y-m-d");

			//vérification si date > à la dernière ligne en base
			$date_check = new \DateTime($date2);
			if($date_check > $date) {
				$month = $date->format('m');
				$year = $date->format('Y');
				$session->set('kpi_month_filtre', $data['month']);
				$session->set('kpi_year_filtre', $data['year']);

				$date2 = new \DateTime($date->format('Y-m-d'));
				$date2->modify('last day of this month');
				$date2 = $date2->format("Y-m-d");
			}
			
			$date1 = new \DateTime($date2);
			$date1->modify('-12 months')->modify('first day of this month');
			$date1 = $date1->format("Y-m-d");

			//Get archives data
			if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
				if ($session->get('kpi_boutique_filtre') == null) {
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpiYtdSiege("global", $date1, $date2);
				}
				else{
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpiYtd($session->get('kpi_boutique_filtre'), $date1, $date2);
				}					
			}
			elseif ( $user->getRole() == 'ROLE_RETAIL_MANAGER' ) {
				if( $session->get('kpi_boutique_filtre') == null ){
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpiYtd($user->getLibelle(), $date1, $date2);
				}
				else{
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpiYtd( $session->get('kpi_boutique_filtre'), $date1, $date2);
				}				
			}
			else{
				if ($session->get('kpi_boutique_filtre') == null) {
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpiYtd($firstboutique->getLibelle(), $date1, $date2);
				}
				else{
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpiYtd($session->get('kpi_boutique_filtre'), $date1, $date2);
				}				
			}		
		}
		else{
			//Get archives data
			if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
				if ($session->get('kpi_boutique_filtre') == null) {
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpiYtdSiege("global", $date1, $date2);
				}
				else{
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpiYtd( $session->get('kpi_boutique_filtre'), $date1, $date2);
				}
			}
			else{
				if ($session->get('kpi_boutique_filtre') == null) {
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpiYtd($firstboutique->getLibelle(), $date1, $date2);
				}
				else{
					$kpis = $em->getRepository('AppBundle:KpiCapture')->getUserKpiYtd($session->get('kpi_boutique_filtre'), $date1, $date2);
				}	
			}	
		}

		if($kpis != null){
			$dateKpi = $kpis->getDate();
			$dateKpi = $dateKpi->format('Y-m-d');

			$date3 = new \DateTime($dateKpi);
			$date4 = new \DateTime($dateKpi);
			$date3->modify("-12 months")->modify('first day of this month');
			$date4->modify("-12 months")->modify('last day of this month');
			$date3 = $date3->format("Y-m-d");
			$date4 = $date4->format("Y-m-d");

			$kpiLastYear = $em->getRepository('AppBundle:KpiCapture')->getUserKpiLastYear($date3, $date4, $kpis->getCodeBoutiqueVendeur());	
		}
		else {
			$kpiLastYear = null;
		}

        if($session->get('kpi_boutique_filtre') != null && $request->getMethod() == 'GET'){
        	$form->get('boutique')->setData($em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('libelle' => $session->get('kpi_boutique_filtre'))));
        	$form->get('year')->setData($year);
        	$form->get('month')->setData($month);
        }

        return $this->render('AppBundle:Kpi:ytd.html.twig', array(
        	'dateYear'			=> $year,
        	'currentYear'		=> $year,
        	'kpiLastYear' 		=> $kpiLastYear,
        	'user'				=> $user,
        	'month'				=> $month,
        	'kpiCurrentYear'	=> $kpis,
        	'form'          	=> $form->createView(),
        	)
        );
	}


	public function triggerAction($month = null, Request $request) {

		$em = $this->getDoctrine()->getManager();
		$user = $this->get('security.context')->getToken()->getUser(); 

		$session = $request->getSession();

		if($user->getRole() == 'ROLE_RETAIL_MANAGER'){
			$firstboutique = $user;
		}

		if($user->getRole() == 'ROLE_DIRECTEUR'){
			$firstboutique = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('directeur' => $user->getLibelle(), 'role' => "ROLE_BOUTIQUE"), array('libelle' => 'ASC'));
		}

		if($session->get('kpi_boutique_filtre') == null) {
			if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
				$lastKpiCapture = $em->getRepository('AppBundle:KpiCapture')->findOneBy(array('niveau' => "TOT"), array('date' => "DESC"));
			}
			else{
				$lastKpiCapture = $em->getRepository('AppBundle:KpiCapture')->findOneBy(array('libelle' => $firstboutique->getLibelle()), array('date' => "DESC"));
			}
		}
		else{
			$lastKpiCapture = $em->getRepository('AppBundle:KpiTrigger')->findOneBy(array('libelle' => $session->get('kpi_boutique_filtre')), array('date' => "DESC"));
		}

		$date = $lastKpiCapture->getDate();

		//la derniere date est toujours celle du dernier kpicapture en base, la premiere varie de -12 à -24 mois
		if($session->get('kpi_boutique_filtre') == null) {

			$month = $date->format('m');
			$year = $date->format('Y');

			$date2 = new \DateTime($date->format('Y-m-d'));
			$date2->modify('last day of this month');
			$date2 = $date2->format("Y-m-d");
		}
		//si on a une recherche active
		else{
			$month = $session->get('kpi_month_filtre');
			$year = $session->get('kpi_year_filtre');

			$date2 = $date2 = new \DateTime($year."-".$month."-01");
			$date2->modify('last day of this month');
			$date2 = $date2->format("Y-m-d");

			$date_check = new \DateTime($date2);
			if($date_check > $date) {
				$month = $date->format('m');
				$year = $date->format('Y');
				$session->set('kpi_month_filtre', $month);
				$session->set('kpi_year_filtre', $year);

				$date2 = new \DateTime($date->format('Y-m-d'));
				$date2->modify('last day of this month');
				$date2 = $date2->format("Y-m-d");
			}
		}


		$date1 = new \DateTime($date2);
		$date1->modify('first day of this month');
		$date1 = $date1->format("Y-m-d");

		$lastKpiTrigger = null;

        $session = $request->getSession();

		$form = $this->createForm(new KpiFilterType($em, $user, $month, $year));
        $form->handleRequest($request);        

        $data = $form->getData();

		if ( $request->getMethod() == 'POST' ) {
        	if($data['boutique'] == '' ){
				$session->remove('kpi_boutique_filtre');
			}
			else{
				$session->set('kpi_boutique_filtre', $data['boutique']->getLibelle());
			}

			if($data['year'] == '' ){
				$session->remove('kpi_year_filtre');
			}
			else{
				$session->set('kpi_year_filtre', $data['year']);
			}
			if($data['month'] == '' ){
				$session->remove('kpi_month_filtre');
			}
			else{
				$session->set('kpi_month_filtre', $data['month']);
			}

			$month = $data['month'];
			$year = $data['year'];

			$date2 = $date2 = new \DateTime($year."-".$month."-01");
			$date2->modify('last day of this month');
			$date2 = $date2->format("Y-m-d");

			//vérification si date > à la dernière ligne en base
			$date_check = new \DateTime($date2);
			if($date_check > $date) {
				$month = $date->format('m');
				$year = $date->format('Y');
				$session->set('kpi_month_filtre', $data['month']);
				$session->set('kpi_year_filtre', $data['year']);

				$date2 = new \DateTime($date->format('Y-m-d'));
				$date2->modify('last day of this month');
				$date2 = $date2->format("Y-m-d");
			}
			
			$date1 = new \DateTime($date2);
			$date1->modify('first day of this month');
			$date1 = $date1->format("Y-m-d");

			if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
				if ($session->get('kpi_boutique_filtre') == null) {
					$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthGlobal($date1, $date2);
					$kpiTriggersMonthVDR = null;
				}
				else{
					if( in_array( $session->get('kpi_boutique_filtre'), array( "IDF", "Sud Est", "Sud Ouest", "Nord Est", "Nord Ouest" ) )){
						$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthRM($date1, $date2, $session->get('kpi_boutique_filtre'));
						$kpiTriggersMonthVDR = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthVDR($date1, $date2, $session->get('kpi_boutique_filtre'));
					}
					else{
						$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonth($date1, $date2, $session->get('kpi_boutique_filtre'));
						$kpiTriggersMonthVDR = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthVDR($date1, $date2, $session->get('kpi_boutique_filtre'));
					}
				}
			}
			elseif ( $user->getRole() == 'ROLE_RETAIL_MANAGER' ) {
				if ($session->get('kpi_boutique_filtre') == null) {
					$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthRM($date1, $date2, $user->getLibelle());
					$kpiTriggersMonthVDR = null;
				}
				else{
					if( in_array( $session->get('kpi_boutique_filtre'), array( "IDF", "Sud Est", "Sud Ouest", "Nord Est", "Nord Ouest" ) )){
						$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthRM($date1, $date2, $session->get('kpi_boutique_filtre'));
						$kpiTriggersMonthVDR = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthVDR($date1, $date2, $session->get('kpi_boutique_filtre'));
					}
					else{
						$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonth($date1, $date2, $session->get('kpi_boutique_filtre'));
						$kpiTriggersMonthVDR = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthVDR($date1, $date2, $session->get('kpi_boutique_filtre'));
					}
				}
			}
			else {
				if ($session->get('kpi_boutique_filtre') == null) {
					$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonth($date1, $date2, $firstboutique);
					$kpiTriggersMonthVDR = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthVDR($date1, $date2, $firstboutique->getLibelle());
				}
				else{
					$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonth($date1, $date2, $session->get('kpi_boutique_filtre'));
					$kpiTriggersMonthVDR = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthVDR($date1, $date2, $session->get('kpi_boutique_filtre'));
				}
			}
		}
		else {
			if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
				if ($session->get('kpi_boutique_filtre') == null) {
					$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthGlobal($date1, $date2);
					$kpiTriggersMonthVDR = null;
				}
				else{
					if( in_array( $session->get('kpi_boutique_filtre'), array( "IDF", "Sud Est", "Sud Ouest", "Nord Est", "Nord Ouest" ) )){
						$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthRM($date1, $date2, $session->get('kpi_boutique_filtre'));
						$kpiTriggersMonthVDR = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthVDR($date1, $date2, $session->get('kpi_boutique_filtre'));
					}
					else{
						$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonth($date1, $date2, $session->get('kpi_boutique_filtre'));
						$kpiTriggersMonthVDR = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthVDR($date1, $date2, $session->get('kpi_boutique_filtre'));
					}
				}
			}
			elseif ( $user->getRole() == 'ROLE_RETAIL_MANAGER' ) {
				if ($session->get('kpi_boutique_filtre') == null) {
					$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthRM($date1, $date2, $user->getLibelle());
					$kpiTriggersMonthVDR = null;
				}
				else{
					if( in_array( $session->get('kpi_boutique_filtre'), array( "IDF", "Sud Est", "Sud Ouest", "Nord Est", "Nord Ouest" ) )){
						$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthRM($date1, $date2, $session->get('kpi_boutique_filtre'));
						$kpiTriggersMonthVDR = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthVDR($date1, $date2, $session->get('kpi_boutique_filtre'));
					}
					else{
						$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonth($date1, $date2, $session->get('kpi_boutique_filtre'));
						$kpiTriggersMonthVDR = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthVDR($date1, $date2, $session->get('kpi_boutique_filtre'));
					}
				}
			}
			else {
				if ($session->get('kpi_boutique_filtre') == null) {
					$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonth($date1, $date2, $firstboutique);
					$kpiTriggersMonthVDR = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthVDR($date1, $date2, $firstboutique->getLibelle());
				}
				else{
					$kpiTriggersMonth = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonth($date1, $date2, $session->get('kpi_boutique_filtre'));
					$kpiTriggersMonthVDR = $em->getRepository('AppBundle:KpiTrigger')->getKpiTriggerOfMonthVDR($date1, $date2, $session->get('kpi_boutique_filtre'));
				}
			}
		}

        if($session->get('kpi_boutique_filtre') != null && $request->getMethod() == 'GET'){
        	$form->get('boutique')->setData($em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('libelle' => $session->get('kpi_boutique_filtre'))));
        }

        return $this->render('AppBundle:Kpi:trigger.html.twig', array(
        	'user' 					=> $user,
        	'kpiTriggersMonth'		=> $kpiTriggersMonth,
        	'kpiTriggersMonthVDR'	=> $kpiTriggersMonthVDR,
        	'form' 					=> $form->createView(),
        	'month'					=> $month,
        	'dateYear'					=> $year
        	)
        );
	}

	public function topBoutiqueAction(Request $request){
		$em = $this->getDoctrine()->getManager();
		$user = $this->get('security.context')->getToken()->getUser();

		$session = $request->getSession();

		if($user->getRole() == 'ROLE_RETAIL_MANAGER'){
			$firstboutique = $user;
		}

		if($user->getRole() == 'ROLE_DIRECTEUR'){
			$firstboutique = $em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('directeur' => $user->getLibelle(), 'role' => "ROLE_BOUTIQUE"), array('libelle' => 'ASC'));
		}

		$lastKpiTrigger = $em->getRepository('AppBundle:KpiTrigger')->findOneBy(array(), array('date' => "DESC"));

		$lastKpiDate = $lastKpiTrigger->getDate();

		$date = $lastKpiTrigger->getDate();

		//la derniere date est toujours celle du dernier kpicapture en base, la premiere varie de -12 à -24 mois
		//Affichage des données du dernier mois / mois selectionné de l'année en cours de puis le début de l'année
		if($session->get('kpi_boutique_filtre') == null && $session->get('kpi_month_filtre') == null && $session->get('kpi_year_filtre') == null) {

			$month = $date->format('m');
			$year = $date->format('Y');

			$date2 = new \DateTime($date->format('Y-m-d'));
			$date2->modify('last day of this month');
			$date2 = $date2->format("Y-m-d");
		}
		//si on a une recherche active
		else{
			$month = $session->get('kpi_month_filtre');
			$year = $session->get('kpi_year_filtre');

			$date2 = $date2 = new \DateTime($year."-".$month."-01");
			$date2->modify('last day of this month');
			$date2 = $date2->format("Y-m-d");

			$date_check = new \DateTime($date2);
			if($date_check > $date) {
				$month = $date->format('m');
				$year = $date->format('Y');
				$session->set('kpi_month_filtre', $month);
				$session->set('kpi_year_filtre', $year);

				$date2 = new \DateTime($date->format('Y-m-d'));
				$date2->modify('last day of this month');
				$date2 = $date2->format("Y-m-d");
			}
		}


		$date1 = new \DateTime($date2);
		$date1->modify('-12 months')->modify('first day of this month');
		$date1 = $date1->format("Y-m-d");


		if($session->get('kpi_year_filtre') != null)
			$form = $this->createForm(new KpiFilterType($em, $user, $month, $session->get('kpi_year_filtre')));
		else
			$form = $this->createForm(new KpiFilterType($em, $user, $month, $year));
		
        $form->handleRequest($request);        

        $data = $form->getData();

		$lastKpiTrigger = null;

		if ( $request->getMethod() == 'POST' ) {
			if($data['boutique'] == '' ){
				$session->remove('kpi_boutique_filtre');
			}
			else{
				$session->set('kpi_boutique_filtre', $data['boutique']->getLibelle());
			}

			if($data['year'] == '' ){
				$session->remove('kpi_year_filtre');
			}
			else{
				$session->set('kpi_year_filtre', $data['year']);
			}
			if($data['month'] == '' ){
				$session->remove('kpi_month_filtre');
			}
			else{
				$session->set('kpi_month_filtre', $data['month']);
			}

			$month = $data['month'];
			$year = $data['year'];

			$date2 = $date2 = new \DateTime($year."-".$month."-01");
			$date2->modify('last day of this month');
			$date2 = $date2->format("Y-m-d");

			//vérification si date > à la dernière ligne en base
			$date_check = new \DateTime($date2);
			if($date_check > $date) {
				$month = $date->format('m');
				$year = $date->format('Y');
				$session->set('kpi_month_filtre', $data['month']);
				$session->set('kpi_year_filtre', $data['year']);

				$date2 = new \DateTime($date->format('Y-m-d'));
				$date2->modify('last day of this month');
				$date2 = $date2->format("Y-m-d");
			}
			
			$date1 = new \DateTime($date2);
			$date1->modify('first day of this month');
			$date1 = $date1->format("Y-m-d");		
		}
		else{
		}

		if ( $user->getRole() == 'ROLE_SIEGE' OR $user->getRole() == 'ROLE_ADMIN' ) {
			if ($session->get('kpi_boutique_filtre') == null) {
				$topAA 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "AA", 	"DESC", $this->container);		
				$topWP 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WP", 	"DESC", $this->container);
				$topWB 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WB", 	"DESC", $this->container);
				$topGlobal 	=  $em->getRepository('AppBundle:KpiCapture')->getKpiTopBoutiqueNative($month, $year, "Global", "DESC", $this->container);
			}
			else{
				if( in_array( $session->get('kpi_boutique_filtre'), array( "IDF", "Sud Est", "Sud Ouest", "Nord Est", "Nord Ouest" ) )){
					$topAA 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "AA", 	"DESC", $this->container, 'RM', $session->get('kpi_boutique_filtre'));		
					$topWP 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WP", 	"DESC", $this->container, 'RM', $session->get('kpi_boutique_filtre'));
					$topWB 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WB", 	"DESC", $this->container, 'RM', $session->get('kpi_boutique_filtre'));
					$topGlobal 	=  $em->getRepository('AppBundle:KpiCapture')->getKpiTopBoutiqueNative($month, $year, "Global", "DESC", $this->container, 'RM', $session->get('kpi_boutique_filtre'));
				}
				else{
					$topAA 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "AA", 	"DESC", $this->container, 'BTQ', $session->get('kpi_boutique_filtre'));		
					$topWP 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WP", 	"DESC", $this->container, 'BTQ', $session->get('kpi_boutique_filtre'));
					$topWB 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WB", 	"DESC", $this->container, 'BTQ', $session->get('kpi_boutique_filtre'));
					$topGlobal 	=  $em->getRepository('AppBundle:KpiCapture')->getKpiTopBoutiqueNative($month, $year, "Global", "DESC", $this->container, 'BTQ', $session->get('kpi_boutique_filtre'));	
				}
			}
		}
		elseif ( $user->getRole() == 'ROLE_RETAIL_MANAGER' ) {
			if ($session->get('kpi_boutique_filtre') == null) {
					$topAA 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "AA", 	"DESC", $this->container, 'RM', $user->getLibelle());		
					$topWP 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WP", 	"DESC", $this->container, 'RM', $user->getLibelle());
					$topWB 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WB", 	"DESC", $this->container, 'RM', $user->getLibelle());
					$topGlobal 	=  $em->getRepository('AppBundle:KpiCapture')->getKpiTopBoutiqueNative($month, $year, "Global", "DESC", $this->container, 'RM', $user->getLibelle());
			}
			else{
				if( in_array( $session->get('kpi_boutique_filtre'), array( "IDF", "Sud Est", "Sud Ouest", "Nord Est", "Nord Ouest" ) )){
					$topAA 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "AA", 	"DESC", $this->container, 'RM', $session->get('kpi_boutique_filtre'));		
					$topWP 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WP", 	"DESC", $this->container, 'RM', $session->get('kpi_boutique_filtre'));
					$topWB 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WB", 	"DESC", $this->container, 'RM', $session->get('kpi_boutique_filtre'));
					$topGlobal 	=  $em->getRepository('AppBundle:KpiCapture')->getKpiTopBoutiqueNative($month, $year, "Global", "DESC", $this->container, 'RM', $session->get('kpi_boutique_filtre'));
				}
				else{
					$topAA 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "AA", 	"DESC", $this->container, 'BTQ', $session->get('kpi_boutique_filtre'));		
					$topWP 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WP", 	"DESC", $this->container, 'BTQ', $session->get('kpi_boutique_filtre'));
					$topWB 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WB", 	"DESC", $this->container, 'BTQ', $session->get('kpi_boutique_filtre'));
					$topGlobal 	=  $em->getRepository('AppBundle:KpiCapture')->getKpiTopBoutiqueNative($month, $year, "Global", "DESC", $this->container, 'BTQ', $session->get('kpi_boutique_filtre'));
				}
			}
		}
		else {
			if ($session->get('kpi_boutique_filtre') == null) {
				$topAA 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "AA", 	"DESC", $this->container, 'DR', $firstboutique->getLibelle());		
				$topWP 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WP", 	"DESC", $this->container, 'DR', $firstboutique->getLibelle());
				$topWB 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WB", 	"DESC", $this->container, 'DR', $firstboutique->getLibelle());
				$topGlobal 	=  $em->getRepository('AppBundle:KpiCapture')->getKpiTopBoutiqueNative($month, $year, "Global", "DESC", $this->container, 'DR', $firstboutique->getLibelle());
			}
			else{
				$topAA 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "AA", 	"DESC", $this->container, 'BTQ', $session->get('kpi_boutique_filtre'));		
				$topWP 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WP", 	"DESC", $this->container, 'BTQ', $session->get('kpi_boutique_filtre'));
				$topWB 		=  $em->getRepository('AppBundle:KpiTrigger')->getKpiTopBoutiqueNative($month, $year, "WB", 	"DESC", $this->container, 'BTQ', $session->get('kpi_boutique_filtre'));
				$topGlobal 	=  $em->getRepository('AppBundle:KpiCapture')->getKpiTopBoutiqueNative($month, $year, "Global", "DESC", $this->container, 'BTQ', $session->get('kpi_boutique_filtre'));
			}
		}
		
		if($session->get('kpi_boutique_filtre') != null && $request->getMethod() == 'GET'){
        	$form->get('boutique')->setData($em->getRepository('ApplicationSonataUserBundle:User')->findOneBy(array('libelle' => $session->get('kpi_boutique_filtre'))));
        	$form->get('year')->setData( $session->get('kpi_month_filtre') );
        	$form->get('month')->setData( $session->get('kpi_year_filtre') );
        }
		

		return $this->render('AppBundle:Kpi:topBoutique.html.twig', array(
        	'user'		=> $user,
        	'topAA' 	=> $topAA,
        	'topWP' 	=> $topWP,
        	'topWB' 	=> $topWB,
        	'topGlobal'	=> $topGlobal,
        	'month' 	=> $month,
        	'year' 		=> $year,
        	'form'      => $form->createView(),
        	)
        );
	}
}