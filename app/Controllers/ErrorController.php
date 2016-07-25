<?php

namespace App\Controllers;

use Core\Controller;
use Core\ErrorHandler;

class ErrorController extends Controller
{

    public function index()
    {
        $this->view->message = ErrorHandler::getMessage();

        if (APP_MODE === 'dev') { //дополнительно выводить в шаблон полный текст ошибки
            $this->view->debug_message = ErrorHandler::getDebugMessage();
        }

    }

}