<?php

namespace fall1600\Package\Suntech\Info;

class BasicInfo extends Info
{
    public function getInfo()
    {
        return [
            'web' => $this->merchantId,
            'MN' => $this->order->getAmount(),
            'sna' => $this->payer->getName(),
            'sdt' => $this->payer->getTelephone(),
        ];
    }
}
