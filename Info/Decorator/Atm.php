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

    public function __construct(Info $info, string $agencyType, string $agencyBank, int $ttl = OfflinePay::TTL)
    {
        parent::__construct($info, $ttl);

        $this->setAgencyType($agencyType);

        $this->setAgencyBank($agencyBank);
    }

    public function getInfo()
    {
        return $this->info->getInfo() +
            [
                'AgencyType' => $this->agencyType,
                'AgencyBank' => $this->agencyBank,
            ];
    }

    protected function setAgencyType(string $agencyType)
    {
        if (! AgencyType::isValid($agencyType)) {
            throw new \LogicException("unsupported agencyType: $agencyType");
        }

        $this->agencyType = $agencyType;
    }

    protected function setAgencyBank(string $agencyBank)
    {
        if (! BankType::isValid($agencyBank)) {
            throw new \LogicException("unsupported agencyBank: $agencyBank");
        }

        $this->agencyBank = $agencyBank;
    }
}
