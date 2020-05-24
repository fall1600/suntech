<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Constants\AgencyType;
use fall1600\Package\Suntech\Constants\BankType;
use fall1600\Package\Suntech\Info\Info;

class Atm extends OfflinePay
{
    /**
     * @var string
     */
    protected $agencyType;

    /**
     * @var string
     */
    protected $agencyBank;

    /**
     * @var string|null
     */
    protected $userNo;

    /**
     * @var string|null
     */
    protected $billDate;

    public function __construct(Info $info, int $ttl = OfflinePay::TTL, string $agencyBank = BankType::TAISHIN, string $userNo = null, string $billDate = null)
    {
        parent::__construct($info, $ttl);

        $this->setAgencyBank($agencyBank);

        $this->userNo = $userNo;

        $this->billDate = $billDate;
    }

    public function getInfo()
    {
        return parent::getInfo() +
            [
                'UserNo' => $this->userNo ?? '',
                'BillDate' => $this->billDate ?? '',
                'AgencyType' => AgencyType::ONLY_ATM,
                'AgencyBank' => $this->agencyBank,
            ];
    }

    protected function setAgencyBank(string $agencyBank)
    {
        if (! BankType::isValid($agencyBank)) {
            throw new \LogicException("unsupported agencyBank: $agencyBank");
        }

        $this->agencyBank = $agencyBank;
    }
}
