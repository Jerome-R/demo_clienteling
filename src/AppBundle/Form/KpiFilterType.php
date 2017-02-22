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

class KpiFilterType extends AbstractType
{
    private $em;
    private $user;
    private $rm;
    private $month;
    private $year;

    public function __construct(EntityManager $em, User $user, $month, $year){
        $this->em = $em;
        $this->user = $user;
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('year', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
            'choices' => array(
                  '2015'   => '2015',
                  '2016'   => '2016',
                  '2017'   => '2017',
              ),
            'choices_as_values' => true,
            'required' => false,
            'data' => '2017',
            'empty_value' => false,
            )
          )
          ->add('submit', 'submit')
        ;


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {          
          $form = $event->getForm();
          $data = $event->getData();

          // Configuration des mois à afficher
          $form->add('year', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
            'choices' => array(
                  '2015'   => '2015',
                  '2016'   => '2016',
                  '2017'   => '2017',
              ),
            'choices_as_values' => true,
            'required' => false,
            'data' => $this->year,
            'empty_value' => false,
            )
          );

          // Configuration des mois à afficher
          $form->add('month', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
            'choices' => array(
                  'Janvier'     => '01',
                  'Février'     => '02',
                  'Mars'        => '03',
                  'Avril'       => '04',
                  'Mai'         => '05',
                  'Juin'        => '06',
                  'Juillet'     => '07',
                  'Août'        => '08',
                  'Septembre'   => '09',
                  'Octobre'     => '10',
                  'Novembre'    => '11',
                  'Décembre'    => '12',
              ),
            'choices_as_values' => true,
            'required' => false,
            'data' => $this->month,
            'empty_value' => false
            )
          );

          // Configuration de la liste des boutiques à afficher
          
          //get fields value for custom queries

          if ( $this->user->hasRole('ROLE_SIEGE') OR $this->user->hasRole('ROLE_ADMIN') ) {
            $form->add('boutique', 'entity', array(
              'class' => 'ApplicationSonataUserBundle:User',
              'property' => 'libelle',
              'query_builder' => function(EntityRepository $er) {
                  return $er->createQueryBuilder('u')
                            ->where(' (u.role = :role OR u.role = :roleRm)')
                            ->setParameter('role', 'ROLE_BOUTIQUE')
                            ->setParameter('roleRm', 'ROLE_RETAIL_MANAGER')
                            ->add('orderBy','u.role DESC ,u.libelle ASC')
                            ;
                },
                'empty_value' => 'Global',
                'required' => false
              //,'data' => $this->em->getReference("ApplicationSonataUserBundle:User", null)
              )
            );
          }

          if ( $this->user->hasRole('ROLE_RETAIL_MANAGER') ) {
            switch ($this->user->getLibelle()) {
              case 'Elisa Piano':
                  $empty_value = "Elisa Piano";
                break;
              case 'Mathieu Guillemet':
                  $empty_value = "Mathieu Guillemet";
                break;
              case 'Stéphanie Nguyen':
                  $empty_value = "Stéphanie Nguyen";
                break;
              case 'Lucas Madranges':
                  $empty_value = "Lucas Madranges";
                break;
              case 'Marie Raphaelle L\'Huillier':
                  $empty_value = "Marie Raphaelle L'Huillier";
                break;
              
              default:
                $empty_value = false;
                break;
            }

            $form->add('boutique', 'entity', array(
              'class' => 'ApplicationSonataUserBundle:User',
              'property' => 'libelle',
              'query_builder' => function(EntityRepository $er) {
                  return $er->createQueryBuilder('u')
                            ->where('u.role = :role')
                            ->andWhere('u.retailManager = :rm')
                            ->setParameter('role', 'ROLE_BOUTIQUE')
                            ->setParameter('rm', $this->user->getLibelle())
                            ->orderBy('u.libelle', 'ASC')
                            ;
                },
                'empty_value' => $empty_value,
                'required' => false
              //,'data' => $this->em->getReference("ApplicationSonataUserBundle:User", null)
              )
            );
          }

          if ( $this->user->hasRole('ROLE_DIRECTEUR') ) {
            $form->add('boutique', 'entity', array(
              'class' => 'ApplicationSonataUserBundle:User',
              'property' => 'libelle',
              'query_builder' => function(EntityRepository $er) {
                  return $er->createQueryBuilder('u')
                            ->where('u.role = :role')
                            ->andWhere('u.directeur = :dr')
                            ->setParameter('role', 'ROLE_BOUTIQUE')
                            ->setParameter('dr', $this->user->getLibelle())
                            ->orderBy('u.libelle', 'ASC')
                            ;
                },
                'empty_value' => false,
                'required' => false
              //,'data' => $this->em->getReference("ApplicationSonataUserBundle:User", null)
              )
            );
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
        return 'appbundle_kpi_filter';
    }
}
