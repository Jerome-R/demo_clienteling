<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class LignesVenteCronService
{
    private $separator;
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

    public function scanDir($dir){

        if($this->ip == "127.0.0.1")
        {
            $this->filesList = scandir("D:\wamp\www\StoreApp\web\imports\\".$dir);
        }
        else{
            $this->filesList = scandir("/data/ftp/imports/".$dir);
        }

        return $this->filesList;
    }

    public function resetLignesVentes(InputInterface $input, OutputInterface $output)
    {

        $sql0 = "DELETE FROM `app_ligne_vente` WHERE 1";
        $stmt0 = $this->pdo->prepare($sql0);       
        $stmt0->execute();

        //$sql1 = "DELETE FROM `app_ticket` WHERE 1";
        //$stmt1 = $this->pdo->prepare($sql1); 
        //$stmt1->execute();
    }

    //////////////////////////////////////////
    #client Lncl
    public function createTickets($filename, InputInterface $input, OutputInterface $output)
    {

        $date = new \DateTime();
        $date = $date->format('Ymd');

        $file = fopen($filename, "r");

        $sql = "INSERT INTO app_ticket  ( ticket_uniq_id, client_id, date_facture)  
                VALUES (   :ticket_id, (SELECT id FROM app_client tc WHERE tc.id_client = :client_id), :date_facture)
                ON DUPLICATE KEY UPDATE client_id = (SELECT id FROM app_client tc WHERE tc.id_client = :client_id)";
        

        //colonnes du la requete $sql à mettre à jour
        $header2 = "ticket_id,sku_desc,prix,quantite,categorie,sous_categorie,date_facture,client_id,point_vente_id";
       
        $headers2 = explode(",", $header2);

        $sql2 = "INSERT INTO app_ligne_vente ( ".$header2.",  ticket_uniq_id)
                VALUES ( (SELECT id from app_ticket t WHERE t.ticket_uniq_id = :ticket_id ), 
                    :sku_desc,:prix, :quantite, :categorie, :sous_categorie, :date_facture, :client_id, :point_vente_id, :ticket_id)
                ON DUPLICATE KEY UPDATE ticket_uniq_id = ticket_uniq_id
            ";

        $i = 0;
        $flag = true;

        while( ($csvfilelines = fgetcsv($file, 0, $this->separator)) != FALSE )
        {
            if($flag) { $flag = false; continue; } //ignore first line of csv 
       
            $stmt = $this->pdo->prepare($sql);
            $stmt2 = $this->pdo->prepare($sql2);

            $stmt->bindValue(':ticket_id', $csvfilelines[0], \PDO::PARAM_STR);
            $stmt->bindValue(':client_id', $csvfilelines[7], \PDO::PARAM_STR);
            $stmt->bindValue(':date_facture', $csvfilelines[6], \PDO::PARAM_STR);

            
            foreach ($headers2 as $key => $col) {
                $stmt2->bindValue(':'.$col, $csvfilelines[$key], \PDO::PARAM_STR);
            }

            try
            {
                $stmt->execute();
            }
            catch(Exception $e)
            {       
                $output->writeln($e->getMessage());
                die('Erreur 1 : '.$e->getMessage());
            }

            try
            {
                $stmt2->execute();
            }
            catch(Exception $e)
            {       
                $output->writeln($e->getMessage());
                die('Erreur 2 : '.$e->getMessage());
            }

            if($i % 1000 == 0){
                $output->writeln($i." lignes importees");
                gc_collect_cycles();
            }
            $i++;
        }
        $output->writeln($i." lignes importees");
    }

    public function createTicketsSortants($sav, InputInterface $input, OutputInterface $output)
    {

        $date = new \DateTime();
        $date = $date->format('Ymd');

        if($this->ip == "127.0.0.1")
        {
            $file = fopen("D:\\wamp\\www\\StoreApp\\web\\imports\\topclients\\lignes_vente_".$sav."top_clients_sortants_clienteling_".$date.".csv", "r");
        }
        else{
            $file = fopen("/data/ftp/imports/topclients/lignes_vente_".$sav."top_clients_sortants_clienteling_".$date.".csv", "r");
        }

        $sql = "INSERT INTO app_ticket  ( ticket_uniq_id, client_id, date_facture)  
                VALUES (   :ticket_id, (SELECT id FROM app_client tc WHERE tc.id_client = :client_id), :date_facture)
                ON DUPLICATE KEY UPDATE client_id = (SELECT id FROM app_client tc WHERE tc.id_client = :client_id), date_facture = :date_facture";
        

        //colonnes du la requete $sql à mettre à jour
        $header2 = "ticket_id,codeuvc,type_vente,cattc,remise_ttc,quantite,code_vendeur,date_modif,super_ligne_desc,sku_desc,date_facture,client_id,point_vente_id";
       
        $headers2 = explode(",", $header2);

        $sql2 = "INSERT INTO app_ligne_vente ( ".$header2.",  ticket_uniq_id)
                VALUES ( (SELECT id from app_ticket t WHERE t.ticket_uniq_id = :ticket_id ), 
                    :codeuvc, :type_vente, :cattc, :remise_ttc, :quantite, :code_vendeur, :date_modif, :super_ligne_desc, :sku_desc, :date_facture, :client_id, :point_vente_id, :ticket_id)
                ON DUPLICATE KEY UPDATE ticket_uniq_id = ticket_uniq_id
            ";

        $i = 0;
        $flag = true;

        while( ($csvfilelines = fgetcsv($file, 0, $this->separator)) != FALSE )
        {
            if($flag) { $flag = false; continue; } //ignore first line of csv 
       
            $stmt = $this->pdo->prepare($sql);
            $stmt2 = $this->pdo->prepare($sql2);

            $stmt->bindValue(':ticket_id', $csvfilelines[0], \PDO::PARAM_STR);
            $stmt->bindValue(':client_id', $csvfilelines[11], \PDO::PARAM_STR);
            $stmt->bindValue(':date_facture', $csvfilelines[10], \PDO::PARAM_STR);

            
            foreach ($headers2 as $key => $col) {
                $stmt2->bindValue(':'.$col, $csvfilelines[$key], \PDO::PARAM_STR);
            }

            try
            {
                $stmt->execute();
            }
            catch(Exception $e)
            {       
                $output->writeln($e->getMessage());
                die('Erreur 1 : '.$e->getMessage());
            }

            try
            {
                $stmt2->execute();
            }
            catch(Exception $e)
            {       
                $output->writeln($e->getMessage());
                die('Erreur 2 : '.$e->getMessage());
            }

            if($i % 1000 == 0){
                $output->writeln($i." lignes importees");
                gc_collect_cycles();
            }
            $i++;
        }
        $output->writeln($i." lignes importees");
    }

    public function moveUploadedFile()
    {
        $date = new \DateTime();
        $date = $date->format("Ymd");

        if($this->ip == "127.0.0.1")
        {
            rename ('D:\wamp\www\StoreApp\web\imports\topclients\lignes_vente_top_clients_clienteling_'.$date.'.csv' , 'D:\wamp\www\StoreApp\web\imports\topclients\archives\lignes_vente_top_clients_clienteling_'.$date.'.csv' );
            rename ('D:\wamp\www\StoreApp\web\imports\topclients\lignes_vente_SAV_top_clients_clienteling_'.$date.'.csv' , 'D:\wamp\www\StoreApp\web\imports\topclients\archives\lignes_vente_SAV_top_clients_clienteling_'.$date.'.csv' );
            rename ('D:\wamp\www\StoreApp\web\imports\topclients\lignes_vente_top_clients_sortants_clienteling_'.$date.'.csv' , 'D:\wamp\www\StoreApp\web\imports\topclients\archives\lignes_vente_top_clients_sortants_clienteling_'.$date.'.csv' );
            rename ('D:\wamp\www\StoreApp\web\imports\topclients\lignes_vente_SAV_top_clients_sortants_clienteling_'.$date.'.csv' , 'D:\wamp\www\StoreApp\web\imports\topclients\archives\lignes_vente_SAV_top_clients_sortants_clienteling_'.$date.'.csv' );
        }
        else{
            rename ('/data/ftp/imports/topclients/lignes_vente_top_clients_clienteling_'.$date.'.csv' , '/data/ftp/imports/topclients/archives/lignes_vente_top_clients_clienteling_'.$date.'.csv' );
            rename ('/data/ftp/imports/topclients/lignes_vente_SAV_top_clients_clienteling_'.$date.'.csv' , '/data/ftp/imports/topclients/archives/lignes_vente_SAV_top_clients_clienteling_'.$date.'.csv' );
            rename ('/data/ftp/imports/topclients/lignes_vente_top_clients_sortants_clienteling_'.$date.'.csv' , '/data/ftp/imports/topclients/archives/lignes_vente_top_clients_sortants_clienteling_'.$date.'.csv' );
            rename ('/data/ftp/imports/topclients/lignes_vente_SAV_top_clients_sortants_clienteling_'.$date.'.csv' , '/data/ftp/imports/topclients/archives/lignes_vente_SAV_top_clients_sortants_clienteling_'.$date.'.csv' );
        }
    }

}