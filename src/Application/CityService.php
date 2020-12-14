<?php

namespace Weather\Application;

use Weather\Domain\City;

class CityService
{
    private WeatherClientInterface $weatherClient;
    private CityClientInterface $cityClient;

    public function __construct(WeatherClientInterface $weatherClient, CityClientInterface $cityClient)
    {
        $this->weatherClient = $weatherClient;
        $this->cityClient = $cityClient;
    }

    /**
     * @return CityWeatherCondition[]
     */
    public function getWeatherConditionsForCities(): array
    {
        $cities = $this->cityClient->getCities();

        return array_map(function (City $city) {
            $weather = $this->weatherClient->getWeatherForCity($city);

            return new CityWeatherCondition($weather->getLocationName(), ...$weather->getConditionText());
        }, $cities);
    }

}