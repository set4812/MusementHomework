<?php

namespace Weather\Domain;

class Weather
{
    /**
     * @var string
     */
    private string $locationName;
    /**
     * @var string[]
     */
    private array $conditionText;

    public function __construct(string $locationName, string ...$conditionText)
    {
        $this->locationName = $locationName;
        $this->conditionText = $conditionText;
    }

    /**
     * @return string
     */
    public function getLocationName(): string
    {
        return $this->locationName;
    }

    /**
     * @return string[]
     */
    public function getConditionText(): array
    {
        return $this->conditionText;
    }
}
