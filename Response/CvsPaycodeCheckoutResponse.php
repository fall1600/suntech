<?php

namespace fall1600\Package\Suntech\Response;

/**
 * 超商代收(代碼)
 */
class CvsPaycodeCheckoutResponse extends CheckoutResponse
{
    public function prepareChecksumParameter(string $tradePassword)
    {
        return $this->getMerchantId().
            $tradePassword.
            $this->getBuySafeNo().
            $this->getAmount().
            $this->getData()['paycode'];
    }
}
