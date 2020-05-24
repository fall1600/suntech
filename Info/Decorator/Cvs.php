<?php

namespace fall1600\Package\Suntech\Info\Decorator;

/**
 * 超商代收(代碼)
 */
class Cvs extends OfflinePay
{
    use ProductTrait;

    public function getInfo()
    {
        if (0 === count($this->products)) {
            throw new \LogicException('Cvs payment needs product information, please call appendProduct method');
        }

        return parent::getInfo() + $this->getProductInfo();
    }
}
