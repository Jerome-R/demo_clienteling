<?php
// src/AppBundle/Admin/Campaign.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RecipientAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $em = $this->modelManager->getEntityManager('AppBundle:Client');
        
        $query = $em->createQueryBuilder('c')
                ->select('c')
                ->from('AppBundle:Client', 'c')
                ->where("c.idClient like '%test%'")
                ->setMaxResults(100);
                ;

        $formMapper
        ->add('campaign', 'sonata_type_model', array(
                'class'    => 'AppBundle\Entity\Campaign',
                'property' => 'name'
            ))
        ->add('client', 'sonata_type_model', array(
                'class'    => 'AppBundle\Entity\Client',
                'query' => $query,
                'property' => 'full_name'
            ))
        ->add('dataRecipient', 'sonata_type_model', array(
                'class'    => 'AppBundle\Entity\DataRecipient',
                'property' => 'full_name'
            )) 
        ->add('canal', 'choice', array(
                'choices' => array(
                    null    => 'Select a channel',
                    'Email' => 'Email',
                    'Mail'  => 'Mail',
                    'Phone' => 'Phone',
                    'SMS'   => 'SMS',
                    ),
                'required' => false
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
        ));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('campaign', 'associated_property')
            ->add('client', 'associated_property')
            ->add('contactedAt')
            ->add('optIn')
        ;
    }
    public function toString($object)
    {
        return $object instanceof Recipient
            ? false//$object->getCampaign()->getName()
            : 'Recipient'; // shown in the breadcrumb on the create view*/        
    }
}