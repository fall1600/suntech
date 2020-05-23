<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Info\Info;
use fall1600\Package\Suntech\Info\InfoDecorator;

abstract class OfflinePay extends InfoDecorator
{
    public const TTL = 7;

    /**
     * @var Info
     */
    protected $info;

    /**
     * 繳費期限, 單位: 天
     * @var int
     */
    protected $ttl;

    public function __construct(Info $info, int $ttl = OfflinePay::TTL)
    {
        $this->info = $info;

        $this->setTtl($ttl);
    }

    public function getInfo()
    {
        return [
            'DueDate' => $this->countDueDate(),
        ];
    }

    protected function countDueDate()
    {
        return date(
            'Ymd',
            mktime(
                0,
                0,
                0,
                date('m'),
                date('d') + $this->ttl,
                date('Y')
            )
        );
    }

    protected function setTtl(int $ttl)
    {
        if ($ttl < 1 || $ttl > 180) {
            throw new \LogicException("unsupported ttl: $ttl");
        }

        $this->ttl = $ttl;
    }
}
