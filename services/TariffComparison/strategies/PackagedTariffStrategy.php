<?php

namespace app\services\TariffComparison\strategies;

use app\services\TariffComparison\baseClasses\PackagedTariffObject;
use app\services\TariffComparison\baseClasses\TariffStrategy;

class PackagedTariffStrategy implements TariffStrategy
{

    protected PackagedTariffObject $tariffObject;
    protected int $includedKwh;

    public function __construct(PackagedTariffObject $packagedTariffObject) {

        $this->tariffObject = $packagedTariffObject;

        $this->setIncludedKwh($this->tariffObject->getIncludedKwh());
    }

    public function calculateCost($consumption):float {

        $baseCost = $this->tariffObject->getBaseCost();
        $additionalKwhCost = $this->tariffObject->getAdditionalKwhCost();

        if ($consumption <= $this->includedKwh) {
            return $baseCost;
        }

        return $baseCost + (($consumption - $this->includedKwh) * $additionalKwhCost / 100);

    }

    public function getName() :string
    {
        return $this->tariffObject->getName();
    }

    /**
     * @param  int  $includedKwh
     */
    public function setIncludedKwh(int $includedKwh): void
    {
        $this->includedKwh = $includedKwh;
    }


}