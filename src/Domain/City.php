<?php

namespace Weather\Domain;

class City
{
    private string $name;
    private float $longitude;
    private float $latitude;

    public function __construct(string $name, float $longitude, float $latitude)
    {
        $this->name = $name;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }
}
