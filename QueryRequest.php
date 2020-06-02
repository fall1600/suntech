<?php

namespace fall1600\Package\Suntech;

use fall1600\Package\Suntech\Contracts\ChecksumSubjectInterface;
use fall1600\Package\Suntech\Contracts\OrderInterface;

class QueryRequest implements ChecksumSubjectInterface
{
    /**
     * @var string
     */
    protected $merchantId;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * @var string
     */
    protected $buysafeno;

    /**
     * @var string
     */
    protected $note1;

    /**
     * @var string
     */
    protected $note2;

    public function __construct(string $merchantId, OrderInterface $order, string $buysafeno = '', string $note1 = '', string $note2 = '')
    {
        $this->merchantId = $merchantId;
        $this->order = $order;
        $this->buysafeno = $buysafeno;
        $this->note1 = $note1;
        $this->note2 = $note2;
    }

    public function prepareChecksumParameter(string $tradePassword)
    {
        return $this->merchantId.
            $tradePassword.
            $this->order->getAmount().
            $this->buysafeno.
            $this->order->getMerchantOrderNo().
            $this->note1.
            $this->note2;
    }

    public function getPayload()
    {
        return [
            'web' => $this->merchantId,
            'MN' => $this->order->getAmount(),
            'buysafeno' => $this->buysafeno,
            'Td' => $this->order->getMerchantOrderNo(),
            'note1' => $this->note1,
            'note2' => $this->note2,
        ];
    }
}
