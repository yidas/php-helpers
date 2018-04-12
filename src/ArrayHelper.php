<?php

namespace yidas\helpers;

/**
 * Array Helper
 *
 * @author  Nick Tsai <myintaer@gmail.com>
 * @version 1.0.0
 * @see     https://github.com/yidas/php-helpers
 * @example 
 *  ArrayHelper::indexBy($modelData, 'sn');
 */
class ArrayHelper
{
    /**
     * Index by Key
     *
     * @param array $array Array data for handling
     * @param string $key  Array key for index key
     * @param bool $obj2Array Object converts to array if is object
     * @return array Result with indexBy Key
     */
    public static function indexBy(Array &$array, $key='id', $obj2Array=false)
    {
        $tmp = [];

        foreach ($array as $row) {

            if (is_object($row) && isset($row->$key)) {
                
                $tmp[$row->$key] = ($obj2Array) ? (array)$row : $row;

            } 
            elseif (is_array($row) && isset($row[$key])) {

                $tmp[$row[$key]] = $row;
            }
        }

        return $array = $tmp;
    }
}
