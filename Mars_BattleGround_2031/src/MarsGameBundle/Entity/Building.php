<?php

namespace MarsGameBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Building
 *
 * @ORM\Table(name="building")
 * @ORM\Entity(repositoryClass="MarsGameBundle\Repository\BuildingRepository")
 */
class Building
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
     * @var BuildingCostResource[]
     *
     * @ORM\OneToMany(targetEntity="MarsGameBundle\Entity\BuildingCostResource", mappedBy="building")
     */
    private $costs;

    /**
     * @var BuildingCostTime
     *
     * @ORM\OneToOne(targetEntity="MarsGameBundle\Entity\BuildingCostTime", mappedBy="building")
     */
    private $timeCost;

    /**
     * @var CityBuildings[]
     *
     * @ORM\OneToMany(targetEntity="MarsGameBundle\Entity\CityBuildings", mappedBy="building")
     */
    private $cityBuildings;

    /**
     * @var string
     *
     * @ORM\Column(name="building_name", type="string", length=255, unique=true)
     */
    private $buildingName;

    public function __construct()
    {
        $this->costs = new ArrayCollection();
        $this->cityBuildings = new ArrayCollection();
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
     * @return BuildingCostResource[]
     */
    public function getCosts()
    {
        return $this->costs;
    }

    /**
     * @param BuildingCostResource[] $costs
     */
    public function setCosts(array $costs)
    {
        $this->costs = $costs;
    }

    /**
     * @return BuildingCostTime
     */
    public function getTimeCost()
    {
        return $this->timeCost;
    }

    /**
     * @param BuildingCostTime $timeCost
     */
    public function setTimeCost(BuildingCostTime $timeCost)
    {
        $this->timeCost = $timeCost;
    }

    /**
     * @return CityBuildings[]
     */
    public function getCityBuildings()
    {
        return $this->cityBuildings;
    }

    /**
     * @param CityBuildings[] $cityBuildings
     */
    public function setCityBuildings(array $cityBuildings)
    {
        $this->cityBuildings = $cityBuildings;
    }

    /**
     * @return string
     */
    public function getBuildingName()
    {
        return $this->buildingName;
    }

    /**
     * @param string $buildingName
     */
    public function setBuildingName(string $buildingName)
    {
        $this->buildingName = $buildingName;
    }

}

