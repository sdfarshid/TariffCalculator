<?php

namespace services\TariffComparison\baseClasses;

use app\services\TariffComparison\baseClasses\BasicTariffObject;
use app\services\TariffComparison\baseClasses\Tariff;
use app\services\TariffComparison\baseClasses\TariffFactory;
use app\services\TariffComparison\strategies\BasicTariffStrategy;
use app\services\TariffComparison\strategies\PackagedTariffStrategy;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class TariffFactoryTest extends TestCase
{
    public function testCreateBasicElectricityTariff()
    {
        $tariffData = (object) [
            "name" => "Product A",
            "type" => Tariff::BASIC_ELECTRICITY,
            "baseCost" => 5,
            "additionalKwhCost" => 22,
        ];
        $tariffStrategy = TariffFactory::createTariff(Tariff::BASIC_ELECTRICITY, $tariffData);

        $this->assertInstanceOf(BasicTariffStrategy::class, $tariffStrategy);
        $this->assertEquals("Product A", $tariffStrategy->getName());
    }

    public function testCreatePackagedTariff()
    {
        $tariffData = (object) [
            "name" => "Product B",
            "type" => Tariff::PACKAGED,
            "includedKwh" => 4000,
            "baseCost" => 800,
            "additionalKwhCost" => 30
        ];
        $tariffStrategy = TariffFactory::createTariff(Tariff::PACKAGED, $tariffData);

        $this->assertInstanceOf(PackagedTariffStrategy::class, $tariffStrategy);
        $this->assertEquals("Product B", $tariffStrategy->getName());
    }

    public function testCreateInvalidTariffType()
    {
        $tariffData = (object) [
            "name" => "Invalid Tariff",
            "type" => 999, // An invalid type
        ];
        $this->expectException(RuntimeException::class);
        TariffFactory::createTariff($tariffData->type, $tariffData);
    }

    public function testCreateInvalidTariffData()
    {
        // An TariffData type
        $tariffData =  [
            "name" => "Product B",
            "type" => Tariff::PACKAGED,
            "includedKwh" => 4000,
            "baseCost" => 800,
            "additionalKwhCost" => 30
        ];

        $this->expectException(InvalidArgumentException::class);
        TariffFactory::createTariff($tariffData['type'], $tariffData);
    }



}
