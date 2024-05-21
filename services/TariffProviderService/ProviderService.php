<?php
declare(strict_types=1);

namespace app\services\TariffProviderService;


use JsonException;

class ProviderService
{

    /**
     * @throws JsonException
     */
    public function call(): array
    {
       return $this->getMockData();
    }

    /**
     * @throws JsonException
     */
    private function getMockData(): array
    {
        $mockData = app()->config["mockData"] ?? '[]';
        return json_decode($mockData, false, 512, JSON_THROW_ON_ERROR);
    }

}