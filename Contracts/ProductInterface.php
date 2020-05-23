<?php

namespace fall1600\Package\Suntech\Contracts;

interface ProductInterface
{
    /** 商品名稱 */
    public function getName();

    /** 商品單價 */
    public function getPrice();

    /** 商品數量 */
    public function getQuantity();
}
