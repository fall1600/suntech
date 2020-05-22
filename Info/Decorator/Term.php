<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Constants\TermType;
use fall1600\Package\Suntech\Info\Info;
use fall1600\Package\Suntech\Info\InfoDecorator;

class Term extends InfoDecorator
{
    /**
     * @var Info
     */
    protected $info;

    /**
     * 分期期數
     *  參考 TermType
     * @var string
     */
    protected $term;

    public function __construct(Info $info, string $term)
    {
        $this->info = $info;

        $this->setTerm($term);
    }

    public function getInfo()
    {
        return $this->info->getInfo() +
            [
                'Term' => $this->term,
            ];
    }

    protected function setTerm(string $term)
    {
        if (! TermType::isValid($term)) {
            throw new \LogicException("unsupported term $term");
        }

        $this->term = $term;
    }
}
