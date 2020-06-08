<?php

namespace fall1600\Package\Suntech\Response;

use fall1600\Package\Suntech\Contracts\ChecksumSubjectInterface;

class SelectStoreResponse implements ChecksumSubjectInterface
{
    /**
     * @var array
     */
    protected $data;

    /** @var string */
    protected $merchantId;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string|null
     */
    public function getMerchantOrderId()
    {
        return $this->data['OrderID'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getCargoFlag()
    {
        return $this->data['CargoFlag'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getStoreId()
    {
        return $this->data['StoreID'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getStoreName()
    {
        return $this->data['StoreName'] ?? null;
    }

    public function prepareChecksumParameter(string $tradePassword)
    {
        if (! $this->merchantId) {
            throw new \LogicException('set merchant id first');
        }

        return $this->merchantId.
            $tradePassword.
            ($this->getMerchantOrderId() ?? '').
            ($this->getCargoFlag() ?? '').
            ($this->getStoreId() ?? '');
    }

    /**
     * @param  string  $merchantId
     * @return $this
     */
    public function setMerchantId(string $merchantId)
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
