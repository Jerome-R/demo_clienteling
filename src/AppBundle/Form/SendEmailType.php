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
            //if( in_array($store, array("Eric Tomat","Marine Le Roux","Agnès Tharaud","Christophe Mayer"," Dominique Cuel","Marianne Romestain", "admin")) )

            if ($eshop == 1)
            {
                //if ( in_array($store, array('Bruxelles Louise', 'Inno Rue Neuve', 'Inno Woluwe'))) {
                $choicesAA = array(
                        //'Sélectionner le modèle de votre choix' => '',
                        "E-Commerce - Anniversaire d'Achat - FR" => '9',
                        "E-Commerce - Anniversaire d'Achat - EN" => '10',
                        "E-Commerce - Anniversaire d'Achat - NL" => '11',
                        );
                $choicesWP = array(
                        "E-Commerce - Remerciement nouveau client - FR" => '12',
                        "E-Commerce - Remerciement nouveau client - EN" => '13',
                        "E-Commerce - Remerciement nouveau client - NL" => '14',
                        );
                $choicesWB = array(
                        "E-Commerce - Remerciement déjà client - FR" => '15',  
                        "E-Commerce - Remerciement déjà client - EN" => '16',
                        "E-Commerce - Remerciement déjà client - NL" => '17',
                        );

                switch($this->campaignId){
                    case "Trigger_AA_Boutique_1_E":
                        $choices = $choicesAA;
                    break;
                    case "Trigger_WP_Boutique_1_E":
                        $choices = $choicesWP;
                    break;
                    case "Trigger_WB_Boutique_1_E":
                        $choices = $choicesWB;
                    break;
                    case "Trigger_AA_Boutique_1_P":
                        $choices = $choicesAA;
                    break;
                    case "Trigger_WP_Boutique_1_P":
                        $choices = $choicesWP;
                    break;
                    case "Trigger_WB_Boutique_1_P":
                        $choices = $choicesWB;
                    break;
                    default:
                        $choices = array(
                        "E-Commerce - Anniversaire d'Achat - FR" => '9',
                        "E-Commerce - Anniversaire d'Achat - EN" => '10',
                        "E-Commerce - Anniversaire d'Achat - NL" => '11',
                        "E-Commerce - Remerciement nouveau client - FR" => '12',
                        "E-Commerce - Remerciement nouveau client - EN" => '13',
                        "E-Commerce - Remerciement nouveau client - NL" => '14',
                        "E-Commerce - Remerciement déjà client - FR" => '15',  
                        "E-Commerce - Remerciement déjà client - EN" => '16',
                        "E-Commerce - Remerciement déjà client - NL" => '17',
                        );
                    break;
                }
            }
            elseif ($eshop == 2)
            {
                $choices = array(
                    "Anniversaire d'Achat - FR" => '0',
                    "Anniversaire d'Achat - EN" => '1',
                    "Anniversaire d'Achat - NL" => '2',
                    "Remerciement nouveau client - FR" => '3',
                    "Remerciement nouveau client - EN" => '4',
                    "Remerciement nouveau client - NL" => '5',
                    "Remerciement déjà client - FR" => '6',
                    "Remerciement déjà client - EN" => '7',
                    "Remerciement déjà client - NL" => '8',
                    "E-Commerce - Anniversaire d'Achat - FR" => '9',
                    "E-Commerce - Anniversaire d'Achat - EN" => '10',
                    "E-Commerce - Anniversaire d'Achat - NL" => '11',
                    "E-Commerce - Remerciement nouveau client - FR" => '12',
                    "E-Commerce - Remerciement nouveau client - EN" => '13',
                    "E-Commerce - Remerciement nouveau client - NL" => '14',
                    "E-Commerce - Remerciement déjà client - FR" => '15',  
                    "E-Commerce - Remerciement déjà client - EN" => '16',
                    "E-Commerce - Remerciement déjà client - NL" => '17',
                    );
            }
            else
            {
                if ( in_array($store, array('Bruxelles Louise', 'Inno Rue Neuve', 'Inno Woluwe'))) {
                    $choicesAA = array(
                            //'Sélectionner le modèle de votre choix' => '',
                            "Anniversaire d'Achat - FR" => '0',
                            "Anniversaire d'Achat - EN" => '1',
                            "Anniversaire d'Achat - NL" => '2',
                            );
                    $choicesWP = array(
                            "Remerciement nouveau client - FR" => '3',
                            "Remerciement nouveau client - EN" => '4',
                            "Remerciement nouveau client - NL" => '5',
                            );
                    $choicesWB = array(
                            "Remerciement déjà client - FR" => '6',
                            "Remerciement déjà client - EN" => '7',
                            "Remerciement déjà client - NL" => '8',
                            );
                }
                else{
                    $choicesAA = array(
                            //'Sélectionner le modèle de votre choix' => '',
                            "Anniversaire d'Achat - FR" => '0',
                            "Anniversaire d'Achat - EN" => '1',
                            );
                    $choicesWP = array(
                            "Remerciement nouveau client - FR" => '3',
                            "Remerciement nouveau client - EN" => '4',
                            );
                    $choicesWB = array(
                            "Remerciement déjà client - FR" => '6',
                            "Remerciement déjà client - EN" => '7',
                            );
                }

                switch($this->campaignId){
                    case "Trigger_AA_Boutique_1_E":
                        $choices = $choicesAA;
                    break;
                    case "Trigger_WP_Boutique_1_E":
                        $choices = $choicesWP;
                    break;
                    case "Trigger_WB_Boutique_1_E":
                        $choices = $choicesWB;
                    break;
                    case "Trigger_AA_Boutique_1_P":
                        $choices = $choicesAA;
                    break;
                    case "Trigger_WP_Boutique_1_P":
                        $choices = $choicesWP;
                    break;
                    case "Trigger_WB_Boutique_1_P":
                        $choices = $choicesWB;
                    break;
                    default:
                        $choices = array(
                        //'Sélectionner le modèle de votre choix' => '',
                        "Anniversaire d'Achat - FR" => '0',
                        "Anniversaire d'Achat - EN" => '1',
                        "Anniversaire d'Achat - NL" => '2',
                        "Remerciement nouveau client - FR" => '3',
                        "Remerciement nouveau client - EN" => '4',
                        "Remerciement nouveau client - NL" => '5',
                        "Remerciement déjà client - FR" => '6',
                        "Remerciement déjà client - EN" => '7',
                        "Remerciement déjà client - NL" => '8',
                        "E-Commerce - Anniversaire d'Achat - FR" => '9',
                        "E-Commerce - Anniversaire d'Achat - EN" => '10',
                        "E-Commerce - Anniversaire d'Achat - NL" => '11',
                        "E-Commerce - Remerciement nouveau client - FR" => '12',
                        "E-Commerce - Remerciement nouveau client - EN" => '13',
                        "E-Commerce - Remerciement nouveau client - NL" => '14',
                        "E-Commerce - Remerciement déjà client - FR" => '15',  
                        "E-Commerce - Remerciement déjà client - EN" => '16',
                        "E-Commerce - Remerciement déjà client - NL" => '17',
                        );
                    break;
                }
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
