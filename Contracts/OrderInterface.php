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
}
