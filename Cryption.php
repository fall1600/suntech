<?php

namespace fall1600\Package\Suntech;

trait Cryption
{
    protected $tradePassword;

    /**
     * @param array $payload
     * @return string
     */
    public function countChecksum(array $payload)
    {
        $str = $payload['web'] .
            $this->tradePassword.
            $payload['MN'].
            $payload['buysafeno'].
            $payload['Td'].
            $payload['note1'].
            $payload['note2'];
        return strtoupper(sha1($str));
    }
}
