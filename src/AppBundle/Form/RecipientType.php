<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
//use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use AppBundle\Entity\Campaign;
use AppBundle\Entity\Client;

class RecipientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('optoutAutre',        'textarea', array('required' => false, 'label' => false) )
            ->add('optoutNonPertinent',  'checkbox', array('required' => false, 'label' => false) )
            ->add('optin',              'checkbox', array('required' => false, 'label' => false) )
            ->add('comment',            'textarea', array('required' => false, 'label' => false, 'attr' => array('maxlength' => 255),) )
            ->add('canal', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices' => array(
                    null    => 'Sélectionner un canal',
                    'Email' => 'Email',
                    'Mail'  => 'Courrier',
                    'Phone' => 'Téléphone',
                    ),
                'required' => true,
                )
            )
            ->add('contactedAt', 'date')
            ->add('createdAt', 'date')
            ->add('modifiedAt', 'date')
            ->add('campaign', 'entity', array(
              'class'    => 'AppBundle:Campaign',
              'choice_label' => 'name')
            )
            ->add('client', 'entity', array(
              'class'    => 'AppBundle:Client',
              'choice_label' => 'fullName')
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Recipient'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_recipient';
    }
}
