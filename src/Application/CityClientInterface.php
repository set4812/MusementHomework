<?php

namespace Weather\Application;

use Weather\Domain\City;

interface CityClientInterface
{
    /**
     * @return City[]
     */
    public function getCities(): array;

}