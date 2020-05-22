<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Info\Info;
use fall1600\Package\Suntech\Info\InfoDecorator;

class Note extends InfoDecorator
{
    public const SIZE = 2;

    /**
     * @var Info
     */
    protected $info;

    /**
     * 備註
     * @var string[]
     */
    protected $notes;

    public function __construct(Info $info, string ... $notes)
    {
        $this->info = $info;

        $this->notes = $notes;
    }

    public function getInfo()
    {
        $result = $this->info->getInfo();

        for($i = 0, $max = min(static::SIZE, count($this->notes)); $i < $max; $i++) {
            $result['note'.($i+1)] = $this->notes[$i];
        }

        return $result;
    }
}
