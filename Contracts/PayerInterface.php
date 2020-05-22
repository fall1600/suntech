<?php

namespace fall1600\Package\Suntech\Contracts;

interface PayerInterface
{
    /**
     * 消費者姓名
     * @return string
     */
    public function getName();

    /**
     * 消費者電話
     * @return string
     */
    public function getTelephone();
}
