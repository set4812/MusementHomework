<?php

use DI\Container;
use GuzzleHttp\Client;
use Weather\Application\CityClientInterface;
use Weather\Application\CityService;
use Weather\Application\WeatherClientInterface;
use Weather\Infrastracture\Client\MusementCityClient;
use Weather\Infrastracture\Client\WeatherClient;
use Weather\Infrastracture\Mappers\MusementCityMapper;
use Weather\Infrastracture\Mappers\WeatherMapper;
use Weather\Script\CitiesWeatherConditionsScript;

return [
    'MusementHttpClient' =>  function () {
        return new Client(
            [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'base_uri' => 'https://api.musement.com'
            ]
        );
    },
    'WeatherHttpClient' =>  function () {
        return new Client(
            [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'base_uri' => 'https://api.weatherapi.com',

            ]
        );
    },
    CityClientInterface::class => function (Container $container) {
        return new MusementCityClient($container->get('MusementHttpClient'), new MusementCityMapper());
    },
    WeatherClientInterface::class => function (Container $container) {
        return new WeatherClient($container->get('WeatherHttpClient'), new WeatherMapper());
    },
    CitiesWeatherConditionsScript::class => function (Container $container) {
        return new CitiesWeatherConditionsScript(
            $container->get(CityService::class),
        );
    },
];
