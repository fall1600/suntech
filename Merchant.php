<?php

namespace fall1600\Package\Suntech;

use fall1600\Package\Suntech\Info\Info;

class Merchant
{
    /**
     * 商家代號
     * @var string
     */
    protected $id;

    /**
     * 在紅陽後台設定的交易密碼
     * @var string
     */
    protected $tradePassword;

    public function __construct(string $id, string $tradePassword)
    {
        $this->id = $id;
        $this->tradePassword = $tradePassword;
    }

    public function reset(string $id, string $tradePassword)
    {
        $this->id = null;
        $this->tradePassword = null;

        return $this;
    }

    /**
     * @param Info $info
     * @return string
     */
    public function countChecksum(Info $info)
    {

    }
}
