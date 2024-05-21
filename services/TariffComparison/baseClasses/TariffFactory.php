<?php

namespace app\services\TariffComparison\baseClasses;

use app\services\TariffComparison\strategies\BasicTariffStrategy;
use app\services\TariffComparison\strategies\PackagedTariffStrategy;
use InvalidArgumentException;
use RuntimeException;

class TariffFactory {
    public static function createTariff(int $type, $tariffData) {
            if (!is_object($tariffData)) {
                throw new InvalidArgumentException('Invalid tariff data. Expected object.');
            }
            switch ($type) {
                case Tariff::BASIC_ELECTRICITY:
                    return new BasicTariffStrategy(new BasicTariffObject($tariffData));
                case Tariff::PACKAGED:
                    return new PackagedTariffStrategy(new PackagedTariffObject($tariffData));
                default:
                    throw new RuntimeException("Unsupported tariff type");
            }
    }
}
