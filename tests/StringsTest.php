<?php
class StringsTest extends PHPUnit\Framework\TestCase
{
    public function testEllipsize()
    {
        $string = "The quick brown fox: jumped over the lazy dog!";
        $shortened = \Offers\Util\Strings::ellipsize($string, 5);
        $this->assertEquals("The…", $shortened);
        $this->assertEquals("The quick brown fox…", \Offers\Util\Strings::ellipsize($string, 20));
        $this->assertEquals("The quick brown fox: jumped over the lazy…", \Offers\Util\Strings::ellipsize($string, 45));
    }
}