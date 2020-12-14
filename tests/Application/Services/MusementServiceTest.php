<?php

namespace Weather\Test\Application\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Weather\Infrastracture\Client\MusementCityClient;
use Weather\Infrastracture\Mappers\MusementCityMapper;
use PHPUnit\Framework\TestCase;
use Weather\Domain\City;

class MusementServiceTest extends TestCase
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

    public function testGetCities()
    {
        $apiReturn = [
                (object) [
                    'name' => 'City name',
                    'longitude' => 100.20,
                    'latitude' => 100.30,
                ]
        ];
        $this->mockHandler->append(new Response(200, [], json_encode($apiReturn)));

        $response = (new MusementCityClient($this->client, new MusementCityMapper()))->getCities();
        $this->assertEquals($response, [new City('City name', 100.20, 100.30)]);
    }
}
