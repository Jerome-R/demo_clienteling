<?php
// src/AppBundle/Admin/Campaign.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class LinkAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
        ->add('campaign', 'sonata_type_model', array(
                'class'    => 'AppBundle\Entity\Campaign',
                'property' => 'name',
                'empty_value' => ''
            )) 
        ->add('name', 'text', array(
                'required' => false
                )
            )
        ->add('url', 'text', array(
                'required' => false
                )
            )
        ->add('lang', 'choice', array(
                        'choices' => array(
                            null    => 'Select a language',
                            'fr' => 'fr',
                            'en'  => 'en',
                            'nl' => 'nl',
                            'it' => 'it',
                            ),
                        'required' => false,
                        'label' => 'Langue'
                        )
                    )
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('campaign', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\Campaign',
                'property' => 'name',
                'multiple' => true
            ))
            ->add('lang')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('campaign', 'associated_property')
            ->add('name')
            ->add('url')
            ->add('lang')
        ;
    }
    public function toString($object)
    {
        return $object instanceof Recipient
            ? false//$object->getCampaign()->getName()
            : 'Link'; // shown in the breadcrumb on the create view*/        
    }
}