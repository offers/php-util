<?php
namespace Offers\Util;

class Strings
{
    /**
     * Trim a string to <= $len, ending on the end of a word, and
     * adding an ellipsis unless the snippet ends in one of . ? !
     *
     * @param string $str
     * @param int $len
     * @return string
     */
    public static function ellipsize($str, $len): string
    {
        //don't trim the string if it will fit in the requested $len
        if($len >= strlen($str)) {
            return $str;
        }

        //return normal substring if it will end at the end of a sentence
        if(in_array($str[$len - 1], array('!', '.', '?'))) {
            return substr($str, 0, $len);
        }

        //account for the fact that we'll add 3 periods
        $len -= 1;

        //the position of the last space at or before $len characters into $str
        $cutoff = strrpos($str, ' ', (-1 * (strlen($str) - ($len + 1))) + 1);

        $snippet = substr($str, 0, $cutoff);
        $last = $snippet[strlen($snippet) - 1];

        //don't add ellipsis if there is punctuation at the end
        if(in_array($last, array('!', '?', '.'))) {
            return $snippet;
        }

        //trim punctuation from the end
        if(in_array($last, array(':', ','))) {
            $snippet = substr($snippet, 0, strlen($snippet) - 1);
        }

        return $snippet . "…";
    }
}