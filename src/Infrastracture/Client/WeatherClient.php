<?php

namespace Weather\Infrastracture\Client;

use GuzzleHttp\Client;
use Weather\Application\WeatherClientInterface;
use Weather\Domain\City;
use Weather\Domain\Weather;
use Weather\Infrastracture\Mappers\WeatherMapper;

class WeatherClient implements WeatherClientInterface
{
    private Client $client;
    private WeatherMapper $mapper;

    public function __construct(Client $client, WeatherMapper $mapper)
    {
        $this->client = $client;
        $this->mapper = $mapper;
    }

    public function getWeatherForCity(City $city): Weather
    {
        $weather = $this->client->get('/v1/forecast.json', [
            'query' => [
            'q' => $city->getLatitude() . ',' . $city->getLongitude(),
            'key' => '00632c0d9556497d91a04506201312',
            'days' => 2
            ]
        ]);

        $deserializedResponse = json_decode($weather->getBody());

        return $this->mapper->mapForecastDaysIntoWeather(
            $city->getName(),
            ...$deserializedResponse->forecast->forecastday
        );
    }
}
