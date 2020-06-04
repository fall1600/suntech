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
     * 查詢-測試環境
     * @var string
     */
    public const QUERY_URL_TEST = 'https://test.esafe.com.tw/Service/PaymentCheck.aspx';

    /**
     * 查詢-正式環境
     * @var string
     */
    public const QUERY_URL_PRODUCTION = 'https://www.esafe.com.tw/Service/PaymentCheck.aspx';

    /**
     * 選收件店-測試環境
     */
    public const SELECT_STORE_URL_TEST = 'https://www.esafe.com.tw/Service/Store_Select.aspx';

    /**
     * 選收件店-正式環境
     */
    public const SELECT_STORE_URL_PRODUCTION = 'https://test.esafe.com.tw/Service/Store_Select.aspx';

    /**
     * 決定URL 要使用正式或測試機
     * @var bool
     */
    protected $isProduction = true;

    /** @var Merchant */
    protected $merchant;

    protected $formId = 'suntech-form';

    public function selectStore(StoreRequest $request)
    {
        echo <<<EOT
        <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8">
                </head>
                <body>
                    {$this->generateStoreForm($request)}
                    <script>
                        var form = document.getElementById("$this->formId");
                        form.submit();
                    </script>
                </bod>
            </html>
        EOT;
    }
    
    public function checkout(Info $info)
    {
        echo <<<EOT
        <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8">
                </head>
                <body>
                    {$this->generateForm($info)}
                    <script>
                        var form = document.getElementById("$this->formId");
                        form.submit();
                    </script>
                </bod>
            </html>
        EOT;
    }

    public function generateForm(Info $info)
    {
        if (! $this->merchant) {
            throw new \LogicException('empty merchant');
        }

        $url = $this->isProduction? static::CHECKOUT_URL_PRODUCTION: static::CHECKOUT_URL_TEST;

        $checksum = $this->merchant->countChecksum($info);

        $form = "<form name='suntech' id='$this->formId' method='post' action='$url' style='display: none'>";
        $form .= "<input type='hidden' name='ChkValue' value='$checksum' />";

        foreach ($info->getInfo() as $key => $value) {
            $form .=  "<input type='hidden' name='$key' value='$value' />";
        }

        $form .= "</form>";

        return $form;
    }

    public function generateStoreForm(StoreRequest $request)
    {
        if (! $this->merchant) {
            throw new \LogicException('empty merchant');
        }

        $url = $this->isProduction? static::SELECT_STORE_URL_PRODUCTION: static::SELECT_STORE_URL_TEST;

        $checksum = $this->merchant->countChecksum($request);

        $form = "<form name='suntech' id='$this->formId' method='post' action='$url' style='display: none'>";
        $form .= "<input type='hidden' name='ChkValue' value='$checksum' />";

        foreach ($request->toArray() as $key => $value) {
            $form .=  "<input type='hidden' name='$key' value='$value' />";
        }

        $form .= "</form>";

        return $form;
    }

    /**
     * @param QueryRequest $request
     * @return array
     */
    public function query(QueryRequest $request)
    {
        if (! $this->merchant) {
            throw new \LogicException('empty merchant');
        }

        $url = $this->isProduction? static::QUERY_URL_PRODUCTION: static::QUERY_URL_TEST;

        $payload = $request->getPayload() +
            [
                'ChkValue' => $this->merchant->countChecksum($request),
            ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));

        $resp = curl_exec($ch);
        curl_close($ch);

        return explode('##', $resp);
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

    /**
     * @param  bool  $isProduction
     * @return $this
     */
    public function setIsProduction(bool $isProduction)
    {
        $this->isProduction = $isProduction;

        return $this;
    }
}
