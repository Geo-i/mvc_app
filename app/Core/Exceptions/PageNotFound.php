<?php

namespace Core\Exceptions;

use Core\Interfaces\IMvcException;

class PageNotFound extends \Exception implements IMvcException
{

    public function updMessage()
    {

    }

    public function sendHeaders()
    {
        header("HTTP/1.0 404 Not Found");
    }

}