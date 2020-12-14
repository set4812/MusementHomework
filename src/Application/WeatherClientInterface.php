<?php

namespace Weather\Application;

use Weather\Domain\City;
use Weather\Domain\Weather;

interface WeatherClientInterface
{
    public function getWeatherForCity(City $city): Weather;

}