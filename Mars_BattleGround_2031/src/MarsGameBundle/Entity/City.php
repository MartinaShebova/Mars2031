<?php

namespace MarsGameBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 *
 * @ORM\Table(name="cities")
 * @ORM\Entity(repositoryClass="MarsGameBundle\Repository\CityRepository")
 */
class City
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
     * @ORM\Column(name="city_name", type="string", length=255)
     */
    private $cityName;

    /**
     * @var int
     *
     * @ORM\Column(name="x", type="integer")
     */
    private $x;

    /**
     * @var int
     *
     * @ORM\Column(name="y", type="integer")
     */
    private $y;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="MarsGameBundle\Entity\Player", inversedBy="cities")
     * @ORM\JoinColumn(name="player_id")
     */
    private $player;

    /**
     * @var CityResource[]
     *
     * @ORM\OneToMany(targetEntity="MarsGameBundle\Entity\CityResource", mappedBy="city")
     */
    private $resources;

    /**
     * @var CityBuildings[]
     *
     * @ORM\OneToMany(targetEntity="MarsGameBundle\Entity\CityBuildings", mappedBy="city")
     */
    private $buildings;


    public function __construct()
    {
        $this->resources = new ArrayCollection();
        $this->buildings = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
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
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * @param string $cityName
     */
    public function setCityName(string $cityName)
    {
        $this->cityName = $cityName;
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param int $x
     */
    public function setX(int $x)
    {
        $this->x = $x;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param int $y
     */
    public function setY(int $y)
    {
        $this->y = $y;
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param Player $player
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @return CityResource[]
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * @param CityResource[] $resources
     */
    public function setResources(array $resources)
    {
        $this->resources = $resources;
    }

    /**
     * @return CityBuildings[]
     */
    public function getBuildings()
    {
        return $this->buildings;
    }

    /**
     * @param CityBuildings[] $buildings
     */
    public function setBuildings(array $buildings)
    {
        $this->buildings = $buildings;
    }

}

