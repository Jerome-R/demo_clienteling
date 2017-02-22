<?php
// src/AppBundle/Admin/Campaign.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class DateImportAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('dateImport', 'date', array('label' => "Date"))
            ->add('module', 'choice', array(
                'choices' => array(
                    'top_clients'       => 'Top Clients',
                    'triggers_clients'  => 'Triggers Clients',
                    'kpis'              => 'Kpis',
                    ),
                'label'    => "Module",
                'required' => false
                )
            )
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('module')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('dateImport')
            ->add('module')
        ;
    }

    public function toString($object)
    {
        return $object->getFullName();
            //: 'Client boubou'; // shown in the breadcrumb on the create view*/        
    }
}