<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Info\Info;
use fall1600\Package\Suntech\Info\InfoDecorator;

class Content extends InfoDecorator
{
    public const SIZE = 400;

    /**
     * @var Info
     */
    protected $info;

    /**
     * 交易內容
     * @var string
     */
    protected $content;

    public function __construct(Info $info, string $content)
    {
        $this->info = $info;

        $this->content = $content;
    }

    public function getInfo()
    {
        return $this->info->getInfo() +
            [
                'OrderInfo' => urlencode(mb_substr($this->content, 0, static::SIZE)),
            ];
    }
}
