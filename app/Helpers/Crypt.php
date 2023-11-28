<?php
/**
 * Filename: Cryption.php
 * Date: 3/24/20
 * Time: 1:29 AM
 */

namespace App\Helpers;


class Crypt
{
    private static $cryptInstance = null;
    private static $key = null;

    private static function getCryptInstance()
    {
        return static::$cryptInstance ?? static::$cryptInstance = new \Illuminate\Encryption\Encrypter(static::$key, config('app.cipher'));
    }

    public static function setKey($key)
    {
        static::$key = $key;
    }

    public static function encrypt($value, $serialize = true)
    {
        return static::getCryptInstance()->encrypt($value, $serialize);
    }

    public static function decrypt($payload, $unserialize = true)
    {
        return static::getCryptInstance()->decrypt($payload, $unserialize);
    }
}
