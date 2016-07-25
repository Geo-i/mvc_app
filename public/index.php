<?php

chdir(dirname(__DIR__));

define('ROOT_DIR', __DIR__ . '/../');
define('APP_DIR', ROOT_DIR . '/app');
define('CORE_DIR', ROOT_DIR . '/Core');

define('APP_MODE', getenv('APPLICATION_ENVIRONMENT'));

error_reporting(E_ALL | E_STRICT);

if (APP_MODE === 'dev') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

require ROOT_DIR . '/vendor/autoload.php';
return App\Application::run();
