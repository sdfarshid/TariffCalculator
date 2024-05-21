<?php

namespace app\services\TariffComparison\strategies;

use app\services\TariffComparison\baseClasses\BasicTariffObject;
use app\services\TariffComparison\baseClasses\TariffStrategy;

class BasicTariffStrategy implements TariffStrategy
{
    const YEAR_MONTHS = 12;
    protected BasicTariffObject $tariffObject;


    public function __construct(BasicTariffObject $BasicTariffObject) {

        $this->tariffObject = $BasicTariffObject;
    }

    public function calculateCost($consumption):float {
        $baseCost = $this->tariffObject->getBaseCost();
        $additionalKwhCost = $this->tariffObject->getAdditionalKwhCost();
        return ($baseCost * self::YEAR_MONTHS) + ($consumption * $additionalKwhCost / 100);
    }
    public function getName() :string
    {
        return $this->tariffObject->getName();
    }


}