<?php

namespace yidas\helpers;

/**
 * ASCII Helper
 *
 * @author  Nick Tsai <myintaer@gmail.com>
 * @version 1.0.0
 */
class ASCII
{
    /**
     * Decode ASCII string (normalization)
     *
     * @param string $string
     * @return string Decoded string
     */
    public static function stringDecode($string)
    {
        $length = strlen($string);

        $newString = '';
        
        for ($i=0; $i < $length; $i++) { 
            $asciiCode = ord($string[$i]);
            $newString .= self::asciiToChar($asciiCode);
        }

        return $newString;
    }
    /**
     * Filter abnormal character to format string
     *
     * @param int $asciiCode
     * @return string 
     */
    public static function asciiToChar($asciiCode, $prefix='_', $postfix='_')
    {
        if (($asciiCode>126 || $asciiCode<32) 
            && !in_array($asciiCode, [13, 10])) {
            
            return "{$prefix}{$asciiCode}{$postfix}";

        } else {

            return chr($asciiCode);
        }
    }
}