<?php
// src/AppBundle/Admin/Campaign.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ClientAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab("General informations")
                ->with("Client infos")
                    ->add('idClient', 'text')
                    ->add('nom', 'text')
                    ->add('prenom', 'text')
                    ->add('email', 'text', array('required' => false)) 
                    ->add('telephone1', 'text', array('required' => false))
                    ->add('telephone2', 'text', array('required' => false))
                    ->add('adresse1', 'text', array('required' => false))
                    ->add('adresse2', 'text', array('required' => false))
                    ->add('adresse3', 'text', array('required' => false))
                    ->add('codepostal', 'text', array('required' => false))
                    ->add('ville', 'text', array('required' => false))
                    ->add('pays', 'text', array('required' => false))
                    ->add('local', 'choice', array(
                        'choices' => array(
                            'f' => 'f',
                            't'  => 't',
                            '' => '',
                            ),
                        'required' => false
                        )
                    )
                ->end()
            ->end()
            ->tab("Rattachement")
                ->with("Vendeur")
                    ->add('codevendeur', 'text', array('required' => false))
                ->end()
                ->with("Boutique")
                    ->add('libelleBoutiqueRattachementTopclient', 'text', array('required' => false))
                    ->add('boutiqueRattachementTopclient', 'text', array('required' => false))
                    ->add('paysBoutiqueRattachement', 'text', array('required' => false))
                ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
            ->add('prenom')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('idClient')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('telephone1')
            ->add('telephone2')
            ->add('optOutEmail')
        ;
    }

    public function toString($object)
    {
        return "Client : " . $object->getFullName();
            //: 'Client boubou'; // shown in the breadcrumb on the create view*/        
    }
}