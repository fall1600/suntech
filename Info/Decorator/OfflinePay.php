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

    /**
     * 用戶編號
     * @var string|null
     */
    protected $userNo;

    /**
     * 列帳日期
     * @var string|null
     */
    protected $billDate;

    public function __construct(Info $info, int $ttl = OfflinePay::TTL, string $userNo = null, string $billDate = null)
    {
        $this->info = $info;

        $this->setTtl($ttl);

        $this->userNo = $userNo;

        $this->billDate = $billDate;
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
                'UserNo' => $this->userNo ?? '',
                'BillDate' => $this->billDate ?? '',
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
