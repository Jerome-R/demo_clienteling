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

class ClientsFilterType extends AbstractType
{
    private $em;
    private $user;
    private $rm;

    public function __construct(EntityManager $em, User $user, $rm){
        $this->em = $em;
        $this->user = $user;
        $this->rm = $rm;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('local', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices' => array(
                    ''      => "Locaux et non locaux",
                    't'     => 'Locaux',
                    'f'     => 'Non locaux',
                    ),
                'required' => false,
                )
            )
            ->add('codevendeur', 'text', array('required' => false))
            ->add('fullName', 'text', array('required' => false))
            ->add('filters', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
              'choices' => array(
                    'Activités' => array(
                      'Inactifs 6 mois'            => 'inactif',
                      'Actifs 6 mois'              => 'actif',
                      //'Top du top'                 => 'top',
                      //'One Timer'                  => 'newClient',
                    ),
                    'Contactabilité' => array(
                      'Opt In'               => 'optin',
                      //'Print'              => 'mail',
                      //'Email'              => 'email',
                      //'Téléphone'          => 'phone',
                    ),
                    /*'Triggers' => array(
                      'Anniversaire d\'achat'   => 'aa',
                      'Welcome process'         => 'wp',
                      'Welcome back'            => 'wb',
                    ),
                    'Collections' => array(
                      'Nouvelle collection'     => 'newCollection',
                      'Sac Bianca'              => 'bianca',
                      'Sac Charile'             => 'charlie',
                      'Sac Le Huit'             => 'huit',
                    ),*/
                ),
              'choices_as_values' => true,
              'required' => false,
              'multiple' => true
              )
            )
            ->add('page', 'hidden', array('required' => false, 'empty_data' => '1'))
            ->add('submit', 'submit')
        ;


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
          $form = $event->getForm();
          $data = $event->getData();

          
          //get fields value for custom queries

          if ( $this->user->hasRole('ROLE_SIEGE') OR $this->user->hasRole('ROLE_ADMIN') ) {
            $form->add('retailManager', 'entity', array(
              'class' => 'ApplicationSonataUserBundle:User',
              'property' => 'libelle',
              'query_builder' => function(EntityRepository $er) {
                  return $er->createQueryBuilder('u')
                            ->where('u.role = :role')
                            ->setParameter('role', 'ROLE_RETAIL_MANAGER')
                            ->orderBy('u.libelle', 'ASC')
                            ;
                },
                'empty_value' => 'Tous les Retail Managers',
                'required' => false
              //,'data' => $this->em->getReference("ApplicationSonataUserBundle:User", null)
              )
            );
          }

          if ( $this->user->hasRole('ROLE_RETAIL_MANAGER') OR $this->user->hasRole('ROLE_SIEGE') OR $this->user->hasRole('ROLE_DIRECTEUR') OR $this->user->hasRole('ROLE_ADMIN') ) {

            if( $this->user->hasRole('ROLE_SIEGE') OR $this->user->hasRole('ROLE_ADMIN') )
            {
              if($this->rm == null){
                $form->add('libelleBoutiqueRattachement', 'entity', array(
                  'class' => 'ApplicationSonataUserBundle:User',
                  'property' => 'libelle',
                  'query_builder' => function(EntityRepository $er) {
                      return $er->createQueryBuilder('u')
                                ->where('u.role = :role')
                                ->andWhere('u.enabled = 1')
                                ->setParameter('role', 'ROLE_BOUTIQUE')
                                ->orderBy('u.libelle', 'ASC')
                                ;
                    },
                    'empty_value' => 'Toutes les boutiques',
                    'required' => false
                  //,'data' => $this->em->getReference("ApplicationSonataUserBundle:User", null)
                  )
                );
              }
              else{
                $form->add('libelleBoutiqueRattachement', 'entity', array(
                  'class' => 'ApplicationSonataUserBundle:User',
                  'property' => 'libelle',
                  'query_builder' => function(EntityRepository $er) {
                      return $er->createQueryBuilder('u')
                                ->where('u.role = :role')
                                ->andWhere('u.enabled = 1')
                                ->andWhere('u.retailManager = :rm')
                                ->setParameter('rm', $this->rm)
                                ->setParameter('role', 'ROLE_BOUTIQUE')
                                ->orderBy('u.libelle', 'ASC')
                                ;
                    },
                    'empty_value' => 'Toutes les boutiques',
                    'required' => false
                  //,'data' => $this->em->getReference("ApplicationSonataUserBundle:User", null)
                  )
                );
              }
            }
            elseif( $this->user->hasRole('ROLE_DIRECTEUR') ) {

                $form->add('libelleBoutiqueRattachement', 'entity', array(
                  'class' => 'ApplicationSonataUserBundle:User',
                  'property' => 'libelle',
                  'query_builder' => function(EntityRepository $er) {
                      return $er->createQueryBuilder('u')
                                ->where('u.role = :role')
                                ->andWhere('u.enabled = 1')
                                ->setParameter('role', 'ROLE_BOUTIQUE')
                                ->andWhere('u.directeur = :directeur')
                                ->setParameter('directeur', $this->user->getLibelle())
                                ->orderBy('u.libelle', 'ASC')
                                ;
                    },
                    'empty_value' => 'Toutes les boutiques',
                    'required' => false
                  //,'data' => $this->em->getReference("ApplicationSonataUserBundle:User", null)
                  )
                );
              }
              else{
                $form->add('libelleBoutiqueRattachement', 'entity', array(
                  'class' => 'ApplicationSonataUserBundle:User',
                  'property' => 'libelle',
                  'query_builder' => function(EntityRepository $er) {
                      return $er->createQueryBuilder('u')
                                ->where('u.role = :role')
                                ->andWhere('u.enabled = 1')
                                ->setParameter('role', 'ROLE_BOUTIQUE')
                                ->andWhere('u.retailManager = :rm')
                                ->setParameter('rm', $this->rm)
                                ->orderBy('u.libelle', 'ASC')
                                ;
                    },
                    'empty_value' => 'Toutes les boutiques',
                    'required' => false
                  //,'data' => $this->em->getReference("ApplicationSonataUserBundle:User", null)
                  )
                );
              }
            }

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
        return 'appbundle_clients_filter';
    }
}
