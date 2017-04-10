<?php
// src/OC/PlatformBundle/Antispam/OCAntispam.php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportTopClientCronService
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

    public function scanDir(){

        if($this->ip == "127.0.0.1")
        {
            $this->filesList = scandir("D:\wamp\www\StoreApp\web\imports\Liste_Top_Clients_Par_Btq");
        }
        else{
            $this->filesList = scandir("/data/ftp/imports/Liste_Top_Clients_Par_Btq");
        }

        return $this->filesList;
    }

    public function resetTopClients(InputInterface $input, OutputInterface $output)
    {
        gc_enable();

        $sql = "UPDATE `app_client` SET is_topclient = 0, is_topclient_sortant = 0 WHERE 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();


        /*$sql0 = "DELETE FROM `app_ligne_vente` WHERE 1";
        $stmt0 = $this->pdo->prepare($sql0);
        $sql1 = "DELETE FROM `app_ticket` WHERE 1";
        $stmt1 = $this->pdo->prepare($sql1);        
        
        try
        {
            $stmt0->execute();
        }
        catch(Exception $e)
        {       
            $output->writeln($e->getMessage());
            die('Erreur 1 : '.$e->getMessage());
        }

        try
        {
            $stmt1->execute();
        }
        catch(Exception $e)
        {       
            $output->writeln($e->getMessage());
            die('Erreur 2 : '.$e->getMessage());
        }*/

        //$sql2 = "UPDATE `app_top_client_comment` SET `top_client_id` = NULL WHERE 1";
        //$stmt2 = $this->pdo->prepare($sql2);
        //$sql3= "DELETE FROM `app_top_client` WHERE 1";
        //$stmt3 = $this->pdo->prepare($sql3);
        //$stmt2->execute();
        //$stmt3->execute();
    }

    //////////////////////////////////////////
    #top client Lncl
    public function importTopClientCSVFile( InputInterface $input, OutputInterface $output, $filename)
    {        
       
        $date = new \DateTime();
        $date = $date->format('Ymd');

        
        $file = fopen($filename, "r");

        //colonnes du la requete $sql à mettre à jour
        $header = "id_client,nom,prenom,civilite,libelle_boutique_rattachement_topclient,email,telephone1,telephone2,nationalite,pays,ville,code_postal,adresse1,adresse2,adresse3,ca_3_ans,ca_12_mois,frequence_3_ans,frequence_12_mois,prix_max_3_ans,prix_max_12_mois,prix_max_article_histo,panier_moyen_histo,date_1erachat,date_dernier_achat,segment,optin";
        //valeurs de la requêtes (correspond au header du fichier)
        $values = ":".str_replace(",", ",:", $header);
        //tableau des headers à mettre à jours pour la boucle
        $headers = explode(",", $header);
        $update = "";
        $i = 0;
        $len = count($headers);

        foreach ($headers as $key => $value) {
            if ($i == $len - 1) $update .= $value." = VALUES(".$value.")";
            else $update .= $value." = VALUES(".$value."),";
            $i++;
        }

        
        $sql = "INSERT INTO app_client ( user_id_topclient, ".$header.", local,is_topclient ) 
                VALUES ( ( SELECT u.id FROM `fos_user_user` u WHERE u.libelle = :libelle_boutique_rattachement_topclient ), ".$values.", 't',1)
                ON DUPLICATE KEY UPDATE user_id_topclient = ( SELECT u.id FROM `fos_user_user` u WHERE u.libelle = :libelle_boutique_rattachement_topclient ),".$update.", local = 't',is_topclient = 1";
        
        $i = 0;
        $flag = true;

        
        while( ($csvfilelines = fgetcsv($file, 0, $this->separator)) != FALSE )
        {
            if($flag) { $flag = false; continue; } //ignore first line of csv             
            
            $stmt = $this->pdo->prepare($sql);

            foreach ($headers as $key => $col) {
                if($key != 32){
                    $stmt->bindValue(':'.$col, $csvfilelines[$key], \PDO::PARAM_STR);
                    if($col == "date_dernier_achat" && $csvfilelines[$key] == ""){
                        $stmt->bindValue(':'.$col, null, \PDO::PARAM_STR);
                    }
                    if($col == "date_1erachat" && $csvfilelines[$key] == ""){
                        $stmt->bindValue(':'.$col, null, \PDO::PARAM_STR);
                    }
                }                    
                else
                {
                    if( $csvfilelines[$key] == 0)
                        $stmt->bindValue(':is_nouveau_topclient', false, \PDO::PARAM_STR);
                    else
                        $stmt->bindValue(':is_nouveau_topclient', true, \PDO::PARAM_STR);
                }
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

            if($i % 1000 == 0){
                $output->writeln($i." lignes importees");
                gc_collect_cycles();
            }
            $i++;
        }

        $sql3 = "REPLACE INTO app_date_import ( date_import, module) 
                VALUES ( :date_import, :module )";

        $today = new \DateTime();
        $today = $today->format("Y-m-d");
        $stmt3 = $this->pdo->prepare($sql3);
        $stmt3->bindValue(':date_import',$today, \PDO::PARAM_STR);
        $stmt3->bindValue(':module', 'top_clients', \PDO::PARAM_STR);
        $stmt3->execute();

        $output->writeln($i." lignes importees");
    }

    public function importTopClientSortantCSVFile( InputInterface $input, OutputInterface $output)
    {        
       
        $date = new \DateTime();
        $date = $date->format('Ymd');

        if($this->ip == "127.0.0.1")
        {
            $file = fopen("D:\\wamp\\www\\StoreApp\\web\\imports\\topclients\\archive_top_clients_sortants_clienteling_".$date.".csv", "r");
        }
        else{
            $file = fopen("/data/ftp/imports/topclients/archive_top_clients_sortants_clienteling_".$date.".csv", "r");
        }


        //colonnes du la requete $sql à mettre à jour
        $header = "id_client,optin,email,telephone1,telephone2,telephone3,portable1,portable2,portable3,local,pays,ville,code_postal,adresse1,adresse2,adresse3,civilite,nationalite,nom,prenom,ca_3_ans,ca_12_mois,frequence_12_mois,frequence_3_ans,panier_moyen_histo,prix_max_article_histo,date_1erachat,date_dernier_achat,segment,boutique_rattachement_topclient,libelle_boutique_rattachement_topclient,pays_boutique_rattachement,is_nouveau_topclient,ca_histo,is_contactable_email,is_contactable_tel,is_contactable_adresse,is_email_valide,is_tel_valide,is_adresse_valide,is_hard_bounce";
        //valeurs de la requêtes (correspond au header du fichier)
        $values = ":".str_replace(",", ",:", $header);
        //tableau des headers à mettre à jours pour la boucle
        $headers = explode(",", $header);
        $update = "";
        $i = 0;
        $len = count($headers);

        foreach ($headers as $key => $value) {
            if ($i == $len - 1) $update .= $value." = VALUES(".$value.")";
            else $update .= $value." = VALUES(".$value."),";
            $i++;
        }

        
        $sql = "INSERT INTO app_client ( user_id_topclient, ".$header.", is_topclient ) 
                VALUES ( ( SELECT u.id FROM `fos_user_user` u WHERE u.libelle = :libelle_boutique_rattachement_topclient ), ".$values.", 1)
                ON DUPLICATE KEY UPDATE user_id_topclient = ( SELECT u.id FROM `fos_user_user` u WHERE u.libelle = :libelle_boutique_rattachement_topclient ),".$update.", is_topclient = 1";

        //colonnes du la requete $sql à mettre à jour
        $header2 = "id_client,date_archive";
        //valeurs de la requêtes (correspond au header du fichier)
        $values2 = ":".str_replace(",", ",:", $header2);
        //tableau des headers à mettre à jours pour la boucle
        $headers2 = explode(",", $header2);
        $update = "";
        $i = 0;
        $len = count($headers2);

        foreach ($headers2 as $key => $value) {
            if ($i == $len - 1) $update .= $value." = :".$value;
            else $update .= $value." = VALUES(".$value."),";
            $i++;
        }

        
        $sql2 = "INSERT INTO app_client_sortant ( client_id, ".$header2." ) 
                VALUES ( ( SELECT c.id FROM `app_client` c WHERE c.id_client = :id_client ), ".$values2.")
                ON DUPLICATE KEY UPDATE id_client = :id_client, date_archive = :date_archive
                ";  

        $sql3 = "UPDATE app_client SET is_topclient_sortant = 1 WHERE id_client = :id_client";

        $sql4 = "UPDATE app_client SET is_nouveau_topclient = 0 WHERE is_topclient_sortant = 1";
        
        $i = 0;
        $flag = true;

        
        while( ($csvfilelines = fgetcsv($file, 0, $this->separator)) != FALSE )
        {
            if($flag) { $flag = false; continue; } //ignore first line of csv             
            
            
            $stmt = $this->pdo->prepare($sql);

            foreach ($headers as $key => $col) {
                //correspond à is_nouveau_top_client
                if($key != 32)
                    $stmt->bindValue(':'.$col, $csvfilelines[$key], \PDO::PARAM_STR);
                else
                {
                    if( $csvfilelines[$key] == 0)
                        $stmt->bindValue(':is_nouveau_topclient', false, \PDO::PARAM_STR);
                    else
                        $stmt->bindValue(':is_nouveau_topclient', true, \PDO::PARAM_STR);
                }
            }

            $stmt2 = $this->pdo->prepare($sql2);
            
            $stmt2->bindValue(':id_client', $csvfilelines[0], \PDO::PARAM_STR);
            $stmt2->bindValue(':date_archive', $csvfilelines[36], \PDO::PARAM_STR);

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

            $stmt3 = $this->pdo->prepare($sql3);
            $stmt3->bindValue(':id_client', $csvfilelines[0], \PDO::PARAM_STR);

            try
            {
                $stmt3->execute();
            }
            catch(Exception $e)
            {       
                $output->writeln($e->getMessage());
                die('Erreur 3 : '.$e->getMessage());
            }

            $stmt4 = $this->pdo->prepare($sql4);

            try
            {
                $stmt4->execute();
            }
            catch(Exception $e)
            {       
                $output->writeln($e->getMessage());
                die('Erreur 4 : '.$e->getMessage());
            }

            if($i % 1000 == 0){
                $output->writeln($i." lignes importees");
                gc_collect_cycles();
            }
            $i++;
        }

        $output->writeln($i." lignes importees");
    }

    public function updateUserField(InputInterface $input, OutputInterface $output)
    {

        $sql = "UPDATE `app_top_client`
                SET `user_id_topclient` = ( SELECT u.id
                FROM `fos_user_user` u 
                WHERE u.libelle = libelle_boutique_rattachement_topclient )
                WHERE user_id_topclient IS NULL";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(); 
    }

    public function updateCommentField(InputInterface $input, OutputInterface $output)
    {

        gc_enable();
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);
        $batchSize = 100;
        $loop = 0;

        $sql0 = "UPDATE `app_top_client_comment`
                SET `top_client_id` = ( SELECT tc.id
                FROM app_top_client tc 
                WHERE tc.id_client = :id_client LIMIT 1)
                WHERE id = :id"
        ;

        $q = $this->em->createQuery('select t from AppBundle:TopClientComment t');
        $comments = $q->iterate();

        while (($row = $comments->next()) !== false) { 
            $comment = $row[0];

            $stmt0 = $this->pdo->prepare($sql0);
            $stmt0->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);
            $stmt0->bindValue(':id_client', $comment->getIdClient(), \PDO::PARAM_STR);

            $stmt0->execute();

            if (($loop % $batchSize) === 0) {
                $this->em->clear(); // Detaches all objects from Doctrine!
                gc_collect_cycles();
                $output->writeln($loop." commentaire mis a jour");
            }

            $loop++;
        }

        $this->em->clear(); // Detaches all objects from Doctrine!
        gc_collect_cycles();
        $output->writeln($loop." commentaire mis a jour");

    }

    public function moveUploadedFile()
    {
        $date = new \DateTime();
        $date = $date->format("Ymd");

        if($this->ip == "127.0.0.1")
        {
            rename ('D:\wamp\www\StoreApp\web\imports\TOP_CLIENT_CLIENTS_V2.csv', 'D:\wamp\www\StoreApp\web\imports\archives\TOP_CLIENT_CLIENTS_V2.csv' );
        }
        else{
            rename ('/data/ftp/imports/TOP_CLIENT_CLIENTS_V2.csv', '/data/ftp/imports/archives/TOP_CLIENT_CLIENTS_V2.csv' );
        }
    }
}