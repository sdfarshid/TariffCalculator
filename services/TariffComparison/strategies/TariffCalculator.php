<?php

namespace app\services\TariffComparison\strategies;

use app\services\TariffComparison\baseClasses\TariffStrategy;

class TariffCalculator
{
    private TariffStrategy $strategy;

    public function setStrategy(TariffStrategy $strategy) : TariffCalculator {
        $this->strategy = $strategy;
        return $this;
    }

    public function calculate($consumption): float
    {
        return $this->strategy->calculateCost($consumption);
    }
    public function name(): string
    {
        return $this->strategy->getName();
    }


}