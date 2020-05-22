<?php

namespace fall1600\Package\Suntech;

use fall1600\Package\Suntech\Info\Info;

class Suntech
{
    /**
     * 付款-測試環境
     * @var string
     */
    public const CHECKOUT_URL_TEST = 'https://test.esafe.com.tw/Service/Etopm.aspx';

    /**
     * 付款-正式環境
     * @var string
     */
    public const CHECKOUT_URL_PRODUCTION = 'https://www.esafe.com.tw/Service/Etopm.aspx';

    /**
     * 決定URL 要使用正式或測試機
     * @var bool
     */
    protected $isProduction = true;

    /** @var Merchant */
    protected $merchant;

    protected $formId;

    public function checkout()
    {
    }

    public function generateForm(Info $info)
    {
        if (! $this->merchant) {
            throw new \LogicException('empty merchant');
        }

        $url = $this->isProduction? static::CHECKOUT_URL_PRODUCTION: static::CHECKOUT_URL_TEST;

        $checksum = $this->merchant->countCheckSum($info);

        $form = "<form name='suntech' id='$this->formId' method='post' action='$url' style='display: none'>";
        $form .= "<input type='hidden' name='ChkValue' value='$checksum' />";

        foreach ($info->getInfo() as $key => $value) {
            $form .=  "<input type='hidden' name='$key' value='$value' />";
        }

        $form .= "</form>";

        return $form;
    }

    public function query()
    {
    }

    /**
     * @param string $formId
     * @return $this
     */
    public function setFormId(string $formId)
    {
        $this->formId = $formId;

        return $this;
    }

    /**
     * @param Merchant $merchant
     * @return $this
     */
    public function setMerchant(Merchant $merchant)
    {
        $this->merchant = $merchant;

        return $this;
    }
}
