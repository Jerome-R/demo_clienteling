<?php
// src/AppBundle/Admin/Campaign.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TicketAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab("Ticket")
                ->add('number', 'text')                
                ->add('dateFacture', 'date')
                ->add('topClient', 'sonata_type_model', array(
                    'class'    => 'AppBundle\Entity\TopClient',
                    'property' => 'fullName'
                    )
                )
            ->end();
   }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('number');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('number', 'text')
            ->add('dateFacture', 'date')
            ->add('topClient')
        ;
    }

    public function toString($object)
    {
        return 'Ticket n°' . $object->getNumber() ; // shown in the breadcrumb on the create view        
    }
}