<?php
namespace Offers\Util;

class Random
{
    public static function hexString($len)
    {
        $bytes = openssl_random_pseudo_bytes(ceil($len / 2));
        return substr(bin2hex($bytes), 0, $len);
    }
}


