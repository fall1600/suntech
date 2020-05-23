<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Info\Info;

class Barcode extends OfflinePay
{
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

    public function getInfo()
    {
        return $this->info->getInfo() +
            [
                'UserNo' => $this->userNo ?? '',
                'BillDate' => $this->billDate ?? '',
            ];
    }
}
