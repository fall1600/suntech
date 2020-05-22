<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Info\Info;
use fall1600\Package\Suntech\Info\InfoDecorator;

class Email extends InfoDecorator
{
    /**
     * 消費者電子郵件
     * @var Info
     */
    protected $info;

    /**
     * @var string
     */
    protected $email;

    public function __construct(Info $info, string $email)
    {
        $this->info = $info;

        $this->email = $email;
    }
    public function getInfo()
    {
        return $this->info->getInfo() +
            [
                'email' => $this->email,
            ];
    }
}
