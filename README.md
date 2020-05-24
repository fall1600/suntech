# Suntech 紅陽金流

[Official Doc](https://www.esafe.com.tw/Question_Fd/DownloadPapers.aspx)

## How to use

#### 建立交易資訊 (BasicInfo)
 - $merchantId: 你在紅陽申請的商店代號
 - $order: 你的訂單物件, 務必實作package 中的OrderInterface
 - $payer: 你的付款人物件, 務必實作package 中的PayerInterface 
```php
$info = new BasicInfo($merchantId, $order, $payer);
```

#### 建立Suntech 物件, 注入商店資訊, 帶著交易資訊前往紅陽付款
 - $merchantId: 你在紅陽商店代號
 - $tradePassword: 交易密碼
 
```php
$suntech = new Suntech();
$suntech
    ->setIsProduction(false) // 設定環境, 預設就是走正式機
    ->setMerchant(new Merchant($merchantId, $tradePassword))
    ->checkout($info);
```

#### 請在你的訂單物件實作 OrderInterface

```php
<?php

namespace Your\Namespace;

use fall1600\Package\Suntech\Contracts\OrderInterface;

class Order implements OrderInterface
{
    // your order detail...
}

```

#### 請在你的付款人(假設是Member), 實作PayerInterface

```php
<?php

namespace Your\Namespace;

use fall1600\Package\Suntech\Contracts\PayerInterface;

class Member implements PayerInterface
{
    // your member detail...
}
```

#### 解開來自紅陽的交易通知
```php
$isValid = $merchant->setRawData($request->all())->validateResponse(); //確認為true 後再往下走

// response 封裝了通知交易的結果, 以下僅列常用methods
$response = $merchant->getResponse();

// todo: checkout 跟 query 的response 是不同的介面 
```


#### 單筆交易查詢
```php
$resp = $suntech
    ->setMerchant($merchant)
    ->query($order, $buySafeNo = null, $orderNumber = null, $note1 = null, $note2 = null);

$isValid = $merchant->setRawData($resp)->validResponse(); // 查詢的response, 有需要也可以validate

```