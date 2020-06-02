<?php

namespace fall1600\Package\Suntech\Response;

use DateTime;

/**
 * 查詢結果
 */
class QueryResponse extends AbstractResponse
{
    /**
     * @return string|null
     */
    public function getMerchantId()
    {
        return $this->data[0] ?? null;
    }

    /**
     * 紅陽提供的交易編號
     * @return string|null
     */
    public function getBuySafeNo()
    {
        return $this->data[1] ?? null;
    }

    /**
     * @return int|null
     */
    public function getAmount()
    {
        return $this->data[2] ?? null;
    }

    /**
     * 交易時間
     * @return DateTime|null
     */
    public function getPaidAt()
    {
        return DateTime::createFromFormat('YmdHis', $this->data[3], 'Asia/Taipei') ?? null;
    }

    /**
     * 回覆代碼
     *  00(數字)代表交易成功,其餘為交易失敗或退貨/取消交易
     * @return string|null
     */
    public function getStatusCode()
    {
        return $this->data[4] ?? null;
    }

    /**
     * 消費者信用卡卡號後 4 碼,非信用卡交易則為空字串(本參數內容以數字為主)
     * @return string|null
     */
    public function getCreditLast4()
    {
        return $this->data[5] ?? null;
    }

    /**
     * 信用卡授權成功時所取得的授權碼,非信用卡交易則為空字串
     * @return string|null
     */
    public function getApprovalCode()
    {
        return $this->data[6] ?? null;
    }

    /**
     * 交易檢查碼
     * @return string|null
     */
    public function getChecksum()
    {
        return $this->data[7] ?? null;
    }

    public function prepareChecksumParameter(string $tradePassword)
    {
        return $this->getMerchantId().
            $tradePassword.
            $this->getAmount().
            $this->getBuySafeNo().
            $this->getData()['Td'].
            $this->getData()['note1'].
            $this->getData()['note2'];
    }
}
