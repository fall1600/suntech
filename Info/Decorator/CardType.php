<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Constants\CardType as Types;
use fall1600\Package\Suntech\Info\Info;
use fall1600\Package\Suntech\Info\InfoDecorator;

class CardType extends InfoDecorator
{
    /**
     * @var Info
     */
    protected $info;

    /**
     * 交易類別
     *  信用卡及銀聯卡可選填
     * @var string
     */
    protected $type;

    public function __construct(Info $info, string $type)
    {
        $this->info = $info;

        $this->setType($type);
    }

    public function getInfo()
    {
        return $this->info->getInfo() +
            [
                'Card_Type' => $this->type,
            ];
    }

    protected function setType(string $type)
    {
        if (! Types::isValid($type)) {
            throw new \LogicException("unsupported card type: $type");
        }

        $this->type = $type;
    }
}
