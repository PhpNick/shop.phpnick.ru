<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected static function getCaptcha($secretKey){
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".env("CAPTCHA_SECRET_KEY")."&response={$secretKey}");
        $return = json_decode($response);
        return $return;
    }	
}
