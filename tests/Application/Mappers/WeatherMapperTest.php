<?php

namespace Weather\Test\Application\Mappers;

use Weather\Infrastracture\Mappers\WeatherMapper;
use PHPUnit\Framework\TestCase;
use Weather\Domain\Weather;

class WeatherMapperTest extends TestCase
{
    public function testMapForecastDaysIntoWeather()
    {
        $forecastDays = [
            (object) [
                'day' => (object) [
                    'condition' => (object) [
                        'text' => 'weather condition 1'
                    ]
                ]
            ],
            (object) [
                'day' => (object) [
                    'condition' => (object) [
                        'text' => 'weather condition 2'
                    ]
                ]
            ],
            (object) [
                'day' => (object) [
                    'condition' => (object) [
                        'text' => 'weather condition 3'
                    ]
                ]
            ],
            (object) [
                'day' => (object) [
                    'condition' => (object) [
                        'text' => 'weather condition 4'
                    ]
                ]
            ],
        ];
        $cityName = 'Name of city forecast';

        $result = (new WeatherMapper())->mapForecastDaysIntoWeather($cityName, ...$forecastDays);

        $this->assertEquals($result, new Weather($cityName, ...[
            'weather condition 1',
            'weather condition 2',
            'weather condition 3',
            'weather condition 4',
        ]));
    }
}
