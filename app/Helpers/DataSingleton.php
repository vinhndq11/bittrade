<?php
/**
 * Created by PhpStorm.
 * Date: 11/18/18
 * Time: 9:43 PM
 */

use App\Models\User;
use App\Models\Member;

class DataSingleton{
    private static $instance = null;

    private $token = null;
    private $user = null;

    public function __construct(){}

    public static function getInstance()
    {
        return self::$instance ?? (self::$instance = new self());
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param null $token
     * @return DataSingleton
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return User|Member
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param null $user
     * @return DataSingleton
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}
