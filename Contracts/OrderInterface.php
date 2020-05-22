<?php

namespace fall1600\Package\Suntech\Contracts;

interface OrderInterface
{
    /**
     * 交易金額
     * @return int
     */
    public function getAmount();
}
