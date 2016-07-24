<?php

namespace Core\Interfaces;

interface IMvcException
{
    /*
     * дополняет стандартный message
     */
    public function updMessage();


    /*
     * если требуются какие-то заголовки
     */
    public function sendHeaders();


    /*
     * @return Текст ошибки для гостей
     */
    public function getCustomerMessage();
}