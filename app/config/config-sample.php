<?php

/*
 * образец конфиг файла
 */

$global = include 'global.php';

$params = [
    'pass_salt' => 'some_salt....', // вообще соль можно каждому делать разную
    'db_mode' => 'mysql',
    'mysql'   => [
        'host'     => 'host...',
        'database' => 'database....',
        'user'     => 'username....',
        'pass'     => 'pass...',
    ],
];

return array_merge($global, $params);
