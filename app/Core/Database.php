<?php

namespace Core;

use PDO;

class Database
{
    public $connection;

    public function __construct($config)
    {
        $conf = $config[$config['db_mode']];

        $dsn              = "mysql:host=" . $conf['host'] . ";dbname=" . $conf['database'] . ";charset=utf8";
        $opt              = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->connection = new PDO($dsn, $conf['user'], $conf['pass'], $opt);

    }

}