<?php

namespace app\services\TariffComparison;

use app\services\TariffComparison\baseClasses\TariffFactory;
use app\services\TariffComparison\baseClasses\TariffStrategy;
use app\services\TariffComparison\strategies\TariffCalculator;
use app\services\TariffProviderService\ProviderService;

class TariffComparisonService
{
    private TariffCalculator $tariffCalculator;
    private array $tariffs;

    public function __construct(array $tariffs)
    {
        $this->tariffs = $tariffs;
        $this->tariffCalculator = new TariffCalculator();
    }

    public function invokeComparison(float $consumption) :array
    {
        $results =[];
        foreach ($this->tariffs as $tariff ){
            $type = $tariff->type ?? 0 ;
            /** @var TariffStrategy $tariffStrategy */
            $tariffStrategy =  TariffFactory::createTariff($type, $tariff);

            $results []= [
                'tariff_name' => $tariffStrategy->getName(),
                'annual_cost' =>  $this->tariffCalculator->setStrategy($tariffStrategy)->calculate($consumption)
            ];
        }
        //sort
        usort($results, static fn($a, $b) => $a['annual_cost'] <=> $b['annual_cost']);

        return $results;
    }

}