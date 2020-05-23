<?php

namespace fall1600\Package\Suntech\Constants;

use MyCLabs\Enum\Enum;

class AgencyType extends Enum
{
    /**
     * 產生繳費單包含條碼跟 ATM轉帳帳號(虛擬帳號)
     */
    public const ALL = '';

    /**
     * 只產生條碼繳費單,發送給消費者的電子郵件中的繳費單只有條碼繳費,沒有 ATM 轉帳帳號(虛擬帳號),
     * 注意:如交易金額超過 2 萬元則會拒絕交易
     */
    public const ONLY_BARCODE = 1;

    /**
     * 只產生 ATM 轉帳帳號(虛擬帳號),發送給消費者的電子郵件中的繳費單只有 ATM 轉帳帳號(虛擬帳號),沒有條碼繳費的條碼資訊
     */
    public const ONLY_ATM = 2;
}
