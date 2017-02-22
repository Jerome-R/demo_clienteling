<?php
// src/AppBundle/Admin/Campaign.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class LigneVenteAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab("Ligne de vente")
                ->add('codeuvc', 'text')
                ->add('quantite', 'integer')
                ->add('cattc', 'integer')
                ->add('superLigneDesc', 'text')
                ->add('genreDesc', 'text')
                ->add('ticket', 'sonata_type_model', array(
                    'class'    => 'AppBundle\Entity\Ticket',
                    'property' => 'number'
                    )
                )
            ->end();
   }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('dateFacture')
            ->add('codeuvc')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('quantite', 'integer')
            ->add('cattc', 'integer')
            ->add('superLigneDesc', 'text')
            ->add('genreDesc', 'text')
            ->add('dateFacture', 'date')
        ;
    }

    public function toString($object)
    {
        return 'Ligne n°' . $object->getId() ; // shown in the breadcrumb on the create view        
    }
}