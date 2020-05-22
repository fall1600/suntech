<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Info\Info;
use fall1600\Package\Suntech\Info\InfoDecorator;

class OrderNumber extends InfoDecorator
{
    /**
     * @var Info
     */
    protected $info;

    /**
     * 商家訂單編號
     *  請避免訂單編號重複,
     *  紅陽金流系統不針對所有交易檢查訂單編號是否重複,
     *  僅阻擋同一個商家訂單編號在同瀏覽器上的未完成交易。
     *  (本參數內容以英數字為主, 長度20)
     * @var string
     */
    protected $orderNumber;

    public function __construct(Info $info, string $orderNumber)
    {
        $this->info = $info;

        $this->orderNumber = $orderNumber;
    }

    public function getInfo()
    {
        return $this->info->getInfo() +
            [
                'Td' => $this->orderNumber,
            ];
    }
}
