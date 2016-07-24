<?php

namespace Core;

class Helper
{
    public static function getPasswordHash($pass)
    {
        $salt  = \App\Main::$config['pass_salt'];
        $cost = 10;

        return password_hash($pass, PASSWORD_DEFAULT, [
            'cost' => $cost,
            'salt' => $salt
        ]);
    }
}