<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Constants\AgencyType;

/**
 * 超商代收(條碼繳費單)
 */
class Barcode extends OfflinePay
{
    public function getInfo()
    {
        return parent::getInfo() +
            [
                'AgencyType' => AgencyType::ONLY_BARCODE,
            ];
    }
}
