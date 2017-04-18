<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportKpiCronCommand extends ContainerAwareCommand 
{ 
	protected function configure() 
	{ 
		$this 
			->setName('cron:importKpi') 
			->setDescription('Lancement de l\'import des kpi')
			->addArgument('separator', InputArgument::REQUIRED, 'CSV separator?')
			//->addOption('yell', null, InputOption::VALUE_NONE, 'Si définie, la tâche criera en majuscules')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{ 
		$ip = $this->getContainer()->getParameter('local_ip');

		
		$date1 = new \DateTime();
		$date1 = $date1->format('H:i:s');

		$date = new \DateTime();
        $date = $date->format("Ymd");

        $output->writeln("ip :" . $ip);

        if($ip == "127.0.0.1")
        {
            $filename1 = "D:\\wamp\\www\\demo\\web\\imports\\KPI_CAPTURE.csv";
            $filename2 = "D:\\wamp\\www\\demo\\web\\imports\\KPI_Triggers.csv";
        }
        else{
            $filename1 = "/data/ftp/imports/KPI_CAPTURE.csv";
            $filename2 = "/data/ftp/imports/KPI_Triggers.csv";
        }

		
	    $text = $this->getDescription();
		$output->writeln($text);

		$import = $this->getContainer()->get('cron.import.kpi');

		$output->writeln("Configuration du separateur");
		$import->setSeparator($input->getArgument('separator'));

		$output->writeln("Import des Kpi Capture 1/2");
		$import->importKpiCaptureCSVFile($input, $output, $filename1);
		$output->writeln("Import des Kpi Trigger 2/2");
		$import->importKpiTriggerCSVFile($input, $output, $filename2);

		$date2 = new \DateTime();
		$date2 = $date2->format('H:i:s');
		$output->writeln("debut : ".$date1." | fin : ".$date2);
	}
}