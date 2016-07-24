<?php

namespace Core\Exceptions;

use Core\Interfaces\IMvcException;

class RouteNotFound extends \Exception implements IMvcException
{
    private $in_message;

    private $uri, $route_template;

    public function __construct($message = 'Route not found')
    {
        parent::__construct($message);
        $this->in_message = $message;
    }

    public function updMessage()
    {
        $ru = $this->uri ? " |  Requested uri: " . $this->uri : '';
        $rt = $this->route_template ? " |  Parsed route template: " . $this->route_template : '';

        $this->message =  $this->in_message . $ru . $rt;
    }

    public function setParsedRoute($route_template)
    {
        $this->route_template = $route_template;
        $this->updMessage();
    }

    public function setRequestUri($uri)
    {
        $this->uri = $uri;
        $this->updMessage();
    }

    public function sendHeaders()
    {
        header("HTTP/1.0 400 Bad Request");
    }

    public function getCustomerMessage()
    {
        return 'Ошибка. Не верный адрес страницы, пожалуйста, проверьте правильность ссылки.';
    }

    //@todo - $this->setRefer()- это для записи в лог, если рефер внутренний, значит на сайте есть битая ссылка, её надо починить
    //а если рефер внешний, то возможно даже не стоит логировать
}