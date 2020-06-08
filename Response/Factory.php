<?php

namespace fall1600\Package\Suntech\Response;

use fall1600\Package\Suntech\Constants\ServiceType;

class Factory
{
    /**
     * @param array $rawDate
     * @param string $type
     * @return AbstractResponse
     */
    public static function create(array $rawDate, string $type)
    {
        switch ($type) {
            case 'query':
                return new QueryResponse($rawDate);
            case 'payment':
                return new PaymentResponse($rawDate);
            case 'select-store':
                return new SelectStoreResponse($rawDate);
            case ServiceType::CREDIT:
                return new CreditCheckoutResponse($rawDate);
            case ServiceType::UNION_PAY:
                return new UnionPayCheckoutResponse($rawDate);
            case ServiceType::WEB_ATM:
                return new WebAtmCheckoutResponse($rawDate);
            case ServiceType::CVS_PAYCODE:
                return new CvsPaycodeCheckoutResponse($rawDate);
            case ServiceType::CVS_BARCODE:
                return new CvsBarcodeCheckoutResponse($rawDate);
            case ServiceType::ATM:
                return new AtmCheckoutResponse($rawDate);
            case ServiceType::TAIWAN_PAY:
                return new TaiwanPayCheckoutResponse($rawDate);
            default:
                throw new \LogicException('never goes here');
        }
    }
}
