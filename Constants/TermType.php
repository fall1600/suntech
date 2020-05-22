<?php

namespace fall1600\Package\Suntech\Constants;

use MyCLabs\Enum\Enum;

class TermType extends Enum
{
    // 一次付清
    public const ONE_TIME = '';

    // 分3期, 以下類推
    public const TERM_3 = 3;

    public const TERM_6 = 6;

    public const TERM_12 = 12;

    public const TERM_18 = 18;

    public const TERM_24 = 24;

    public const TERM_30 = 30;
}