<?php

namespace services\TariffComparison\strategies;

use app\services\TariffComparison\baseClasses\BasicTariffObject;
use app\services\TariffComparison\baseClasses\Tariff;
use app\services\TariffComparison\strategies\BasicTariffStrategy;
use app\services\TariffProviderService\ProviderService;
use PHPUnit\Framework\TestCase;

class BasicTariffStrategyTest extends TestCase
{

    public function testCalculateCost(){

        $providerMock = $this->getMockBuilder(ProviderService::class)->getMock();
        $providerMock->method('call')->willReturn([
            (object)["name" => "Product A", "type" => 1, "baseCost" => 5, "additionalKwhCost" => 22],
        ]);

        $consumption = 3500;
        $tariffData =  $providerMock->call();

        $tariffStrategy = new BasicTariffStrategy(new BasicTariffObject($tariffData[0]));
        $result= [
            'tariff_name' =>  $tariffStrategy->getName(),
            'annual_cost' =>  $tariffStrategy->calculateCost($consumption)
        ];
        $expected =[
            'tariff_name' => "Product A",
            'annual_cost' => 830
        ];

        // Assert
        $this->assertEquals($expected, $result);

    }
}
