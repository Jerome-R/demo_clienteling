<?php
// src/OC/PlatformBundle/Form/AdvertEditType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use AppBundle\Entity\Client;

class ChangeChannelRecipientType extends AbstractType
{
    private $client;

    public function __construct(Client $client = null){
        $this->client = $client;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->remove('contactedAt')
        ->remove('createdAt')
        ->remove('modifiedAt')
        ->remove('campaign')
        ->remove('client')
        ->remove('optin')
        ->remove('comment')
        ->remove('optoutAutre')
        ->remove('optoutNonPertinent')
        ->remove('canal')

        ->add('submit', 'submit')
        ;


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {          
            $form = $event->getForm();
            $data = $event->getData();

            $choices = array(null => 'Sélectionner un canal');

            if( ($this->client->getEmail() != ""  || $this->client->getEmail() != null) && $this->client->getIsEmailValide() == true ) {
                $choices['Email'] = 'Email';
            }
            if( ($this->client->getAdresse1() != ""  || $this->client->getAdresse1() != null) && ( $this->client->getIsAdresseValide() == 1 || $this->client->getIsAdresseValide() != 2) ) {
                $choices['Mail'] = 'Courrier';
            }
            if( ($this->client->getTelephone1() != ""  || $this->client->getTelephone1() != null || $this->client->getTelephone2() != ""  || $this->client->getTelephone2() != null) && $this->client->getIsTelValide() == true ) {
                $choices['Phone'] = 'Téléphone';
            }

            $form
            ->add('canal', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices' => $choices,
                'required' => true,
                )
            );
        });
    }

    public function getName()
    {
        return 'appbundle_change_channel_recipient';
    }

    public function getParent()
    {
        return new RecipientType();
    }
}