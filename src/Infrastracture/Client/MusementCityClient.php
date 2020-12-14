<?php

namespace Weather\Infrastracture\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Weather\Application\CityClientInterface;
use Weather\Domain\City;
use Weather\Infrastracture\Mappers\MusementCityMapper;

class MusementCityClient implements CityClientInterface
{
    private Client $client;
    private MusementCityMapper $mapper;

    public function __construct(Client  $client, MusementCityMapper $mapper)
    {
        $this->client = $client;
        $this->mapper = $mapper;
    }

    /**
     * @return array|City[]
     * @throws GuzzleException
     */
    public function getCities(): array
    {
        $response = $this->client->get('/api/v3/cities.json');
        $deserializedCityBody = json_decode($response->getBody());

        return $this->mapper->mapCityApiResponseIntoCity(...$deserializedCityBody);
    }
}
