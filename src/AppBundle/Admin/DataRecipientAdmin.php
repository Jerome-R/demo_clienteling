<?php
// src/AppBundle/Admin/Campaign.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class DataRecipientAdmin extends Admin
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
            //->add('idCampagne', 'text', array('required' => false, 'label' => "Campaign Id"))
            ->add('idCampagneName', 'choice', array(
                'choices' => array(
                    null    => 'Choisir une campagne',
                    'Trigger_AA_Boutique_1_P' => 'Trigger_AA_Boutique_1_P',
                    'Trigger_AA_Boutique_1_E' => 'Trigger_AA_Boutique_1_E',
                    'Trigger_WP_Boutique_1_P' => 'Trigger_WP_Boutique_1_P',
                    'Trigger_WP_Boutique_1_E' => 'Trigger_WP_Boutique_1_E',
                    'Trigger_WB_Boutique_1_P' => 'Trigger_WB_Boutique_1_P',
                    'Trigger_WB_Boutique_1_E' => 'Trigger_WB_Boutique_1_E',
                    'test_admin' => 'test_admin'
                    ),
                'required' => false
                )
            )
            ->add('client', 'sonata_type_model', array(
                'class'    => 'AppBundle\Entity\Client',
                'query' => $query,
                'property' => 'full_name'
            ))
            ->add('idClient', 'text',array('label' => "Client Id"))
            ->add('libelleBoutiqueAchat', 'text',array('label' => "Boutique d'achat"))
            ->add('dateEntree', 'date',array('required' => false, 'label' => "Date entree"))
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
            ->add('idCampagneName')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('idCampagneName')
            ->add('client')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Trigger
            ? false//$object->getCampaign()->getName()
            : 'DataRecipient'; // shown in the breadcrumb on the create view*/      
    }
}