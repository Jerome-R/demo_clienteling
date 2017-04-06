<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportKpiCronService
{
    private $separator;
    private $filesList;
    private $ip;
    private $pdo;
    private $container;


    public function __construct($local_ip, ContainerInterface $container)
    {
        $this->ip = $local_ip;
        $this->container = $container;

        $this->pdo = $this->container->get('app.pdo_connect');
        $this->pdo = $this->pdo->initPdoClienteling();
    }

    public function setSeparator($separator) 
    {
        $this->separator = $separator;
    }

    public function scanDir(){

        if($this->ip == "127.0.0.1")
        {
            $this->filesList = scandir("D:\wamp\www\demo\web\imports\kpis");
        }
        else{
            $this->filesList = scandir("/data/ftp/imports/kpis");
        }

        return $this->filesList;
    }

    //////////////////////////////////////////
    public function importKpiTriggerCSVFile(InputInterface $input, OutputInterface $output, $filename)
    {        
       
        gc_enable();

        $date = new \DateTime();
        $date = $date->format("Ymd");

       
        $file = fopen($filename, "r");

        //colonnes du la requete à mettre à jour
        $header = "user_id,code_boutique_vendeur,point_vente_desc,niveau,date,nb_cli_tocontact_trigger_AA,nb_cli_contact_trigger_AA,pct_cli_contact_trigger_AA,nb_cli_tocontact_trigger_WB,nb_cli_contact_trigger_WB,pct_cli_contact_trigger_WB,nb_cli_tocontact_trigger_WP,nb_cli_contact_trigger_WP,pct_cli_contact_trigger_WP";
        //valeurs de la requête (correspond au header du fichier)
        $values = ":".str_replace(",", ",:", $header);
        $values = str_replace(":user_id,", "", $values);
        //tableau des headers à mettre à jours pour la boucle
        $headers = explode(",", str_replace("user_id,", "", $header));
        $update = "";
        $i = 0;
        $len = count($headers);

        foreach ($headers as $key => $value) {
            if ($i == $len - 1) $update .= $value." = :".$value;
            else $update .= $value." = :".$value.",";
            $i++;
        }

        $sql = "INSERT INTO app_kpi_trigger ( ".$header." ) 
                VALUES (  (SELECT id from fos_user_user u WHERE u.libelle = :libelle), ".$values.")
                ON DUPLICATE KEY UPDATE ".$update."";
        $i = 0;
        $flag = true;

        while( ($csvfilelines = fgetcsv($file, 0, $this->separator)) != FALSE )
        {
            if($flag) { $flag = false; continue; } //ignore first line of csv             
            
            $stmt = $this->pdo->prepare($sql);

            foreach ($headers as $key => $col) {
                $stmt->bindValue(':'.$col, $csvfilelines[$key], \PDO::PARAM_STR);
            }

            $stmt->bindValue(':libelle', $csvfilelines[1], \PDO::PARAM_STR);

            $stmt->execute();

            if($i % 20 == 0){
                $output->writeln($i." lignes importees");
            }
            $i++;
        }
        $output->writeln($i." lignes importees");
    }


    public function importKpiCaptureCSVFile( InputInterface $input, OutputInterface $output, $filename)
    {        
        $date = new \DateTime();
        $date = $date->format("Ymd");
        
        $file = fopen($filename, "r");
               
        $header = "user_id,code_boutique_vendeur,date,point_vente_desc,niveau,nb_cli_m,pct_cli_coord_valid_m,pct_cli_email_valid_m,pct_cli_email_nonvalid_m,pct_cli_email_nonrens_m,pct_cli_tel_valid_m,pct_cli_tel_nonvalid_m,pct_cli_tel_nonrens_m,pct_cli_add_valid_m,pct_cli_add_nonvalid_m,pct_cli_add_nonrens_m,nb_cli_actifs_m,nb_cli_actifs_new_m,nb_cli_actifs_exist_m,nb_cli_coord_valid_m,nb_cli_coord_nonvalid_m,nb_cli_email_valid_m,nb_cli_email_nonvalid_m,nb_cli_email_nonrens_m,nb_cli_tel_valid_m,nb_cli_tel_nonvalid_m,nb_cli_tel_nonrens_m,nb_cli_add_valid_m,nb_cli_add_nonvalid_m,nb_cli_add_nonrens_m,nb_trans_tot_m,nb_cli_ytd,pct_cli_coord_valid_ytd,pct_cli_coord_nonvalid_ytd,pct_cli_email_valid_ytd,pct_cli_email_nonvalid_ytd,pct_cli_email_nonrens_ytd,pct_cli_tel_valid_ytd,pct_cli_tel_nonvalid_ytd,pct_cli_tel_nonrens_ytd,pct_cli_add_valid_ytd,pct_cli_add_nonvalid_ytd,pct_cli_add_nonrens_ytd,nb_email_ytd,nb_tel_ytd,nb_adr_ytd,nb_cli_actifs_ytd,nb_cli_actifs_new_ytd,nb_cli_actifs_exist_ytd,nb_trans_tot_ytd,nb_cli_coord_valid_ytd,nb_cli_coord_nonvalid_ytd,nb_cli_email_valid_ytd,nb_cli_email_nonvalid_ytd,nb_cli_email_nonrens_ytd,nb_cli_tel_valid_ytd,nb_cli_tel_nonvalid_ytd,nb_cli_tel_nonrens_ytd,nb_cli_add_valid_ytd,nb_cli_add_nonvalid_ytd,nb_cli_add_nonrens_ytd,pct_cli_coord_nonvalid_m";
        
        //valeurs de la requête (correspond au header du fichier)
        $values = ":".str_replace(",", ",:", $header);
        $values = str_replace(":user_id,", "", $values);
        //tableau des headers à mettre à jours pour la boucle
        $headers = explode(",", str_replace("user_id,", "", $header));
        $update = "";
        $i = 0;
        $len = count($headers);

        foreach ($headers as $key => $value) {
            if ($i == $len - 1) $update .= $value." = :".$value;
            else $update .= $value." = :".$value.",";
            $i++;
        }

        $sql = "INSERT INTO app_kpi_capture ( ".$header." ) VALUES (  (SELECT id from fos_user_user u WHERE u.libelle = :libelle) , ".$values.")
                ON DUPLICATE KEY UPDATE ".$update."
        "; 

        $i = 0;
        $flag = true;

        while( ($csvfilelines = fgetcsv($file, 0, $this->separator)) != FALSE )
        {
            if($flag) { $flag = false; continue; } //ignore first line of csv             
            
            $stmt = $this->pdo->prepare($sql);

            foreach ($headers as $key => $col) {
                $stmt->bindValue(':'.$col, $csvfilelines[$key], \PDO::PARAM_STR);
            }


            $stmt->bindValue(':libelle', $csvfilelines[2], \PDO::PARAM_STR);
            $stmt->execute();

            if($i % 20 == 0){
                $output->writeln($i." lignes importees");
                gc_collect_cycles();
            }
            $i++;
            //die();
        }
        $output->writeln($i." lignes importees");
        
    }

    public function moveUploadedFile()
    {
        $date = new \DateTime();
        $date = $date->format("Ymd");

        if($this->ip == "127.0.0.1")
        {
            rename ("D:\\wamp\\www\\demo\\web\\imports\\kpis\\tdb_boutiques_trigger_".$date.".csv" , "D:\\wamp\\www\\demo\\web\\imports\\kpis\\archives\\tdb_boutiques_trigger_".$date.".csv");
            rename ("D:\\wamp\\www\\demo\\web\\imports\\kpis\\tdb_boutiques_capture_".$date.".csv" , "D:\\wamp\\www\\demo\\web\\imports\\kpis\\archives\\tdb_boutiques_capture_".$date.".csv");
        }
        else{
            rename ("/data/ftp/imports/kpis/tdb_boutiques_trigger_".$date.".csv" , "/data/ftp/imports/kpis/archives/tdb_boutiques_trigger_".$date.".csv");
            rename ("/data/ftp/imports/kpis/tdb_boutiques_capture_".$date.".csv" , "/data/ftp/imports/kpis/archives/tdb_boutiques_capture_".$date.".csv");
        }
    }

}