<?php

namespace Weather\Test\Application\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Weather\Infrastracture\Client\WeatherClient;
use Weather\Infrastracture\Mappers\WeatherMapper;
use PHPUnit\Framework\TestCase;
use Weather\Domain\City;
use Weather\Domain\Weather;

class WeatherServiceTest extends TestCase
{
    private Client $client;
    private MockHandler $mockHandler;

    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();
        $this->client = new Client([
            'handler' => $this->mockHandler,
        ]);
        parent::setUp();
    }

    public function testGetWeatherForCity()
    {
        $apiReturn = (object) [
            'forecast' => (object) [
                    'forecastday' => [
                        [
                            'day' => (object) [
                                'condition' => (object) [
                                    'text' => 'weather condition text'
                                ]
                            ]
                        ]
                    ]
            ]
        ];
        $this->mockHandler->append(new Response(200, [], json_encode($apiReturn)));
        $city = new City('City name', 1, 1);
        $response = (new WeatherClient($this->client, new WeatherMapper()))->getWeatherForCity($city);

        $this->assertEquals($response, new Weather($city->getName(), ...['weather condition text']));
    }
}
