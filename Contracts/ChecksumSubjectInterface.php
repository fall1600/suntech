<?php

namespace fall1600\Package\Suntech\Contracts;

/**
 * 受檢核碼檢驗的物件要提供此行為
 */
interface ChecksumSubjectInterface
{
    /**
     * @param string $tradePassword
     * @return string
     */
    public function prepareChecksumParameter(string $tradePassword);
}
