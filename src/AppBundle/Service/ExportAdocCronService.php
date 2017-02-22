<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

//use Ijanki\Bundle\FtpBundle\Exception\FtpException;

class ExportAdocCronService
{
    private $ip;
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_password;
    private $container;

    public function __construct($local_ip, ContainerInterface $container)
    {
        $this->ip = $local_ip;
        $this->container = $container;

        $this->db_host = $this->container->getParameter('database_host');
        $this->db_name = $this->container->getParameter('database_name');
        $this->db_user = $this->container->getParameter('database_user');
        $this->db_password = $this->container->getParameter('database_password');
    }

    public function createExportClientCSVFile(InputInterface $input, OutputInterface $output)
    {
        gc_enable();
        $batchSize = 20;
        $i = 0;

        $date = new \DateTime();
        $date = $date->format("Ymd"); 

        if($this->ip == "127.0.0.1")
        {
            @rename ('D:\wamp\www\StoreApp\web\exports\export_adoc.csv' , 'D:\wamp\www\StoreApp\web\exports\archives\export_adoc_'.$date.'.csv' );
            $handle = fopen('D:\wamp\www\StoreApp\web\exports\export_adoc.csv', 'w+');
        }
        else
        {
            @rename ('/data/ftp/exports/export_trigger.csv' , '/data/ftp/exports/archives/export_adoc_'.$date.'.csv' );
            $handle = fopen('/data/ftp/exports/export_adoc.csv', 'w+');
        }

        try
        {
            $pdo = new \PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name.';charset=utf8', $this->db_user, $this->db_password);
        }
        catch(Exception $e)
        {       
            $output->writeln($e->getMessage());
            die('Erreur : '.$e->getMessage());
        }

        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 


        $sql =  "SELECT r.id, c.id_client, ca.id_campaign_name, date(d.date_entree) as date_entree, r.contacted_at, r.channel, r.language, c.email_err, c.adress_err, c.phone_err, r.opt_in 
                    FROM app_recipient_adoc r
                    LEFT JOIN app_campaign_adoc AS ca ON campaign_id = ca.id
                    LEFT JOIN app_client_adoc AS c ON client_id = c.id
                    LEFT JOIN app_adoc AS d ON d.id = r.adoc_id
                    WHERE contacted_at IS NOT NULL OR opt_in = 0";
        $stmt = $pdo->prepare($sql);

        // Nom des colonnes du CSV 
        fputcsv($handle, array(
            'idclient',
            'idcampagne',
            'dateentree',
            'contactedAt',
            'channel',
            'language',
            'emailerr',
            'adrerr',
            'telerr',
            'optin'
            ),'|');

        try
        {
            $stmt->execute();
        }
        catch(Exception $e)
        {       
            $output->writeln($e->getMessage());
            die('Erreur 1 : '.$e->getMessage());
        }

        while( $adoc = $stmt->fetch(\PDO::FETCH_ASSOC) )
        {
            //$output->writeln(print_r($adoc));die();

            fputcsv($handle,array(
                $adoc['id_client'],
                $adoc['id_campaign_name'],
                $adoc['date_entree'],
                $adoc['contacted_at'],
                $adoc['channel'],
                $adoc['language'],
                $adoc['email_err'],
                $adoc['adress_err'],
                $adoc['phone_err'],
                $adoc['opt_in'],
                ),'|');

            if (($i % $batchSize) === 0) {
                gc_collect_cycles();
            }
            $i++;
        }
        gc_collect_cycles();

        fclose($handle);

    }
}
