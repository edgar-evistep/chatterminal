<?php

namespace App\Chat\Management\Partition;

use App\Chat\Management\Commands\Commands;
use App\Chat\Management\Basis\Distribution;


class Partition extends Commands
{
    /**
     * Traits
     */
    use Distribution;

    /**
     * $commands is the list of commands
     * @var array|mixed|string
     */
    public $commands = [];

    /**
     * @var array|null
     */
    public $command_info = null;

    /**
     * @var null
     */
    public $mess = null;

    /**
     * @var string
     */
    public $mt = 'local';

    /**
     * @var array
     */
    public $mess_arr = [];

    public function __construct()
    {
        parent::__construct();
        $this->commands = parent::all();
    }


    /**
     * @param $str
     * @return bool|mixed
     */
    public function maintain($str, $mt)
    {
        $check = !((!isset($str) || empty($str) || !is_string($str)));
        if($check)
        {
            $this->mess = $str;
            $this->mt = $mt;
            $this->mess_arr = explode(' ', $this->mess);
            return true;
        }
        return false;
    }

    /**
     * @param $str
     * @param $mt
     * @return bool|mixed
     */
    public function partition($str, $mt)
    {
        if($this->maintain($str, $mt) && $this->commands) {
//            foreach ($this->mess_arr as $item) {
//                if (parent::get($item)) {
//                    $this->command_info = parent::get($item);
//                    return $this->distribution();
//                }
//            }
            foreach ($this->commands as $item => $val) {
                if(in_array($item, $this->mess_arr))
                {
                    $this->command_info = parent::get($item);
                    return $this->distribution();
                }
            }
        }
        return true;
    }

    /**
     * @return bool|mixed
     */
    public function distribution()
    {
        if(is_array($this->command_info))
        {
            $mandatory = !isset($this->command_info['mandatory']) || empty($this->command_info['mandatory']) || !is_array($this->command_info['mandatory']) ?  false :  $this->command_info['mandatory'];
            $status = true;
            $fun_name = !isset($this->command_info['class']) || empty($this->command_info['class']) ? false : $this->command_info['class'];
            if($mandatory && is_array($mandatory))
            {
                foreach ($mandatory as $item) {
                    $status = in_array($item, $this->mess_arr);
                }
            }
            if($status && $fun_name && is_string($fun_name)) return $this->$fun_name($this->mess, $this->mess_arr, $this->command_info, $this->mt);
        }
        return true;
    }

}
