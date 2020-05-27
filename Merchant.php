<?php

namespace fall1600\Package\Suntech;

use fall1600\Package\Suntech\Contracts\OrderInterface;
use fall1600\Package\Suntech\Exceptions\TradeInfoException;
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

    /**
     * 查詢後取得的結果
     * @var QueryResponse
     */
    protected $queryResponse;

    /**
     * 交易當下產生的結果
     * @var CheckoutResponse
     */
    protected $checkoutResponse;

    public function __construct(string $id, string $tradePassword)
    {
        $this->id = $id;
        $this->tradePassword = $tradePassword;
    }

    public function reset(string $id, string $tradePassword)
    {
        $this->id = $id;
        $this->tradePassword = $tradePassword;

        $this->checkoutResponse = null;
        $this->queryResponse = null;

        return $this;
    }

    /**
     * @param array $rawData
     * @return $this
     * @throws TradeInfoException
     */
    public function setRawDataForCheckout(array $rawData)
    {
        if (! isset($rawData['ChkValue'])) {
            throw new TradeInfoException('invalid data');
        }

        $this->checkoutResponse = new CheckoutResponse($rawData);
        return $this;
    }

    /**
     * @param array $rawData
     * @return $this
     * @throws TradeInfoException
     */
    public function setRawDataForQuery(array $rawData)
    {
        if (count($rawData) !== 8 || ! isset($rawData['ChkValue'])) {
            throw new TradeInfoException('invalid data');
        }

        $this->queryResponse = new QueryResponse($rawData);
        return $this;
    }

    /**
     * @todo 依交易方式不同而異
     */
    public function validateCheckoutResponse()
    {
        if (! $this->checkoutResponse) {
            throw new \LogicException('set rawData first');
        }
    }

    /**
     * 用來驗證紅陽來的response 資料是否可信
     * @return bool
     */
    public function validateQueryResponse()
    {
        if (! $this->queryResponse) {
            throw new \LogicException('set rawData first');
        }

        $responseChecksum = $this->queryResponse->getChecksum();
        $countedChecksum = $this->countChecksum(
            $this->queryResponse->getMerchantId().
            $this->getTradePassword().
            $this->queryResponse->getBuySafeNo().
            $this->queryResponse->getAmount().
            $this->queryResponse->getStatusCode()
        );
        return $responseChecksum === $countedChecksum;
    }

    /**
     * 結帳用的檢核碼
     * @param Info $info
     * @return string
     */
    public function countCheckoutChecksum(Info $info)
    {
        $parameter = $this->getId().
            $this->getTradePassword().
            $info->getOrder()->getAmount().
            ($info->getInfo()['Term'] ?? '');

        return $this->countChecksum($parameter);
    }

    /**
     * 查訊用的檢核碼
     * @param OrderInterface $order
     * @param string $buysafeno 紅陽提供的交易編號
     * @param string $note1 備註1
     * @param string $note2 備註1
     * @return string
     */
    public function countQueryChecksum(OrderInterface $order, string $buysafeno = '', string $note1 = '', string $note2 = '')
    {
        $parameter = $this->getId().
            $this->getTradePassword().
            $order->getAmount().
            $buysafeno.
            $order->getMerchantOrderNo().
            $note1.
            $note2;

        return $this->countChecksum($parameter);
    }

    /**
     * @param string $input
     * @return string
     */
    protected function countChecksum(string $input)
    {
        return strtoupper(sha1($input));
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
