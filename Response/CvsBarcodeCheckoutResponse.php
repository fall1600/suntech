<?php

namespace fall1600\Package\Suntech\Response;

/**
 * 超商代收(條碼繳費單)
 */
class CvsBarcodeCheckoutResponse extends CheckoutResponse
{
    public function prepareChecksumParameter(string $tradePassword)
    {
        return $this->getMerchantId().
            $tradePassword.
            $this->getBuySafeNo().
            $this->getAmount().
            $this->getData()['EntityATM'];
    }
}