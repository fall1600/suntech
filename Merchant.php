<?php

namespace fall1600\Package\Suntech;

class Merchant
{
    use Cryption;

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
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTradePassword()
    {
        return $this->tradePassword;
    }
}
