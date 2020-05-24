<?php

namespace fall1600\Package\Suntech;

trait Cryption
{
    /**
     * @param string $input
     * @return string
     */
    public function countChecksum(string $input)
    {
        return strtoupper(sha1($input));
    }
}
