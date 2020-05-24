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
     * ttl: 繳費期限, 單位: 天
     * @var int
     */
    protected $ttl;

    public function __construct(Info $info, int $ttl = OfflinePay::TTL)
    {
        $this->info = $info;

        $this->setTtl($ttl);
    }

    protected function countDueDate()
    {
        return date('Ymd', strtotime("+{$this->ttl} days"));
    }

    public function getInfo()
    {
        return $this->info->getInfo() +
            [
                'DueDate' => $this->countDueDate(),
            ];
    }

    protected function setTtl(int $ttl)
    {
        if ($ttl < 1 || $ttl > 180) {
            throw new \LogicException("unsupported ttl: $ttl");
        }

        $this->ttl = $ttl;
    }
}
