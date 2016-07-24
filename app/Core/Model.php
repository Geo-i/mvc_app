<?php

namespace Core;

class Model
{
    private $db;

    public function __get($name){
        $config = \App\Main::$config;

        if($name === 'db'){
            if(is_null($this->db)){
                $this->db = (new Database($config))->connection;
            }
        }
        return $this->{$name};
    }
}