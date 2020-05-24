<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Constants\AgencyType;
use fall1600\Package\Suntech\Info\Info;

/**
 * 超商代收(條碼繳費單)
 */
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
        return parent::getInfo() +
            [
                'AgencyType' => AgencyType::ONLY_BARCODE,
                'UserNo' => $this->userNo ?? '',
                'BillDate' => $this->billDate ?? '',
            ];
    }
}
