<?php

namespace Core;

use App\Main;

class Controller
{
    public $view;

    public function __construct()
    {
        $this->view = Main::$view;
    }

}