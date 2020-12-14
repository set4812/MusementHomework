<?php

namespace Weather\Application;

class CityWeatherCondition
{
    private string $cityName;
    /** @var string[]  */
    private array $conditions;

    public function __construct(string $cityName, string ...$condition)
    {
        $this->cityName = $cityName;
        $this->conditions = $condition;
    }

    public function getCityName(): string
    {
        return $this->cityName;
    }

    /**
     * @return string[]
     */
    public function getConditions(): array
    {
        return $this->conditions;
    }
}