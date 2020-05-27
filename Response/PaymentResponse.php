<?php

namespace fall1600\Package\Suntech\Response;

/**
 * 付款結果
 */
class PaymentResponse extends AbstractResponse
{
    public function getMerchantId()
    {
        return $this->data['web'] ?? null;
    }

    public function getBuySafeNo()
    {
        return $this->data['buysafeno'] ?? null;
    }

    public function getAmount()
    {
        return $this->data['MN'] ?? null;
    }

    public function getChecksum()
    {
        return $this->data['ChkValue'] ?? null;
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
     * 回覆代碼
     * @return string|null
     */
    public function getStatusCode()
    {
        return $this->data['errcode'] ?? null;
    }
}
