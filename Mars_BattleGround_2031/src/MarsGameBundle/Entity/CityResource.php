<?php

namespace MarsGameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CityResources
 *
 * @ORM\Table(name="city_resources")
 * @ORM\Entity(repositoryClass="MarsGameBundle\Repository\CityResourcesRepository")
 */
class CityResource
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
     * @ORM\ManyToOne(targetEntity="MarsGameBundle\Entity\City", inversedBy="resources")
     * @ORM\JoinColumn(name="city_id")
     */
    private $city;

    /**
     * @var GameResource
     * @ORM\ManyToOne(targetEntity="MarsGameBundle\Entity\GameResource", inversedBy="cityResources")
     * @ORM\JoinColumn(name="resource_id")
     */
    private $resource;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

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
     * @return GameResource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param GameResource $resource
     */
    public function setResource(GameResource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }
}

