<?php

namespace App\Chat\Support\Clean;


trait ToClean
{
    /**
     * @param $data
     * @return false|mixed
     */
    public function to_clean($data)
    {
        if(is_string($data)) return $this->to_clean_string($data);
//        if(is_array($data)) return $this->to_clean_array($data);
//        if(is_object($data)) return $this->to_clean_object($data);
        return false;
    }

    /**
     * @param $string
     * @return array|false|string|string[]|null
     */
    public static function to_clean_string($string)
    {
        if(!is_string($string)) return false;
        return preg_replace('/\s+/', ' ', $string);
    }

    public function full_clean($string)
    {
        if(!is_string($string)) return false;
        $string = preg_replace('/\s+/', ' ', $string);
        $string = preg_replace('/"/', '', $string);
        return preg_replace('/\'/', '', $string);
    }


//    public static function to_clean_array($array)
//    {
//        if(is_array($array)) return false;
//        dd($array);
//    }
//
//    public static function to_clean_object($object)
//    {
//        if(is_object($object)) return false;
//        dd($object);
//    }
}
