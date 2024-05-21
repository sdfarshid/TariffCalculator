<?php
namespace app\services\TariffComparison\baseClasses;

 class BasicTariffObject extends Tariff
{
    public function __construct(object $tariffData ) {
        parent::__construct($tariffData);
    }

}