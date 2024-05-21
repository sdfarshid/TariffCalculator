<?php

namespace services\TariffComparison;

use app\services\TariffComparison\baseClasses\Tariff;
use app\services\TariffComparison\strategies\TariffCalculator;
use app\services\TariffComparison\TariffComparisonService;
use app\services\TariffProviderService\ProviderService;
use PHPUnit\Framework\TestCase;



class TariffComparisonServiceTest extends TestCase
{

    public function testInvokeComparison()
    {

        $providerMock = $this->getMockBuilder(ProviderService::class)->getMock();
        $providerMock->method('call')->willReturn([
            (object)["name" => "Product A", "type" => 1, "baseCost" => 5, "additionalKwhCost" => 22],
            (object)["name" => "Product B", "type" => 2, "includedKwh" => 4000, "baseCost" => 800, "additionalKwhCost" => 30],
        ]);

        $tariffComparison = new TariffComparisonService($providerMock->call());
        $results3500 = $tariffComparison->invokeComparison(3500);
        $results4500 = $tariffComparison->invokeComparison(4500);

        $expected3500 = [
            ['tariff_name' => 'Product B', 'annual_cost' => 800],
            ['tariff_name' => 'Product A', 'annual_cost' => 830]
        ];
        $expected4500 = [
            ['tariff_name' => 'Product B', 'annual_cost' => 950],
            ['tariff_name' => 'Product A', 'annual_cost' => 1050]
        ];

        // Asserts
        $this->assertEquals($expected3500, $results3500, "Testing with 3500 kWh consumption");
        $this->assertEquals($expected4500, $results4500, "Testing with 4500 kWh consumption");

    }
}
