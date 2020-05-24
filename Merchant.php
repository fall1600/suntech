<?php

namespace fall1600\Package\Suntech;

use fall1600\Package\Suntech\Exceptions\TradeInfoException;

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

    /**
     * @var Response
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

        $this->response = new Response($rawData);
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
//        $countedChecksum = $this->countChecksumByArray($this->response->getOriginInfoPayload());
        return $responseChecksum === $countedChecksum;
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
