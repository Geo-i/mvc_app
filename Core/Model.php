<?php

namespace Core;

use Core\Databases\MysqlDB;
use Core\Interfaces\IMvcDatabase;

class Model
{
    private $db;

    public function __get($name)
    {
        $config = \App\Application::$config;

        if ($name === 'db') {

            if (is_null($this->db)) {
                $className = '\\Core\\Databases\\' . $config['db_mode'];

                $reflectionClass = new \ReflectionClass($className);
                $db              = $reflectionClass
                    ->newInstanceArgs(); // это метод ReflectionClass возвращающий новый объект

                if ($db instanceof IMvcDatabase) {
                    $this->db = $db->getConnection();
                } else {
                    throw new \Exception('Invalid DB Connector');
                }

            }
        }
        return $this->{$name};
    }
}