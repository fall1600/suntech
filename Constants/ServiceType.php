<?php

namespace fall1600\Package\Suntech\Constants;

use MyCLabs\Enum\Enum;

class ServiceType extends Enum
{
    // 信用卡
    public const CREDIT = 'credit';

    // 銀聯卡
    public const UNION_PAY = 'union_pay';

    // 超商代碼
    public const CVS_PAYCODE = 'cvs_paycode';

    // 超商條碼
    public const CVS_BARCODE = 'cvs_barcode';

    // 虛擬ATM
    public const ATM = 'atm';

    // 網路ATM
    public const WEB_ATM = 'web_atm';
}
