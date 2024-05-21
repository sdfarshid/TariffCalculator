<?php

namespace app\services\TariffComparison\baseClasses;

 class PackagedTariffObject extends Tariff
{
    protected  float $includedKwh;

    public function __construct(object $tariffDataObject ) {

        parent::__construct($tariffDataObject);

        $this->setCustomItems($tariffDataObject);
    }

     /**
      * @return float
      */
     public function getIncludedKwh(): float
     {
         return $this->includedKwh;
     }

     /**
      * @param  float  $includedKwh
      */
     public function setIncludedKwh(float $includedKwh): void
     {
         $this->includedKwh = $includedKwh;
     }

     /**
      * @param  object  $tariffData
      * @return void
      */
     private function setCustomItems(object $tariffData) : void
     {
         $this->setIncludedKwh($tariffData->includedKwh);
     }


 }