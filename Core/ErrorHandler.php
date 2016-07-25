<?php

namespace Core;

use Core\Interfaces\IMvcException;

//use Core\Exceptions\RouteNotFound;
//use Core\Exceptions\PageNotFound;

class ErrorHandler
{
    public static $message = 'some error';
    public static $debug_message;

    /* @todo отправка верного заголовка 404, 301, 403  и т.п.
     *
     */
    public static function process($e)
    {
        self::setDebugMessage($e);

        if ($e instanceof IMvcException) {
            $e->sendHeaders();
            self::setMessage($e->getCustomerMessage());
            //@todo ещё какую-то операцию, предусмотренную реализацией IMvcException
            // например отправка лога админу
        } else {
            header("HTTP/1.0 404 Not Found");
        }


    }

    public static function setMessage($message)
    {
        self::$message = $message;
    }

    public static function getMessage()
    {
        return self::$message;
    }

    public static function setDebugMessage($e)
    {
        self::$debug_message = $e->__toString();
    }

    public static function getDebugMessage()
    {
        return self::$debug_message;
    }

}