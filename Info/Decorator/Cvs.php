<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Info\Info;

/**
 * 超商代收(代碼)
 */
class Cvs extends OfflinePay
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
        parent::__construct($info, $ttl);

        $this->userNo = $userNo;

        $this->billDate = $billDate;
    }

    public function getInfo()
    {
        return parent::getInfo() +
            [
                'UserNo' => $this->userNo ?? '',
                'BillDate' => $this->billDate ?? '',
            ];
    }
}
