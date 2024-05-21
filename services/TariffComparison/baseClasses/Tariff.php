<?php

namespace app\services\TariffComparison\baseClasses;

 use InvalidArgumentException;

 class Tariff
{
    public const BASIC_ELECTRICITY = 1;
    public const PACKAGED = 2;

    protected string $name;
    protected int $type;
    protected float $baseCost;
    protected float $additionalKwhCost;

    public function __construct(object $tariffData ) {

        $this->fetchAndSetData($tariffData);

    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param  int  $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getBaseCost(): float
    {
        return $this->baseCost;
    }

    /**
     * @param  float  $baseCost
     */
    public function setBaseCost(float $baseCost): void
    {
        $this->baseCost = $baseCost;
    }

    /**
     * @return float
     */
    public function getAdditionalKwhCost(): float
    {
        return $this->additionalKwhCost;
    }

    /**
     * @param  float  $additionalKwhCost
     */
    public function setAdditionalKwhCost(float $additionalKwhCost): void
    {
        $this->additionalKwhCost = $additionalKwhCost;
    }

    private function fetchAndSetData(object $tariffData): void
    {
        $name = $tariffData->name ?? null;
        $type = $tariffData->type ?? null;
        $baseCost = $tariffData->baseCost ?? null;
        $additionalKwhCost = $tariffData->additionalKwhCost ?? null;

        if ($name === null || $type === null || $baseCost === null || $additionalKwhCost === null) {
            throw new InvalidArgumentException("One or more required fields are missing or empty.");
        }

        $this->setName($name);
        $this->setType($type);
        $this->setBaseCost($baseCost);
        $this->setAdditionalKwhCost($additionalKwhCost);

    }

}