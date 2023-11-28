<?php
namespace App\Helpers;

use Collective\Html\FormFacade;

class Helpers
{
    private static $form;
    public static function getFormInstance()
    {
        return self::$form ?? self::$form = app(FormFacade::class);
    }
}

include ('_base.php');

include('_mail.php');

include('_frontend_utility.php');

include('_backend_utility.php');

include('_api_utility.php');
