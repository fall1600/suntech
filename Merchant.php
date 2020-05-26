<?php

namespace fall1600\Package\Suntech;

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
     * @var QueryResponse
     */
    protected $response;

    public function __construct(string $id, string $tradePassword)
    {
        $this->id = $id;
        $this->tradePassword = $tradePassword;
    }

    public function reset(string $id, string $tradePassword)
    {
        $this->id = null;
        $this->tradePassword = null;
        $this->response = null;

        return $this;
    }

    /**
     * @param array $rawData
     * @throws TradeInfoException
     */
    public function setRawData(array $rawData)
    {
        if (count($rawData) !== 8 || ! isset($rawData['ChkValue'])) {
            throw new TradeInfoException('invalid data');
        }

        $this->response = new QueryResponse($rawData);
        return $this;
    }

    /**
     * 用來驗證紅陽來的response 資料是否可信
     * @return bool
     */
    public function validateResponse()
    {
        if (! $this->response) {
            throw new \LogicException('set rawData first');
        }

        $responseChecksum = $this->response->getChecksum();
        $countedChecksum = $this->countChecksum(
            $this->response->getMerchantId().
            $this->getTradePassword().
            $this->response->getBuySafeNo().
            $this->response->getAmount().
            $this->response->getStatusCode()
        );
        return $responseChecksum === $countedChecksum;
    }

    /**
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
     * @todo
     */
    public function countQueryChecksum()
    {
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
