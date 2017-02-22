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
 * @ORM\Table(name="app_client_suspect_doublon")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ClientSortantRepository")
 * @UniqueEntity(
 *     fields={"idClient", "dateArchive"},
 *     message="Duplicate entry for entries idClient - dateArchive."
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class ClientSuspectDoublon
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
     * @ORM\Column(name="libelle_boutique_rattachement", type="string", length=100, nullable=false)
     */
    private $libelleBoutiqueRattachement;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_boutique_origine", type="string", length=100, nullable=false)
     */
    private $libelleBoutiqueOrigine;

    /**
     * @var string
     *
     * @ORM\Column(name="id_paire", type="string", length=100, nullable=false)
     */
    private $idPaire;

    /**
     * @var string
     *
     * @ORM\Column(name="proximite", type="string", length=100, nullable=false)
     */
    private $proximite;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="clientSuspectDoublons")
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
     * Set libelleBoutiqueRattachement
     *
     * @param string $libelleBoutiqueRattachement
     * @return ClientSuspectDoublon
     */
    public function setLibelleBoutiqueRattachement($libelleBoutiqueRattachement)
    {
        $this->libelleBoutiqueRattachement = $libelleBoutiqueRattachement;

        return $this;
    }

    /**
     * Get libelleBoutiqueRattachement
     *
     * @return string 
     */
    public function getLibelleBoutiqueRattachement()
    {
        return $this->libelleBoutiqueRattachement;
    }

    /**
     * Set libelleBoutiqueOrigine
     *
     * @param string $libelleBoutiqueOrigine
     * @return ClientSuspectDoublon
     */
    public function setLibelleBoutiqueOrigine($libelleBoutiqueOrigine)
    {
        $this->libelleBoutiqueOrigine = $libelleBoutiqueOrigine;

        return $this;
    }

    /**
     * Get libelleBoutiqueOrigine
     *
     * @return string 
     */
    public function getLibelleBoutiqueOrigine()
    {
        return $this->libelleBoutiqueOrigine;
    }

    /**
     * Set idPaire
     *
     * @param string $idPaire
     * @return ClientSuspectDoublon
     */
    public function setIdPaire($idPaire)
    {
        $this->idPaire = $idPaire;

        return $this;
    }

    /**
     * Get idPaire
     *
     * @return string 
     */
    public function getIdPaire()
    {
        return $this->idPaire;
    }

    /**
     * Set proximite
     *
     * @param string $proximite
     * @return ClientSuspectDoublon
     */
    public function setProximite($proximite)
    {
        $this->proximite = $proximite;

        return $this;
    }

    /**
     * Get proximite
     *
     * @return string 
     */
    public function getProximite()
    {
        return $this->proximite;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     * @return ClientSuspectDoublon
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }
}
