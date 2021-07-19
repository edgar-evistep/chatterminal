<?php


namespace App\Chat\Management\Basis\Commands\Email;


interface SendToEmailMessages
{
    /**
     * @param $message
     * @param $message_arr
     * @param $info
     * @return mixed
     */
    public function redistribution($message, $message_arr, $info);

    /**
     * @param $str
     * @param $arr
     * @param $info
     * @return mixed
     */
    public function establish($str, $arr, $info);
}
