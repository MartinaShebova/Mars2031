<?php

namespace MarsGameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Time;

/**
 * CityBuildings
 *
 * @ORM\Table(name="city_buildings")
 * @ORM\Entity(repositoryClass="MarsGameBundle\Repository\CityBuildingsRepository")
 */
class CityBuildings
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
     * @var City
     * @ORM\ManyToOne(targetEntity="MarsGameBundle\Entity\City", inversedBy="buildings")
     * @ORM\JoinColumn(name="city_id")
     */
    private $city;

    /**
     * @var Building
     *
     * @ORM\ManyToOne(targetEntity="MarsGameBundle\Entity\Building", inversedBy="cityBuildings")
     * @ORM\JoinColumn(name="building_id")
     */
    private $building;

    /**
     * @var int
     *
     * @ORM\Column(name="resources_per_hour", type="integer")
     */
    private $resourcesPerHour;
    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(name="time_to_get_build", type="integer")
     */
    private $timeToGetBuild;

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
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param City $city
     */
    public function setCity(City $city)
    {
        $this->city = $city;
    }

    /**
     * @return Building
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * @param Building $building
     */
    public function setBuilding(Building $building)
    {
        $this->building = $building;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level)
    {
        $this->level = $level;
    }

    /**
     * @return int
     */
    public function getResourcesPerHour()
    {
        return $this->resourcesPerHour;
    }

    /**
     * @param int $resourcesPerHour
     */
    public function setResourcesPerHour(int $resourcesPerHour)
    {
        $this->resourcesPerHour = $resourcesPerHour;
    }

    /**
     * @return int
     */
    public function getTimeToGetBuild()
    {
        return $this->timeToGetBuild;
    }

    /**
     * @param int $timeToGetBuild
     */
    public function setTimeToGetBuild(int $timeToGetBuild)
    {
        $this->timeToGetBuild = $timeToGetBuild;
    }


}

