<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class LignesVenteCronCommand extends ContainerAwareCommand 
{ 
	protected function configure() 
	{ 
		$this 
			->setName('cron:importLigneVente') 
			->setDescription('Lancement de la tache cron:import')
			->addArgument('type', InputArgument::REQUIRED, 'Type : topClient | doublonSuspect ?')
			->addArgument('separator', InputArgument::REQUIRED, 'CSV separator?')
			//->addOption('yell', null, InputOption::VALUE_NONE, 'Si définie, la tâche criera en majuscules')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{ 
		$ip = $this->getContainer()->getParameter('local_ip');

		$dir1 = "Lignes_Vente_Par_Btq";
		$dir2 = "Lignes_Vente_SAV_Par_Btq";

		$date1 = new \DateTime();
		$date1 = $date1->format('H:i:s');

		$date = new \DateTime();
        $date = $date->format("Ymd");

        $type = $input->getArgument('type');


		
		$text = $this->getDescription();
		$output->writeln($text);

		$import = $this->getContainer()->get('cron.import.lignes.vente');

		$output->writeln("Configuration du separateur");
		$import->setSeparator($input->getArgument('separator'));


        if($ip == "127.0.0.1")
        {
            $filename1 = "D:\\wamp\\www\\demo\\web\\imports\\TOP_CLIENT_LIGNES.csv";
        }
        else{
            $filename1 = "/data/ftp/imports/TOP_CLIENT_LIGNES.csv";
        }

        if  ( file_exists($filename1) ) {

			//$output->writeln("Reset des lignes de ventes");
			//$import->resetLignesVentes( $input, $output);

			/*$output->writeln("Scan du repertoire d'update");
			$files = $import->scanDir($dir1);

			$output->writeln("Creation / Mise a jour des tickets des lignes de vente");
			foreach ($files as $key => $file) {
				if($key > 1 ){
					$output->writeln('Ouverture du fichier '.$key.' : '.$file);
					$import->createTickets($dir1, $file, $input, $output);
				}
			}
			$output->writeln("Importation des lignes de ventes");
			foreach ($files as $key => $file) {
				if($key > 1 ){
					$output->writeln('Ouverture du fichier '.$key.' : '.$file);
					$import->importLignesVentesCSVFile($dir1, $file, $input, $output);
				}
			}*/
			
			if($type == "topClient"){
				$output->writeln("Creation des tickets et des lignes de ventes topclients");
				$import->createTickets($filename1, $input, $output);
			}
			elseif($type == "doublonSuspect"){
			}

			//$output->writeln("Archivage des fichiers");
			//$import->moveUploadedFile();
		}else {
		    $output->writeln("Aucun fichier, annulation de l'import");
		}

		$date2 = new \DateTime();
		$date2 = $date2->format('H:i:s');
		$output->writeln("debut : ".$date1." | fin : ".$date2);
	}
}