<?php
// src/OC/PlatformBundle/Antispam/OCAntispam.php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

class SetEmailFooterService
{
	public function setEmailFooter($option)
	{
        $footer = "";

		switch ($option)
        {
            default:
                $footer = "";
                break;
        }

        return $footer;
	}
}