<?php

namespace Weather\Infrastracture\Mappers;

use stdClass;
use Weather\Domain\City;

class MusementCityMapper
{
    /**
     * @param stdClass ...$cityApiBodyResponse
     * @return array
     */
    public function mapCityApiResponseIntoCity(stdClass ...$cityApiBodyResponse): array
    {
        return array_map(static function ($city) {
            return new City($city->name, $city->longitude, $city->latitude);
        }, $cityApiBodyResponse);
    }
}
