<?php

namespace fall1600\Package\Suntech\Contracts;

interface OrderInterface
{
    /**
     * 交易金額
     *  需為整數,不可有小數點和千位符號, 計價單位:新台幣。
     *  (本參數內容以數字為主)
     *  注意:使用 ATM 轉帳(虛擬帳號),若交易金額大於 3 萬元時需臨櫃匯款。
     * @return int
     */
    public function getAmount();

    /**
     * 商家訂單編號
     *  請避免訂單編號重複,
     *  紅陽金流系統不針對所有交易檢查訂單編號是否重複,
     *  僅阻擋同一個商家訂單編號在同瀏覽器上的未完成交易。
     *  (本參數內容以英數字為主, 長度20)
     * @return string
     */
    public function getMerchantOrderNo();
}
