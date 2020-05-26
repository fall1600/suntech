<?php

namespace fall1600\Package\Suntech;

use fall1600\Package\Suntech\Contracts\OrderInterface;
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
     * 決定URL 要使用正式或測試機
     * @var bool
     */
    protected $isProduction = true;

    /** @var Merchant */
    protected $merchant;

    protected $formId = 'suntech-form';

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

        $checksum = $this->merchant->countCheckSum(
            $this->merchant->getId().
            $this->merchant->getTradePassword().
            $info->getOrder()->getAmount().
            $info->getInfo()['Term'] ?? ''
        );

        $form = "<form name='suntech' id='$this->formId' method='post' action='$url' style='display: none'>";
        $form .= "<input type='hidden' name='ChkValue' value='$checksum' />";

        foreach ($info->getInfo() as $key => $value) {
            $form .=  "<input type='hidden' name='$key' value='$value' />";
        }

        $form .= "</form>";

        return $form;
    }

    /**
     * @param OrderInterface $order
     * @param string|null $buysafeno 紅陽提供的交易單號
     * @param string|null $orderNumber
     * @param string|null $note1
     * @param string|null $note2
     * @return array
     */
    public function query(
        OrderInterface $order,
        string $buysafeno = null,
        string $orderNumber = null,
        string $note1 = null,
        string $note2 = null
    ) {
        if (! $this->merchant) {
            throw new \LogicException('empty merchant');
        }

        $url = $this->isProduction? static::QUERY_URL_PRODUCTION: static::QUERY_URL_TEST;

        $str4checksum =
            $this->merchant->getId() . $this->merchant->getTradePassword() .
            $order->getAmount() . $buysafeno . $orderNumber . $note1 . $note2;

        $payload = [
            'web' => $this->merchant->getId(),
            'MN' => $order->getAmount(),
            'buysafeno' => $buysafeno,
            'Td' => $orderNumber,
            'note1' => $note1,
            'note2' => $note2,
            'ChkValue' => $this->merchant->countChecksum($str4checksum),
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
