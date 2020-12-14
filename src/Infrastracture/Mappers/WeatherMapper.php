<?php

namespace Weather\Infrastracture\Mappers;

use stdClass;
use Weather\Domain\Weather;

class WeatherMapper
{
    /**
     * @param string $cityName
     * @param stdClass ...$forecastDays
     * @return Weather
     */
    public function mapForecastDaysIntoWeather(string $cityName, stdClass ...$forecastDays): Weather
    {
         $forecastCondition = array_map(static function ($forecastday) {
            return $forecastday->day->condition->text;
         }, $forecastDays);

         return new Weather($cityName, ...$forecastCondition);
    }
}
