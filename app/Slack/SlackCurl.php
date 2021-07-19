<?php

namespace App\Slack;

use GuzzleHttp\Client;


class SlackCurl
{

    public static function call($url, $headers, $method, $body = '')
    {
        if($url && $headers && $method)
        {
            $ch = curl_init();
            $body = json_encode($body);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }
        return false;
    }


}
