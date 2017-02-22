<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

//To get access to the EntityManager and UnitOfWork APIs inside these callback methods.
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Recipient
 *
 * @ORM\Table(name="app_client_sortant", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="UNIQUE_CL_DATE", columns={"client_id", "date_archive"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ClientSortantRepository")
 * @UniqueEntity(
 *     fields={"idClient", "dateArchive"},
 *     message="Duplicate entry for entries idClient - dateArchive."
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class ClientSortant
{
	/**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="id_client", type="string", length=255, unique=true)
     */
    private $idClient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_archive", type="date", nullable=true)
     */
    private $dateArchive;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="clientSortants")
     * @ORM\JoinColumn(name="client_id", nullable=true)
     */
    protected $client;

    public function __construct()
    {	
    	$this->client = null;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get idClient
     *
     * @return string
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * Set idClient
     *
     * @return ClientSortant
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Set dateArchive
     *
     * @param \DateTime $dateArchive
     *
     * @return ClientSortant
     */
    public function setDateArchive($dateArchive)
    {
        if( !($dateArchive instanceof \DateTime) ) $dateArchive = new \DateTime($dateArchive);
        $this->dateArchive = $dateArchive;

        return $this;
    }

    /**
     * Get dateArchive
     *
     * @return \DateTime
     */
    public function getDateArchive()
    {
        return $this->dateArchive;
    }



    public function getClient()
    {
        return $this->client;
    }

    public function setClient(Client $client = null)
    {
        $this->client = $client;
        return $this;
    }
}