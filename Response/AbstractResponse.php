<?php

namespace fall1600\Package\Suntech\Response;

abstract class AbstractResponse
{
    /**
     * @var array
     */
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * 商城代號
     * @return string
     */
    abstract public function getMerchantId();

    /**
     * 紅陽提供的交易編號
     * @return string
     */
    abstract public function getBuySafeNo();

    /**
     * 交易金額
     * @return string
     */
    abstract public function getAmount();

    /**
     * 檢核碼
     * @return string
     */
    abstract public function getChecksum();

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
