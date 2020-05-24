<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Constants\AgencyType;
use fall1600\Package\Suntech\Constants\BankType;
use fall1600\Package\Suntech\Info\Info;

class Atm extends OfflinePay
{
    use ProductTrait;

    /**
     * @var string
     */
    protected $agencyBank;

    public function __construct(Info $info, int $ttl = OfflinePay::TTL, string $agencyBank = BankType::TAISHIN, string $userNo = null, string $billDate = null)
    {
        parent::__construct($info, $ttl);

        $this->setAgencyBank($agencyBank);

        $this->userNo = $userNo;

        $this->billDate = $billDate;
    }

    public function getInfo()
    {
        if (0 === count($this->products)) {
            throw new \LogicException('ATM payment needs product information, please call appendProduct method');
        }

        return parent::getInfo() +
            [
                'AgencyType' => AgencyType::ONLY_ATM,
                'AgencyBank' => $this->agencyBank,
            ] +
            $this->getProductInfo();
    }

    protected function setAgencyBank(string $agencyBank)
    {
        if (! BankType::isValid($agencyBank)) {
            throw new \LogicException("unsupported agencyBank: $agencyBank");
        }

        $this->agencyBank = $agencyBank;
    }
}
