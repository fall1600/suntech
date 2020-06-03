<?php

namespace fall1600\Package\Suntech\Info;

class AtmInfo extends OfflineInfo
{
    use ProductTrait;

    public function getInfo()
    {
        if (0 === count($this->products)) {
            throw new \LogicException('Cvs payment needs product information, please call appendProduct method');
        }

        return parent::getInfo() + $this->getProductInfo() +
            [
                'AgencyType' => 1,
                'AgencyBank' => 0,
            ];
    }
}