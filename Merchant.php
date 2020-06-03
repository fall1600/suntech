<?php

namespace fall1600\Package\Suntech;

use fall1600\Package\Suntech\Contracts\ChecksumSubjectInterface;
use fall1600\Package\Suntech\Exceptions\TradeInfoException;
use fall1600\Package\Suntech\Response\AbstractResponse;
use fall1600\Package\Suntech\Response\Factory;

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

    /** @var AbstractResponse */
    protected $response;

    public function __construct(string $id, string $tradePassword)
    {
        $this->id = $id;
        $this->tradePassword = $tradePassword;
    }

    public function reset(string $id, string $tradePassword)
    {
        $this->id = $id;
        $this->tradePassword = $tradePassword;

        $this->response = null;

        return $this;
    }

    /**
     * @param array $rawData
     * @param string $type
     * @return $this
     * @throws TradeInfoException
     */
    public function setRawData(array $rawData, string $type)
    {
        if (! isset($rawData['ChkValue'])) {
            throw new TradeInfoException('invalid data');
        }

        $this->response = Factory::create($rawData, $type);
        return $this;
    }

    /**
     * @return bool
     */
    public function validateResponse()
    {
        if (! $this->response) {
            throw new \LogicException('set rawData first');
        }

        return $this->response->getChecksum() === $this->countChecksum($this->response);
    }

    /**
     * 紅陽說怎麼算就怎麼算
     * @param  ChecksumSubjectInterface  $subject
     * @return string
     */
    public function countChecksum(ChecksumSubjectInterface $subject)
    {
        return strtoupper(sha1($subject->prepareChecksumParameter($this->tradePassword)));
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

    /**
     * @return AbstractResponse
     */
    public function getResponse()
    {
        return $this->response;
    }
}
