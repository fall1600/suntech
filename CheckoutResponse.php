<?php

namespace fall1600\Package\Suntech;

class CheckoutResponse
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
     * 紅陽交易編號
     * @return string|null
     */
    public function getBuySafeNo()
    {
        return $this->data['buysafeno'] ?? null;
    }

    /**
     * 商城代號
     * @return string|null
     */
    public function getMerchantId()
    {
        return $this->data['web'] ?? null;
    }

    /**
     * 交易金額
     * @return string|null
     */
    public function getAmount()
    {
        return $this->data['MN'] ?? null;
    }

    /**
     * 消費者姓名
     * @return string|null
     */
    public function getPayerName()
    {
        return $this->data['Name'] ?? null;
    }

    /**
     * 傳送方式
     *  1: 背景傳送
     *  2: 前頁傳送
     * @return string|null
     */
    public function getSendType()
    {
        return $this->data['SendType'] ?? null;
    }

    /**
     * 交易檢查碼
     * @return string|null
     */
    public function getChecksum()
    {
        return $this->data['ChkValue'] ?? null;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
