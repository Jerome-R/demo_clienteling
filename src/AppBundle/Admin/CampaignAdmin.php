<?php
// src/AppBundle/Admin/Campaign.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use AppBundle\Form\ImageType;

class CampaignAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab("General informations")
                ->with("Content")
                    ->add('name', 'text')
                    ->add('brand', 'text', array('required' => false, 'label' => "Brand (Uppercase)"))
                    ->add('idCampaignName', 'text', array('required' => false, 'label' => "Campaign Id (for trigger)"))
                    ->add('type', 'choice', array(
                        'choices' => array(
                            'trigger'  => 'Trigger',
                            'adHoc' => 'Ad Hoc',
                            ),
                        'required' => false,
                        'label' => 'Type de campagne'
                        )
                    )
                    ->add('description', 'textarea', array('required' => false))
                    ->add('activeCampaign', 'checkbox', array('required' => false, 'label' => "Active for Module Campaign"))
                    ->add('activeKpi', 'checkbox', array('required' => false, 'label' => "Active for Module Kpi"))
                    ->add('visible', 'checkbox', array('required' => false, 'label' => "Visible"))
                    ->add('visibleBy', 'text', array('label' => "Afficher pour (all pour toutes les boutiques, séparer par une virgule pour plusieurs, pas d'espace entre les virgules)"))
                ->end()
                ->with("Kpis Module")
                    ->add( 'image', new ImageType(), array('required' => false,'label' => 'Image') )
                ->end()
                ->with("Dates")
                    ->add('startDate', 'date')
                    ->add('endDate', 'date')
                ->end()
                ->with('Canals priority')
                    ->add('canalOne', 'choice', array(
                        'choices' => array(
                            null    => 'Select a canal',
                            'Email' => 'Email',
                            'Mail'  => 'Mail',
                            'Phone' => 'Phone',
                            'SMS'   => 'SMS',
                            ),
                        'required' => false,
                        'label' => 'Priority 1'
                        )
                    )
                    ->add('canalTwo', 'choice', array(
                        'choices' => array(
                            null    => 'Select a canal',
                            'Email' => 'Email',
                            'Mail'  => 'Mail',
                            'Phone' => 'Phone',
                            'SMS'   => 'SMS',
                            ),
                        'required' => false,
                        'label' => 'Priority 2'
                        )
                    )
                    ->add('canalThree', 'choice', array(
                        'choices' => array(
                            null    => 'Select a canal',
                            'Email' => 'Email',
                            'Mail'  => 'Mail',
                            'Phone' => 'Phone',
                            'SMS'   => 'SMS',
                            ),
                        'required' => false,
                        'label' => 'Priority 3'
                        )
                    )
                    ->add('canalFour', 'choice', array(
                        'choices' => array(
                            null    => 'Select a canal',
                            'Email' => 'Email',
                            'Mail'  => 'Mail',
                            'Phone' => 'Phone',
                            'SMS'   => 'SMS',
                            ),
                        'required' => false,
                        'label' => 'Priority 4'
                        )
                    )
                ->end()
            ->end()
        ;
        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
        $datagridMapper->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('name')
            ->add('type')
            ->add('canalOne')
            ->add('activeCampaign')
            ->add('activeKpi')
            ->add('visibleBy')
            ->add('state')
        ;
    }

    public function toString($object)
    {
        return 'Campaign' . $object->getName() ; // shown in the breadcrumb on the create view        
    }
}