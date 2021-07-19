<?php

namespace App\Chat\Management\Basis;
use App\Chat\Management\Commands\Email\SendToEmailMessages;


trait Distribution
{

    public function __construct(){}

    public function SendToEmailMessages($str = false, $arr = false, $info = false, $mt = 'local')
    {
        return (!$str || !$arr || !$info) ? true : (new SendToEmailMessages)->establish($str, $arr, $info, $mt);
    }
}
