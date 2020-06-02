<?php

namespace fall1600\Package\Suntech\Response;

class CreditCheckoutResponse extends CheckoutResponse
{
    public function prepareChecksumParameter(string $tradePassword)
    {
        return $this->getMerchantId().
            $tradePassword.
            $this->getBuySafeNo().
            $this->getAmount().
            $this->getData()['errcode'] .
            $this->getData()['CargoNo'];
    }
}
