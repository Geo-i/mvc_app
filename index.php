<?php

chdir(dirname(__DIR__));

define('ROOT_DIR', __DIR__);
define('APP_DIR',  ROOT_DIR . '/app');
define('CORE_DIR', APP_DIR . '/Core');

define('APP_MODE', getenv('APPLICATION_ENVIRONMENT'));
define('DEBUG', 1); // true | false

ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);

if (DEBUG){
    ini_set('display_errors', 1);
}

require ROOT_DIR . '/vendor/autoload.php';
include APP_DIR . '/Application.php';
return App\Main::run();
