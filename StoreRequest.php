<?php

namespace fall1600\Package\Suntech;

use fall1600\Package\Suntech\Constants\CargoType;
use fall1600\Package\Suntech\Contracts\ChecksumSubjectInterface;
use fall1600\Package\Suntech\Contracts\OrderInterface;

class StoreRequest implements ChecksumSubjectInterface
{
    /**
     * @var string
     */
    protected $merchantId;

    /**
     * @var string
     */
    protected $returnUrl;

    /**
     * @var int
     */
    protected $cargoType;

    /**
     * @var OrderInterface|null
     */
    protected $order;

    public function __construct(string $merchantId, string $returnUrl, $cargoType = 1, OrderInterface $order = null)
    {
        $this->merchantId = $merchantId;

        $this->returnUrl = $returnUrl;

        $this->setCargoType($cargoType);

        $this->order = $order;
    }

    public function prepareChecksumParameter(string $tradePassword)
    {
        return $this->merchantId.
            $tradePassword.
            $this->cargoType.
            $this->returnUrl;
    }

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * @return int
     */
    public function getCargoType()
    {
        return $this->cargoType;
    }

    /**
     * @return OrderInterface|null
     */
    public function getOrder()
    {
        return $this->order;
    }

    protected function setCargoType(int $cargoType)
    {
        if (! CargoType::isValid($cargoType)) {
            throw new \LogicException('unsupported cargo type');
        }

        $this->cargoType = $cargoType;
    }
}
