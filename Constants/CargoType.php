<?php

namespace fall1600\Package\Suntech\Constants;

use MyCLabs\Enum\Enum;

class CargoType extends Enum
{
    // 統一超商
    public const SEVEN = 1;

    // 全家超商與全家大宗寄倉超商取貨
    public const FAMILY = 2;
}
