<?php

namespace Weather\Test\Application\Mappers;

use Weather\Infrastracture\Mappers\MusementCityMapper;
use PHPUnit\Framework\TestCase;
use Weather\Domain\City;

class CityMapperTest extends TestCase
{
    public function testMapCityApiResponseIntoCity()
    {
        $apiReturn = [
            (object)[
                'name' => 'First City',
                'longitude' => 1.20,
                'latitude' => 2.30,
            ],
            (object)[
                'name' => 'Second City',
                'longitude' => 3.20,
                'latitude' => 4.30,
            ],
            (object)[
                'name' => 'Third City',
                'longitude' => 5.20,
                'latitude' => 6.30,
            ]
        ];

        $expectResult = [
            new City('First City', 1.20, 2.30),
            new City('Second City', 3.20, 4.30),
            new City('Third City', 5.20, 6.30),
        ];

        $result = (new MusementCityMapper())->mapCityApiResponseIntoCity(...$apiReturn);
        $this->assertEquals($result, $expectResult);
    }
}
