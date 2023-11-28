<?php
/**
 * Filename: GenerateNumber.php
 * Date: 8/17/20
 * Time: 8:10 PM
 */

namespace App\Helpers;


class GenerateNumber
{
    protected static $instance = null;
    public static function getInstance()
    {
        return self::$instance ?? self::$instance = new self();
    }

    public $STRING_CASE_UPPER = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    public $STRING_CASE_LOWER = "abcdefghijklmnopqrstuvwxyz";
    public $STRING_NUMBER = "0123456789";
    public $STRING_SPECIAL = '!"#$%&\'()*+,-./:;<=>?@[\]^_`{|}~';
    public function get($len = 10, $characters = null)
    {
        if(!$characters){
            $characters = $this->STRING_CASE_UPPER . $this->STRING_CASE_LOWER . $this->STRING_NUMBER . $this->STRING_SPECIAL;
        }
        $charArray = str_split($characters);
        $result = '';
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= $charArray[$randItem];
        }
        return $result;
    }
}
