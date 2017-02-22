<?php
// src/OC/PlatformBundle/Antispam/OCAntispam.php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportDoublonSuspectCronService
{

    private $separator;
    private $filesList;
    private $ip;
    private $pdo;
    private $container;

    public function __construct( $local_ip, ContainerInterface $container)
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

    public function importTopClientCSVFile($filename, InputInterface $input, OutputInterface $output)
    {        
       
        $date = new \DateTime();
        $date = $date->format('Ymd');

        $file = fopen($filename,, "r");

        //colonnes du la requete $sql à mettre à jour
        $header = "is_doublon,id_paire,id_client,nom,prenom,email,telephone1,telephone2,adresse1,adresse2,adresse3,code_postal,ville,pays,date_dernier_achat,frequence_3_ans,ca_3_ans";
        //valeurs de la requêtes (correspond au header du fichier)
        $values = ":".str_replace(",", ",:", $header);
        //tableau des headers à mettre à jours pour la boucle
        $headers = explode(",", $header);
        $update = "";
        $i = 0;
        $len = count($headers);

        foreach ($headers as $key => $value) {
            if ($i == $len - 1) $update .= $value." = VALUES(".$value.")";
            else $update .= $value." = VALUES(".$value.")";
            $i++;
        }

        //colonnes du la requete $sql à mettre à jour
        $header2 = "libelle_boutique_rattachement,libelle_boutique_origine,id_paire,proximite";
        //valeurs de la requêtes (correspond au header du fichier)
        $values2 = ":".str_replace(",", ",:", $header2);
        //tableau des headers à mettre à jours pour la boucle
        $headers2 = explode(",", $header2);
        $update2 = "";
        $i = 0;
        $len = count($headers2);

        foreach ($headers as $key => $value) {
            if ($i == $len - 1) $update .= $value." = VALUES(".$value.")";
            else $update .= $value." = VALUES(".$value.")";
            $i++;
        }

        $sql = "INSERT INTO app_client ( user_id_dounlon_suspect, ".$header." ) 
                VALUES ( ( SELECT u.id FROM `fos_user_user` u WHERE u.libelle = :libelle_boutique_rattachement ), ".$values.")
                ON DUPLICATE KEY UPDATE user_id_topclient = ( SELECT u.id FROM `fos_user_user` u WHERE u.libelle = :libelle_boutique_rattachement_topclient ),".$update."";
        
        $sql2 = "INSERT INTO app_client_client_suspect_doublon ( client_id, ".$header2." ) 
                VALUES ( ( SELECT c.id FROM `app_client` c WHERE c.id_client = :id_client ), ".$values2.")
                ON DUPLICATE KEY UPDATE user_id_topclient =( SELECT c.id FROM `app_client` c WHERE c.id_client = :id_client ),".$update2."";

        $i = 0;
        $flag = true;

        
        while( ($csvfilelines = fgetcsv($file, 0, $this->separator)) != FALSE )
        {
            if($flag) { $flag = false; continue; } //ignore first line of csv             
            
            $stmt = $this->pdo->prepare($sql);
            $stmt2 = $this->pdo->prepare($sql2);

           
            $stmt2->bindValue(':libelle_boutique_rattachement', $csvfilelines[0], \PDO::PARAM_STR);
            $stmt2->bindValue(':libelle_boutique_origine', $csvfilelines[1], \PDO::PARAM_STR);
            if( $csvfilelines[2] == 0)
                $stmt2->bindValue(':user_id_dounlon_suspect', false, \PDO::PARAM_STR);
            else
                $stmt2->bindValue(':user_id_dounlon_suspect', true, \PDO::PARAM_STR);
            }
            $stmt2->bindValue(':id_paire', $csvfilelines[3], \PDO::PARAM_STR);
            $stmt->bindValue(':proximite', $csvfilelines[4], \PDO::PARAM_STR);
            $stmt->bindValue(':id_client', $csvfilelines[5], \PDO::PARAM_STR);
            $stmt2->bindValue(':id_client', $csvfilelines[5], \PDO::PARAM_STR);
            $stmt->bindValue(':nom', $csvfilelines[6], \PDO::PARAM_STR);
            $stmt->bindValue(':prenom', $csvfilelines[7], \PDO::PARAM_STR);
            $stmt->bindValue(':email', $csvfilelines[8], \PDO::PARAM_STR);
            $stmt->bindValue(':telephone1', $csvfilelines[9], \PDO::PARAM_STR);
            $stmt->bindValue(':telephone2', $csvfilelines[10], \PDO::PARAM_STR);
            $stmt->bindValue(':adresse1', $csvfilelines[11], \PDO::PARAM_STR);
            $stmt->bindValue(':adresse2', $csvfilelines[12], \PDO::PARAM_STR);
            $stmt->bindValue(':adresse3', $csvfilelines[13], \PDO::PARAM_STR);
            $stmt->bindValue(':code_postal', $csvfilelines[14], \PDO::PARAM_STR);
            $stmt->bindValue(':ville', $csvfilelines[15], \PDO::PARAM_STR);
            $stmt->bindValue(':pays', $csvfilelines[16], \PDO::PARAM_STR);
            $stmt->bindValue(':date_dernier_achat', $csvfilelines[17], \PDO::PARAM_STR);
            $stmt->bindValue(':frequence_3_ans', $csvfilelines[19], \PDO::PARAM_STR);
            $stmt->bindValue(':ca_3_ans', $csvfilelines[20], \PDO::PARAM_STR);

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
                $stmt->execute();
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
            rename ('D:\wamp\www\StoreApp\web\imports\topclients\liste_top_clients_clienteling_'.$date.'.csv', 'D:\wamp\www\StoreApp\web\imports\topclients\archives\liste_top_clients_clienteling_'.$date.'.csv' );
        }
        else{
            rename ('/data/ftp/imports/topclients/liste_top_clients_clienteling_'.$date.'.csv', '/data/ftp/imports/topclients/archives/liste_top_clients_clienteling_'.$date.'.csv' );
        }
    }
}