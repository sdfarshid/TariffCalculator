<?php

namespace services\TariffComparison\strategies;

use app\services\TariffComparison\baseClasses\PackagedTariffObject;
use app\services\TariffComparison\baseClasses\Tariff;
use app\services\TariffComparison\strategies\PackagedTariffStrategy;
use app\services\TariffComparison\strategies\TariffCalculator;
use app\services\TariffProviderService\ProviderService;
use PHPUnit\Framework\TestCase;

class PackagedTariffStrategyTest extends TestCase
{

   public function testCalculateCost(){

       $providerMock = $this->getMockBuilder(ProviderService::class)->getMock();
       $providerMock->method('call')->willReturn([
           (object)["name" => "Product B", "type" => 2, "includedKwh" => 4000,
                    "baseCost" => 800, "additionalKwhCost" => 30],
       ]);

       $consumption = 3500;
       $tariffData =  $providerMock->call();

       $tariffStrategy = new PackagedTariffStrategy(new PackagedTariffObject($tariffData[0]));
       $result= [
           'tariff_name' =>  $tariffStrategy->getName(),
           'annual_cost' =>  $tariffStrategy->calculateCost($consumption)
       ];
       $expected =[
           'tariff_name' => "Product B",
           'annual_cost' => 800
       ];

       // Assert
       $this->assertEquals($expected, $result);

   }

}
