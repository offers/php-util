<?php
class RandomTest extends PHPUnit\Framework\TestCase
{
    public function testHexString()
    {
        $string = Offers\Util\Random::hexString(8);
        $this->assertEquals(8, strlen($string));
        $this->assertTrue(ctype_xdigit($string));
    }
}