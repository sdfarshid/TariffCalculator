<?php

namespace services\TariffComparison\baseClasses;

use app\services\TariffComparison\baseClasses\Tariff;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use TypeError;

class TariffTest extends TestCase
{

    public function testGetName()
    {
        $tariffData = (object) [
            'name' => 'Product A',
            'type' => 1,
            'baseCost' => 5,
            'additionalKwhCost' => 22
        ];

        $tariff = new Tariff($tariffData);
        $this->assertEquals('Product A', $tariff->getName());
    }

    public function testGetType()
    {
        $tariffData = (object) [
            'name' => 'Product A',
            'type' => 1,
            'baseCost' => 5,
            'additionalKwhCost' => 22
        ];

        $tariff = new Tariff($tariffData);

        $this->assertEquals(1, $tariff->getType());
    }

    public function testGetBaseCost()
    {
        $tariffData = (object) [
            'name' => 'Product A',
            'type' => 1,
            'baseCost' => 5,
            'additionalKwhCost' => 22
        ];

        $tariff = new Tariff($tariffData);

        $this->assertEquals(5, $tariff->getBaseCost());
    }

    public function testGetAdditionalKwhCost()
    {
        $tariffData = (object) [
            'name' => 'Product A',
            'type' => 1,
            'baseCost' => 5,
            'additionalKwhCost' => 22
        ];

        $tariff = new Tariff($tariffData);

        $this->assertEquals(22, $tariff->getAdditionalKwhCost());
    }

    public function testConstructorThrowsExceptionForMissingFields()
    {
        $this->expectException(InvalidArgumentException::class);
        $tariffData = (object) [
            'name' => 'Product A',
        ];
        new Tariff($tariffData);
    }

    public function testConstructorThrowsExceptionForMissingTypeFields()
    {
        $tariffData =[
            'name' => 'Product A',
            'type' => 1,
            'baseCost' => 5,
            'additionalKwhCost' => 22
        ];
        $this->expectException(TypeError::class);
        $tariff = new Tariff($tariffData);
    }

}
