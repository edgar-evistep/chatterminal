<?php

namespace App\Chat;

use App\Chat\Support\Clean\ToClean;
use App\Chat\Management\Partition\Partition;


class Chat extends Partition
{
    /**
     * Traits
     */
    use ToClean;


    public $message;


    public function __construct()
    {
        parent::__construct();
    }


    public function prepare($message, $mt = 'local')
    {
        $message = $this->to_clean($message);
        if(empty($message)) return false;
        return $this->division($message, $mt);
    }


    public function division($str, $mt)
    {
        return parent::partition($str, $mt);
    }


}
