<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idClient')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('telephone1')
            ->add('telephone2')
            ->add('adresse1')
            ->add('adresse2')
            ->add('ville')
            ->add('codepostal')
            ->add('pays')
            ->add('lastContact')
            ->add('isTelValide',    'checkbox', array('required' => false, 'label' => false) )
            ->add('isAdresseValide',     'checkbox', array('required' => false, 'label' => false) )
            ->add('isEmailValide',     'checkbox', array('required' => false, 'label' => false) )
            ->add('optoutTelephone',    'checkbox', array('required' => false, 'label' => false) )
            ->add('optoutSms',      'checkbox', array('required' => false, 'label' => false) )
            ->add('optoutEmail',    'checkbox', array('required' => false, 'label' => false) )
            ->add('optoutMail',     'checkbox', array('required' => false, 'label' => false) )
            ->add('createdAt')
            ->add('modifiedAt')
            ->add('codevendeur')
            ->add('optin')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Client'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_client';
    }
}
