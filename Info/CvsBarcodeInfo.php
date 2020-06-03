<?php

namespace fall1600\Package\Suntech\Info;

/**
 * 超商條碼繳費單
 */
class CvsBarcodeInfo extends OfflineInfo
{
    use ProductTrait;

    public function getInfo()
    {
        if (0 === count($this->products)) {
            throw new \LogicException('Cvs payment needs product information, please call appendProduct method');
        }

        return parent::getInfo() +
            [
                'AgencyType' => 1,
            ] +
            $this->getProductInfo();
    }
}
