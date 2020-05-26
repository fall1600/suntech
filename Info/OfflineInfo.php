<?php

namespace fall1600\Package\Suntech\Info;

use fall1600\Package\Suntech\Contracts\OrderInterface;
use fall1600\Package\Suntech\Contracts\PayerInterface;

abstract class OfflineInfo extends Info
{
    /**
     * 繳費期限: 單位(天)
     * @var int
     */
    protected $ttl;

    public function __construct(string $merchantId, OrderInterface $order, PayerInterface $payer, int $ttl = 7)
    {
        parent::__construct($merchantId, $order, $payer);

        $this->setTtl($ttl);
    }

    public function getInfo()
    {
        return parent::getInfo() +
            [
                'DueDate' => $this->countDueDate(),
            ];
    }

    protected function countDueDate()
    {
        return date('Ymd', strtotime("+{$this->ttl} days"));
    }

    protected function setTtl(int $ttl)
    {
        if ($ttl < 1 || $ttl > 180) {
            throw new \LogicException("unsupported ttl: $ttl");
        }

        $this->ttl = $ttl;
    }
}
