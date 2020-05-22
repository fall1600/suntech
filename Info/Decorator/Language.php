<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Constants\LanguageType;
use fall1600\Package\Suntech\Info\Info;
use fall1600\Package\Suntech\Info\InfoDecorator;

class Language extends InfoDecorator
{
    /**
     * @var Info
     */
    protected $info;

    /**
     * 付款頁面語言
     * @var string
     */
    protected $language;

    public function __construct(Info $info, string $language)
    {
        $this->info = $info;

        $this->setLanguage($language);
    }

    public function getInfo()
    {
        return $this->info->getInfo() +
            [
                'Country_Type' => $this->language,
            ];
    }

    protected function setLanguage(string $language)
    {
        if (! LanguageType::isValid($language)) {
            throw new \LogicException("unsupported language: $language");
        }

        $this->language = $language;
    }
}
