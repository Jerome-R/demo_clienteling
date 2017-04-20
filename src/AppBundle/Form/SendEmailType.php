<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Application\Sonata\UserBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class SendEmailType extends AbstractType
{

    private $option;
    private $store;
    private $campaignId;

    public function __construct($option = null, $store = null, $campaignId = null){
        $this->option = $option;
        $this->store = $store;
        $this->campaignId = $campaignId;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('from', 'text')
            //->add('to', 'text')
            //->add('cc', 'text',     array('required' => false))
            //->add('bcc', 'text',    array('required' => false))
            //->add('password', 'password')
            ->add('subject', 'text')
            ->add('message', 'textarea')
            ->add('vendeur', 'text', array('required' => false))
            ->add('submit', 'submit')            
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {          
            $form = $event->getForm();
            $data = $event->getData();

            $template_number = $this->option;
            $store = $this->store;
            
            if( in_array($store, array("E-Commerce")) )
            {
                $eshop = 1;
            }
            elseif( in_array($store, array("admin")) )
            {
                $eshop = 2;
            }
            else 
            {
                $eshop = 0;
            }
            //if ( in_array($store, array('Bruxelles Louise', 'Inno Rue Neuve', 'Inno Woluwe'))) {
            $choicesAA = array(
                    //'Sélectionner le modèle de votre choix' => '',
                    "Anniversaire d'Achat - FR" => '0',
                    "Anniversaire d'Achat - EN" => '1'
                    );
            $choicesCP = array(
                    "Invitation Evènement Claravista - FR" => '2'
                    );

            switch($this->campaignId){
                case "trigger_A_E":
                    $choices = $choicesAA;
                break;
                case "trigger_D_P":
                    $choices = $choicesAA;
                break;
                case "trigger_C_P":
                    $choices = $choicesCP;
                break;
                default:
                    $choices = array(
                    "Anniversaire d'Achat - FR" => '0',
                    "Anniversaire d'Achat - EN" => '1',
                    "Invitation Evènement Claravista - FR" => '2'
                    );
                break;
                }



            //get fields value for custom queries
            $form
                ->add('template', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                    'choices' => $choices,
                    'choices_as_values' => true,
                    'required' => true,
                    'empty_value' => false,
                    'data' => $template_number
                ));
        });
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_send_email';
    }
}
