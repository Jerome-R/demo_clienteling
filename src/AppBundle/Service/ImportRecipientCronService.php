<?php
// src/OC/PlatformBundle/Antispam/OCAntispam.php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportRecipientCronService
{
	private $separator;
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

    public function deleteImport()
    {

        /*$sql = "DELETE FROM app_import_clients WHERE 1";
        $stmt = $this->pdo->prepare($sql);
        try
        {
            $stmt->execute();
        }
        catch(Exception $e)
        {       
            $output->writeln($e->getMessage());
            die('Erreur 1 : '.$e->getMessage());
        }*/

        //On met à 0 tous les flag des recipient et data recipient pour les effacer par la suite si il ne sont pas updatés à 1.

        $sql2 = "UPDATE app_recipient SET in_last_import = 0, data_recipient_id = NULL WHERE id_campagne_name LIKE 'Trigger%' ";
        $stmt2 = $this->pdo->prepare($sql2);
        try
        {
            $stmt2->execute();
        }
        catch(Exception $e)
        {       
            $output->writeln($e->getMessage());
            die('Erreur 2 : '.$e->getMessage());
        }

        $sql3 = "DELETE FROM app_data_recipient WHERE id_campagne_name LIKE 'Trigger%' ";
        $stmt3 = $this->pdo->prepare($sql3);
        try
        {
            $stmt3->execute();
        }
        catch(Exception $e)
        {       
            $output->writeln($e->getMessage());
            die('Erreur 3 : '.$e->getMessage());
        }
    }

    public function importClientCSVFile(InputInterface $input, OutputInterface $output, $filename = null)
    {
        gc_enable();

        $date = new \DateTime();

        $created_at = $date;

        $startTime = $date;
        $date = $date->format("Ymd");

        if($filename == "trigger")
        {
            if($this->ip == "127.0.0.1")
            {
                $file = fopen("D:\wamp\www\StoreApp\web\imports\ciblage_clienteling_".$date.".csv", "r");
            }
            else{
                $file = fopen("/data/ftp/imports/ciblage_clienteling_".$date.".csv", "r");
            }
        }
        else{
            if($this->ip == "127.0.0.1")
            {
                $file = fopen("D:\wamp\www\StoreApp\web\imports\ciblage_ad_hoc_".$filename.".csv", "r");
            }
            else{
                $file = fopen("/data/ftp/imports/ciblage_ad_hoc_".$filename.".csv", "r");
            }
        }

        //colonnes du la requete $sql à mettre à jour
        $header =   "id_client,nom,prenom,civilite,email,telephone1,telephone2,local,pays,ville,code_postal,adresse1,adresse2,adresse3,nationalite,ca_3_ans,ca_12_mois,frequence_3_ans,frequence_12_mois,prix_max_3_ans,prix_max_12_mois,prix_max_article_histo,panier_moyen_histo,date_1erachat,date_dernier_achat,segment,is_contactable_email,is_contactable_tel,is_contactable_adresse,is_email_valide,is_tel_valide,is_adresse_valide,is_hard_bounce,optin,created_at";
        //valeurs de la requêtes (correspond au header du fichier)
        $values = ":".str_replace(",", ",:", $header);
        //tableau des headers à mettre à jours pour la boucle
        $headers = explode(",", $header);
        $update = "";
        $i = 0;
        $len = count($headers);

        foreach ($headers as $key => $value) {
            if ($i == $len - 1) $update .= $value." = :".$value;
            else $update .= $value." = :".$value.",";
            $i++;
        }

        
        $sql = "INSERT INTO app_client ( user_id_trigger, ".$header." ) 
                VALUES ( ( SELECT u.id FROM `fos_user_user` u WHERE u.libelle = :libelle_boutique_achat ), ".$values.")
                ON DUPLICATE KEY UPDATE user_id_trigger = ( SELECT u.id FROM `fos_user_user` u WHERE u.libelle = :libelle_boutique_achat ),".$update."";


        //colonnes du la requete $sql2 à mettre à jour
        $header2 = "id_client,id_campagne_name,libelle_boutique_achat,date_entree,canal,code_uvc,sku_desc,genre_desc,ligne_desc,prix_paye,code_vendeur,motif_achat,vide_1,vide_2,vide_3,vide_4,vide_5,vide_6,vide_7,vide_8,vide_9,vide_10";
        //valeurs de la requête (correspond au header du fichier)
        $values2 = ":".str_replace(",", ",:", $header2);
        //tableau des headers à mettre à jours pour la boucle
        $headers2 = explode(",", $header2);
        $update2 = "";
        $i2 = 0;
        $len2 = count($headers2);

        foreach ($headers2 as $key => $value2) {
            if ($i2 == $len2 - 1) $update2 .= $value2." = :".$value2;
            else $update2 .= $value2." = :".$value2.",";
            $i2++;
        }


        $sql2 = "INSERT INTO app_data_recipient (client_id, ".$header2." )
                VALUES ( (SELECT id  FROM app_client WHERE id_client = :id_client LIMIT 1), ".$values2.")
                ON DUPLICATE KEY UPDATE ".$update2." ";

        /*
        Pour update TopClient
        $sql3 = "UPDATE app_top_client SET (date_entree, ...)
                VALUES (:date_entree, ...) WHERE id_client = :id_client
        */

        $i = 0;
        $batchSize = 200;
        $flag = true;

        while( ($csvfilelines = fgetcsv($file, 0, $this->separator)) != FALSE )
        {
            if($flag) { $flag = false; continue; } //ignore first line of csv

            $stmt = $this->pdo->prepare($sql);
            $stmt2 = $this->pdo->prepare($sql2);    

            $stmt->bindValue(':id_client', $csvfilelines[0], \PDO::PARAM_STR);
            $stmt2->bindValue(':id_client', $csvfilelines[0], \PDO::PARAM_STR);          
            $stmt2->bindValue(':id_campagne_name', $csvfilelines[1], \PDO::PARAM_STR);
            $stmt2->bindValue(':date_entree', $csvfilelines[2], \PDO::PARAM_STR);
            $stmt2->bindValue(':canal', $csvfilelines[3], \PDO::PARAM_STR);
            $stmt->bindValue(':nom', $csvfilelines[4], \PDO::PARAM_STR);
            $stmt->bindValue(':prenom', $csvfilelines[5], \PDO::PARAM_STR);
            $stmt->bindValue(':civilite', $csvfilelines[6], \PDO::PARAM_STR);
            $stmt->bindValue(':libelle_boutique_achat', $csvfilelines[7], \PDO::PARAM_STR);
            $stmt2->bindValue(':libelle_boutique_achat', $csvfilelines[7], \PDO::PARAM_STR);
            $stmt->bindValue(':email', $csvfilelines[8], \PDO::PARAM_STR);
            $stmt->bindValue(':telephone1', $csvfilelines[9], \PDO::PARAM_STR);
            $stmt->bindValue(':telephone2', $csvfilelines[10], \PDO::PARAM_STR);
            $stmt->bindValue(':local', $csvfilelines[11], \PDO::PARAM_STR);
            $stmt->bindValue(':pays', $csvfilelines[12], \PDO::PARAM_STR);
            $stmt->bindValue(':ville', $csvfilelines[13], \PDO::PARAM_STR);
            $stmt->bindValue(':code_postal', $csvfilelines[14], \PDO::PARAM_STR);
            $stmt->bindValue(':adresse1', $csvfilelines[15], \PDO::PARAM_STR);
            $stmt->bindValue(':adresse2', $csvfilelines[16], \PDO::PARAM_STR);
            $stmt->bindValue(':adresse3', $csvfilelines[17], \PDO::PARAM_STR);
            $stmt->bindValue(':nationalite', $csvfilelines[18], \PDO::PARAM_STR);
            $stmt->bindValue(':ca_3_ans', $csvfilelines[19], \PDO::PARAM_STR);
            $stmt->bindValue(':ca_12_mois', $csvfilelines[20], \PDO::PARAM_STR);
            $stmt->bindValue(':frequence_3_ans', $csvfilelines[21], \PDO::PARAM_STR);
            $stmt->bindValue(':frequence_12_mois', $csvfilelines[22], \PDO::PARAM_STR);
            $stmt->bindValue(':prix_max_3_ans', $csvfilelines[23], \PDO::PARAM_STR);
            $stmt->bindValue(':prix_max_12_mois', $csvfilelines[24], \PDO::PARAM_STR);
            $stmt->bindValue(':prix_max_article_histo', $csvfilelines[25], \PDO::PARAM_STR);
            $stmt->bindValue(':panier_moyen_histo', $csvfilelines[26], \PDO::PARAM_STR);
            $stmt->bindValue(':date_1erachat', $csvfilelines[27], \PDO::PARAM_STR);
            $stmt->bindValue(':date_dernier_achat', $csvfilelines[28], \PDO::PARAM_STR);
            $stmt->bindValue(':segment', $csvfilelines[29], \PDO::PARAM_STR);
            $stmt2->bindValue(':code_uvc', $csvfilelines[30], \PDO::PARAM_STR);
            $stmt2->bindValue(':sku_desc', $csvfilelines[31], \PDO::PARAM_STR);
            $stmt2->bindValue(':genre_desc', $csvfilelines[32], \PDO::PARAM_STR);
            $stmt2->bindValue(':ligne_desc', $csvfilelines[33], \PDO::PARAM_STR);
            $stmt2->bindValue(':prix_paye', $csvfilelines[34], \PDO::PARAM_STR);
            $stmt2->bindValue(':code_vendeur', $csvfilelines[35], \PDO::PARAM_STR);
            $stmt->bindValue(':is_contactable_email', $csvfilelines[36], \PDO::PARAM_STR);
            $stmt->bindValue(':is_contactable_tel', $csvfilelines[37], \PDO::PARAM_STR);
            $stmt->bindValue(':is_contactable_adresse', $csvfilelines[38], \PDO::PARAM_STR);
            $stmt->bindValue(':is_email_valide', $csvfilelines[39], \PDO::PARAM_STR);
            $stmt->bindValue(':is_tel_valide', $csvfilelines[40], \PDO::PARAM_STR);
            $stmt->bindValue(':is_adresse_valide', $csvfilelines[41], \PDO::PARAM_STR);
            $stmt->bindValue(':is_hard_bounce', $csvfilelines[42], \PDO::PARAM_STR);
            $stmt->bindValue(':optin', $csvfilelines[43], \PDO::PARAM_STR);
            $stmt2->bindValue(':motif_achat', $csvfilelines[44], \PDO::PARAM_STR);
            $stmt2->bindValue(':vide_1', $csvfilelines[45], \PDO::PARAM_STR);
            $stmt2->bindValue(':vide_2', $csvfilelines[46], \PDO::PARAM_STR);
            $stmt2->bindValue(':vide_3', $csvfilelines[47], \PDO::PARAM_STR);
            $stmt2->bindValue(':vide_4', $csvfilelines[48], \PDO::PARAM_STR);
            $stmt2->bindValue(':vide_5', $csvfilelines[49], \PDO::PARAM_STR);
            $stmt2->bindValue(':vide_6', $csvfilelines[50], \PDO::PARAM_STR);
            $stmt2->bindValue(':vide_7', $csvfilelines[51], \PDO::PARAM_STR);
            $stmt2->bindValue(':vide_8', $csvfilelines[52], \PDO::PARAM_STR);
            $stmt2->bindValue(':vide_9', $csvfilelines[53], \PDO::PARAM_STR);
            $stmt2->bindValue(':vide_10', $csvfilelines[54], \PDO::PARAM_STR);
            $stmt->bindValue(':created_at', $created_at->format('Y-m-d H:i:s'), \PDO::PARAM_STR);


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

            if($i % $batchSize == 0){
                $output->writeln($i." lignes");
            }
            $i++;
        }
        $output->writeln($i." lignes importees");

        $date2 = new \DateTime();

        $endTime = $date2;

        $result["name"] = 'ciblage_clienteling_'.$date.'.csv';
        $result["startTime"] = $startTime;
        $result["endTime"] = $endTime;
        $result["totalProcessedCount"] = $i;

        return $result;
    } 

    public function updateRecipients(InputInterface $input, OutputInterface $output, $filename = null) 
    {
        gc_enable();
        $batchSize = 200;
        $loop = 0;

        if($filename == "trigger")
        {
            $sql  =  "SELECT *  FROM app_data_recipient  WHERE id_campagne_name LIKE :trigger ";
        }
        else{
            $sql  =  "SELECT *  FROM app_data_recipient  WHERE id_campagne_name LIKE :not_trigger ";
        }

        $sql2 =  "SELECT * FROM app_campaign       WHERE id_campaign_name = :id_campaign_name LIMIT 1";
        $sql3 =  "SELECT * FROM app_client         WHERE id_client = :id_client LIMIT 1";
        $sql4 =  "SELECT * FROM app_recipient      WHERE campaign_id = :campaign_id AND client_id = :client_id LIMIT 1";
        $sql5 =  "UPDATE        app_recipient      SET user_id = :user_id, data_recipient_id = :data_recipient_id , id_campagne_name = :id_campaign_name , id_client = :id_client , modified_at = NOW() , in_last_import = 1
                                                   WHERE client_id = :client_id AND campaign_id = :id_campagne";
        $sql6 =  "SELECT * FROM fos_user_user      WHERE libelle = :libelle LIMIT 1";
        $sql7 =  "INSERT   INTO app_recipient      (optin, canal, id_campagne_name, id_client, campaign_id, client_id, data_recipient_id, user_id, created_at,in_last_import ) 
                  VALUES ( 1, :canal, :id_campagne_name, :id_client, :campaign_id, :client_id, :data_recipient_id, :user_id, NOW(),1) ";
        

        $stmt = $this->pdo->prepare($sql);
        if($filename == "trigger")
        {
            $stmt->bindValue(':trigger', "Trigger_%", \PDO::PARAM_STR);
        }
        else{
            $stmt->bindValue(':not_trigger', "%".$filename."%", \PDO::PARAM_STR);
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

        //For each Client
        //while (($row = $dataRecipients->next()) !== false) { 
        while( $dataRecipient = $stmt->fetch(\PDO::FETCH_ASSOC) ){

            //Get Campaign that match with campaignId
            $stmt2 = $this->pdo->prepare($sql2);
            $stmt2->bindValue(':id_campaign_name', $dataRecipient['id_campagne_name'], \PDO::PARAM_STR);
            
            try
            {
                $stmt2->execute();
            }
            catch(Exception $e)
            {       
                $output->writeln($e->getMessage());
                die('Erreur 2 : '.$e->getMessage());
            }

            $campaign = $stmt2->fetch(\PDO::FETCH_ASSOC);

            //If Campaign IS NOT NULL
            if($campaign['id'] != null && $campaign['id'] != "") {

                //Get Client
                $stmt3 = $this->pdo->prepare($sql3);
                $stmt3->bindValue(':id_client', $dataRecipient['id_client'], \PDO::PARAM_STR);
                $stmt3->bindValue(':id_client', $dataRecipient['id_client'], \PDO::PARAM_STR);
                

                try
                {
                    $stmt3->execute();
                }
                catch(Exception $e)
                {       
                    $output->writeln($e->getMessage());
                    die('Erreur 3 : '.$e->getMessage());
                }

                $client = $stmt3->fetch(\PDO::FETCH_ASSOC);

                $dataRecipient_id = $dataRecipient['id'];
                $client_id = $client['id'];
                $campaign_id = $campaign['id'];
                $idCampaignName = $campaign['id_campaign_name'];
                $idClient = $client['id_client'];
                $libelle  = $dataRecipient['libelle_boutique_achat'];

                //Get Recipient
                $stmt4 = $this->pdo->prepare($sql4);
                $stmt4->bindValue(':campaign_id', $campaign_id, \PDO::PARAM_STR);
                $stmt4->bindValue(':client_id', $client_id, \PDO::PARAM_STR);
                try
                {
                    $stmt4->execute();
                }
                catch(Exception $e)
                {       
                    $output->writeln($e->getMessage());
                    die('Erreur 4 : '.$e->getMessage());
                } 

                //Get user id
                $stmt6 = $this->pdo->prepare($sql6);
                $stmt6->bindValue(':libelle', $libelle, \PDO::PARAM_STR);

                try
                {
                    $stmt6->execute();
                }
                catch(Exception $e)
                {       
                    $output->writeln($e->getMessage());
                    die('Erreur 6 : '.$e->getMessage());
                }

                $user = $stmt6->fetch(\PDO::FETCH_ASSOC);

                $recipient = $stmt4->fetch(\PDO::FETCH_ASSOC);

                if($recipient['id'] != null && $recipient['id'] != "")        
                {                    
                    $stmt5 = $this->pdo->prepare($sql5);
                    $stmt5->bindValue(':data_recipient_id', $dataRecipient_id, \PDO::PARAM_STR);
                    $stmt5->bindValue(':id_campaign_name', $idCampaignName, \PDO::PARAM_STR);
                    $stmt5->bindValue(':client_id', $client_id, \PDO::PARAM_STR);
                    $stmt5->bindValue(':id_campagne', $campaign_id, \PDO::PARAM_STR);
                    $stmt5->bindValue(':id_client', $idClient, \PDO::PARAM_STR);
                    $stmt5->bindValue(':user_id', $user['id'], \PDO::PARAM_STR);
                    
                    try
                    {
                        $stmt5->execute();
                    }
                    catch(Exception $e)
                    {       
                        $output->writeln($e->getMessage());
                        die('Erreur 5 : '.$e->getMessage());
                    }
                }
                //If Recipient DO NOT EXIST
                else{

                    $canal = $dataRecipient['canal'];
                    if ($dataRecipient['canal'] == 'email'){
                        $canal = "Email";
                    }elseif ($dataRecipient['canal'] == 'print'){
                        $canal = "Mail";
                    }


                    $stmt7 = $this->pdo->prepare($sql7);
                    $stmt7->bindValue(':canal', $canal, \PDO::PARAM_STR);
                    $stmt7->bindValue(':id_campagne_name', $idCampaignName, \PDO::PARAM_STR);
                    $stmt7->bindValue(':id_client', $idClient, \PDO::PARAM_STR);
                    $stmt7->bindValue(':campaign_id', $campaign_id, \PDO::PARAM_STR);
                    $stmt7->bindValue(':client_id', $client_id, \PDO::PARAM_STR);
                    $stmt7->bindValue(':data_recipient_id', $dataRecipient_id, \PDO::PARAM_STR);
                    $stmt7->bindValue(':user_id', $user['id'], \PDO::PARAM_STR);
                    try
                    {
                        $stmt7->execute();
                    }
                    catch(Exception $e)
                    {       
                        $output->writeln($e->getMessage());
                        die('Erreur 7 : '.$e->getMessage());
                    }
                }
            }

            if ( $loop % $batchSize == 0) {
                gc_collect_cycles();
                $output->writeln($loop." recipients | ". $idCampaignName);
            }
            $loop++;
        }

        $output->writeln($loop." recipients mis a jour / crees");
        gc_collect_cycles();
    }

    public function deleteRecipientNotInImport(InputInterface $input, OutputInterface $output) 
    {
        gc_enable();
        $batchSize = 200;
        $loop = 0;

        $sql  =  "DELETE FROM app_recipient  WHERE in_last_import = 0 AND id_campagne_name LIKE 'Trigger%' ";

        $stmt  = $this->pdo->prepare($sql);

        try
        {
            $stmt->execute();
        }
        catch(Exception $e)
        {       
            $output->writeln($e->getMessage());
            die('Erreur  : '.$e->getMessage());
        }
    }

    public function moveUploadedFile()
    {
        $date = new \DateTime();
        $date = $date->format("Ymd");

        if($this->ip == "127.0.0.1")
        {
            rename ('D:\wamp\www\StoreApp\web\imports\ciblage_clienteling_'.$date.'.csv' , 'D:\wamp\www\StoreApp\web\imports\imported\ciblage_clienteling_'.$date.'.csv' );
        }
        else{
            rename ('/data/ftp/imports/ciblage_clienteling_'.$date.'.csv' , '/data/ftp/imports/imported/ciblage_clienteling_'.$date.'.csv' );
        }
    }

}