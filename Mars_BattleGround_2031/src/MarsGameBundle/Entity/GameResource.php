<?php

namespace MarsGameBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Resource
 *
 * @ORM\Table(name="resources")
 * @ORM\Entity(repositoryClass="MarsGameBundle\Repository\ResourceRepository")
 */
class GameResource
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var BuildingCostResource[]
     *
     * @ORM\OneToMany(targetEntity="MarsGameBundle\Entity\BuildingCostResource", mappedBy="resource")
     */
    private $buildingCosts;

    /**
     * @var CityResource[]
     *
     * @ORM\OneToMany(targetEntity="MarsGameBundle\Entity\CityResource", mappedBy="resource")
     */
    private $cityResources;

    public function __construct()
    {
        $this->cityResources = new ArrayCollection();
        $this->buildingCosts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return BuildingCostResource[]
     */
    public function getBuildingCosts()
    {
        return $this->buildingCosts;
    }

    /**
     * @param BuildingCostResource[] $buildingCosts
     */
    public function setBuildingCosts(array $buildingCosts)
    {
        $this->buildingCosts = $buildingCosts;
    }

    /**
     * @return CityResource[]
     */
    public function getCityResources()
    {
        return $this->cityResources;
    }

    /**
     * @param CityResource[] $cityResources
     */
    public function setCityResources(array $cityResources)
    {
        $this->cityResources = $cityResources;
    }

}

