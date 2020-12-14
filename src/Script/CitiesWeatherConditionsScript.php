<?php

namespace Weather\Script;

use Weather\Application\CityService;

class CitiesWeatherConditionsScript
{
    private CityService $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function run()
    {
        foreach ($this->cityService->getWeatherConditionsForCities() as $city) {
            $textMessage = 'Processed city ' .
                $city->getCityName() .
                ' | ' .
                join(' - ', $city->getConditions()) .
                PHP_EOL;

            fwrite(
                STDOUT,
                $textMessage
            );
        }
    }
}
