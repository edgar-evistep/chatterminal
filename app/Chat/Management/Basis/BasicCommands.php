<?php

namespace App\Chat\Management\Basis;


interface BasicCommands
{
    /**
     * @param $str
     * @param $arr
     * @param $info
     * @return mixed
     */
    public function SendToEmailMessages($str, $arr, $info);

}
