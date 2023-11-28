<?php
/**  * Created by PhpStorm.
 * Date: 5/4/2019
 * Time: 1:53 PM
 */

namespace App\Helper;


use Carbon\Carbon;

class HdLog
{
    protected $path;
    protected $prefix = 'hadesker_';
    protected $date;

    public function __construct($prefix = null)
    {
        $this->prefix = $prefix ?? $this->prefix;
        $this->date = now()->format('Y_m_d');
    }

    private static $instance;
    public static function getInstance($prefix = null){
        if(!self::$instance){
            self::$instance = new self($prefix);
        }
        return self::$instance;
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function getPath()
    {
        return $this->path ?? public_path('logs');
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function getFullPath()
    {
        return "{$this->getPath()}/{$this->prefix}_{$this->date}.log";
    }

    public function logData($data)
    {
        try{
            switch(gettype($data)){
                case 'string': {
                    $stringLog = $data;
                } break;
                case 'array' || 'object': {
                    $stringLog = json_encode($data);
                } break;
                default: $stringLog = get_class($data);
            }

            $date = Carbon::now()->format('Y-m-d H:i:s');

            $user = exec('whoami');
            $user = str_slug($user);
            file_put_contents($this->getFullPath(), "[{$date}] {$user}: {$stringLog}" . PHP_EOL , FILE_APPEND);
        } catch (\Exception $exception){

        }
    }
}
