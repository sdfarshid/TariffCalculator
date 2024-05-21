<?php

namespace app\services\TariffComparison\baseClasses;

interface TariffStrategy
{
    public function calculateCost($consumption) : float;
    public function getName():string ;

}