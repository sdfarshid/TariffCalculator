<?php

namespace app\controllers;


use app\core\Request;
use app\libs\HttpStatusCodes;
use app\services\TariffComparison\TariffComparisonService;
use app\services\TariffProviderService\ProviderService;
use InvalidArgumentException;

class Compare
{
    public function help(){
        $sampleUrl = '/compare?consumption=3500';
        echo 'Use the following route: <br>';
        echo '<a href="' . $sampleUrl . '">/compare?consumption=</a>';
    }

    public function index(Request $request): void
    {
        $consumption = (float) $request->consumption;
        if ($consumption <= 0) {
            response()->ApiResponse([], HttpStatusCodes::HTTP_BAD_PARAM);
        }

        try {
            $tariffs =  $this->callProvider();

            $tariffComparison = new TariffComparisonService($tariffs);

            $result = $tariffComparison->invokeComparison($consumption);

            response()->ApiResponse($result, HttpStatusCodes::HTTP_OK);

        }
        catch (InvalidArgumentException $e) {
            response()->ApiResponse(['error' => $e->getMessage()], HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
        catch (\Exception $e) {
            response()->ApiResponse(['error' => 'An error occurred while processing the comparison.'], HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function callProvider(): array
    {
        return (new ProviderService())->call();
    }
}