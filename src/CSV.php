<?php

/**
 * CSV Helper
 *
 * @author  Nick Tsai <myintaer@gmail.com>
 * @version 1.0.0
 * @see     https://github.com/yidas/php-helpers
 * @example 
 *   $rows = [
 *       ['id'=>'1', 'name'=>'Nick,Tsai'],
 *       ['id'=>'2', 'name'=>'John"M"'],
 *       ];
 *   foreach ($rows as $key => $row) {
 *       CSV::row($row);
 *   }
 *   CSV::output('My file');
 */
class CSV 
{
    /**
     * @var string Temporary CSV data
     */
    private static $data = '';

    /**
     * Add first row
     *
     * @param array $row Array data for a row
     */
    public static function firstRow($row)
    {
        self::reset();

        return self::row($row);
    }

    /**
     * Add a row
     *
     * @param array $row Array data for a row
     */
    public static function row($row)
    {
        foreach ($row as $key => $value) {
            
            self::$data  .= self::_parseVal($value). ',';
        }

        self::$data .= "\r\n";

        return true;
    }

    /**
     * Add rows
     *
     * @param array $rows Collection of data arrays 
     * @param bool $reset Reset the data or not
     */
    public static function rows($rows, $reset=true)
    {
        if ($reset) {

            self::reset();
        }

        foreach ($rows as $key => $row) {
            
            self::row($row);
        }

        return true;
    }

    /**
     * Reset data
     *
     * @return bool Result
     */
    public static function reset()
    {
        self::$data = '';

        return true;
    }

    /**
     * Extract data
     *
     * @param bool $reset Reset the data or not
     * @return string Current CSV data
     */
    public static function get($reset=true)
    {
        $data = self::$data;

        if ($reset) {

            self::reset();
        }

        return $data;
    }

    /**
     * Output with header
     *
     * @param string $filename CSV filename without extension
     */
    public static function output($filename='output', $rows=NULL)
    {
        if ($rows) {

            self::rows($rows);
        }

        header("Content-type: text/x-csv");
        header("Content-Disposition: attachment; filename={$filename}.csv");

        echo self::get();
        exit;
    }

    /**
     * Value Parser
     *
     * @param string $value
     * @return string Vaild string value for CSV
     */
    private static function _parseVal($value)
    {
        $value = mb_convert_encoding($value , "Big5" , "UTF-8");

        // Double quote handling
        $value = str_replace('"', '""', $value);

        $value = "\"{$value}\"";

        return $value;
    }
}