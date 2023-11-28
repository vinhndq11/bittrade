<?php
/**
 * Filename: ValidResponse.php
 * Date: 9/15/20
 * Time: 11:28 PM
 */

namespace App\Helpers;

class ValidResponse{
    public $is_fail = false;
    private $waring = null;

    public function getWaring()
    {
        return $this->waring;
    }

    public function setWarning($callback)
    {
        $this->is_fail = true;
        $callback(function ($waring){
            $this->waring = $waring;
        });
    }
}
