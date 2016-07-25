<?php

namespace Core\Databases;

use Core\Interfaces\IMvcDatabase;
use PDO;

class MysqlDB implements IMvcDatabase
{
    public $connection;

    public function __construct()
    {
        $config = \App\Application::$config;
        $conf = $config[$config['db_mode']];

        $dsn              = "mysql:host=" . $conf['host'] . ";dbname=" . $conf['database'] . ";charset=utf8";
        $opt              = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->connection = new PDO($dsn, $conf['user'], $conf['pass'], $opt);

    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

}