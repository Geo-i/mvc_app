<?php

chdir(dirname(__DIR__));

define('ROOT_DIR', __DIR__ . '/../');

require_once ROOT_DIR . '/app/config/defines.php';
require ROOT_DIR . '/vendor/autoload.php';
return App\Application::run();
