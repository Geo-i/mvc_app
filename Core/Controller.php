<?php

namespace Core;

use App\Application;

class Controller
{
    public $view;

    public function __construct()
    {
        $this->view = Application::$view;
    }

}