<?php
// src/OC/PlatformBundle/Form/AdvertEditType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientEmailOptOutType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
            ->remove('idClient')
            ->remove('nom')
            ->remove('prenom')
            ->remove('email')
            ->remove('telephone1')
            ->remove('telephone2')
            ->remove('adresse1')
            ->remove('adresse2')
            ->remove('ville')
            ->remove('codepostal')
            ->remove('pays')
            ->remove('lastContact')
            //->remove('phoneErr')
            //->remove('adressErr')
            //->remove('emailErr')
            ->remove('optoutEmail')
            ->remove('optoutMail')
            ->remove('optoutTelephone')
            ->remove('optoutSms')
            ->remove('createdAt')
            ->remove('modifiedAt')
            ->remove('codevendeur')
            ->remove('optin')
    ;
  }

  public function getName()
  {
    return 'appbundle_client_email_opt_out';
  }

  public function getParent()
  {
    return new ClientType();
  }
}