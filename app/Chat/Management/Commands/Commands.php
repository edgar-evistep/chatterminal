<?php

namespace App\Chat\Management\Commands;

use App\Chat\Management\Basis\BasicCommands;


class Commands
{
    /**
     * @var string
     */
    private $file = 'list_commands.php';

    /**
     * @var bool
     */
    private $path = false;

    /**
     * @var false|mixed
     */
    private $list_commands = false;

    public function __construct()
    {
        $this->path = app_path() . "/Chat/Management/Commands/" . $this->file;
        $this->list_commands = (file_exists($this->path)) ? include($this->path) : false;
    }

    /**
     * @return false|mixed
     */
    public function all()
    {
        return (isset($this->list_commands)) ? $this->list_commands : false;
    }

    /**
     * @param $key
     * @return false|mixed
     */
    public function get($key)
    {
        return (isset($this->list_commands[$key])) ? $this->list_commands[$key] : false;
    }

}
