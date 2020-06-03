# Suntech 紅陽金流

[Official Doc](https://www.esafe.com.tw/Question_Fd/DownloadPapers.aspx)

簡述: 在紅陽金流裡商城與付款方式綁定, 一個商城id 代表一種付款方式, 轉導至結帳頁時也只會顯示一種付款方式

#### 支援付款方式
- [x] 信用卡
- [x] 銀聯卡
- [x] 虛擬ATM
- [x] 超商代收(條碼繳費單)
- [x] 超商代碼
- [x] WebATM
- [ ] 台灣pay
- [ ] 超商取貨付款

## How to use

#### 控制交易方式
 - $merchantId: 你在紅陽申請的商店代號
 - $order: 你的訂單物件, 務必實作package 中的OrderInterface
 - $payer: 你的付款人物件, 務必實作package 中的PayerInterface 

```php
// 信用卡付款
$info = new CreditInfo($creditMerchantId, $order, $payer);
```

```php
// 銀聯卡付款, 與信用卡共用merchantId, webhook url設定; 文件第7頁
$info = new UnionPayInfo($unionMerchantId, $order, $payer);
```

```php
// 虛擬Atm 付款, 與超商代收(條碼繳費單) 共用merchantId, webhook url設定; 文件第8頁
$info = new AtmInfo($atmMerchantId, $order, $payer);
```

```php
// 超商代收(條碼繳費單)
$info = new CvsBarcodeInfo($barcodeMerchantId, $order, $payer);
```

```php
// 超商代碼(ibon, FamiPort 那種)
$info = new CvsPaycodeInfo($paycodeMerchantId, $order, $payer);
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
// 信用卡的交易結果
$isValid = $merchant->setRawData($request->all(), ServiceType::CREDIT)->validateResponse();
// 超商代碼的交易結果
$isValid = $merchant->setRawData($request->all(), ServiceType::CVS_PAYCODE)->validateResponse();
// 超商代收(條碼繳費單)的交易結果
$isValid = $merchant->setRawData($request->all(), ServiceType::CVS_BARCODE)->validateResponse();
// 虛擬ATM 的交易結果
$isValid = $merchant->setRawData($request->all(), ServiceType::ATM)->validateResponse();
// WebATM 的交易結果
$isValid = $merchant->setRawData($request->all(), ServiceType::WEB_ATM)->validateResponse();

// response 封裝了通知交易的結果, 以下僅列常用methods
$resp = $merchant->getResponse();
// 商城id
$resp->getMerchantId();
// 紅陽提供的交易代碼
$resp->getBuySafeNo();
// 交易金額
$resp->getAmount();
// 此回傳的檢核碼
$resp->getChecksum();
// 整包payload
$resp->getData();
```


#### 單筆交易查詢
```php
$resp = $suntech
    ->setMerchant($merchant)
    ->query(new QueryRequest($merchantId, $order, $buySafeNo = null, $orderNumber = null, $note1 = null, $note2 = null));

$isValid = $merchant->setRawData($resp, 'query')->validResponse(); // 查詢的response, 有需要也可以validate
```