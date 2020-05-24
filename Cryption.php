<?php

namespace fall1600\Package\Suntech;

trait Cryption
{
    protected $tradePassword;

    public function countChecksum(array $payload)
    {
        $str = $payload['web'] .
            $this->tradePassword.
            $payload['MN'].
            $payload['buysafeno'].
            $payload['Td'].
            $payload['note1'].
            $payload['note2'];
        return sha1($str);
    }
}
