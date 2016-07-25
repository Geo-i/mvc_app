<?php

namespace Core\Helpers;

class Helper
{
    public static function getPasswordHash($pass)
    {
        $salt  = \App\Application::$config['pass_salt'];
        $cost = 10;

        return password_hash($pass, PASSWORD_DEFAULT, [
            'cost' => $cost,
            'salt' => $salt
        ]);
    }
}