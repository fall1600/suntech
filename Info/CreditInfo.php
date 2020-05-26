<?php

namespace fall1600\Package\Suntech\Info;

use fall1600\Package\Suntech\Constants\TermType;
use fall1600\Package\Suntech\Contracts\OrderInterface;
use fall1600\Package\Suntech\Contracts\PayerInterface;

final class CreditInfo extends Info
{
    /**
     * 分期設定
     * @var string
     */
    protected $term;

    public function __construct(string $merchantId, OrderInterface $order, PayerInterface $payer, string $term = TermType::ONE_TIME)
    {
        parent::__construct($merchantId, $order, $payer);

        $this->setTerm($term);
    }

    public function getInfo()
    {
        return parent::getInfo() +
            [
                'Term' => $this->term,
                'Cart_Type' => 0,
            ];
    }

    protected function setTerm(string $term)
    {
        if (isset($term) && ! TermType::isValid($term)) {
            throw new \LogicException("unsupported term: $term");
        }

        $this->term = $term;
    }
}
