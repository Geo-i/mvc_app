<?php

namespace App;

class Application
{
    public static $config;
    public static $router;
    public static $dispatcher;
    public static $view;

    public static function run()
    {
        session_start();

        self::$config     = include APP_DIR . '/config/config-' . APP_MODE . '.php';
        self::$router     = new \Core\Router();
        self::$dispatcher = new \Core\Dispatcher();
        self::$view       = new \Core\View();

        try {
            $route = self::$router->getFinalRoute();
            echo self::$dispatcher->dispatch($route);
        } catch (\Exception $e) {
            \Core\ErrorHandler::process($e);// if error it set error message to view
            $route = self::$router->getRoute('error/index');
            echo self::$dispatcher->dispatch($route);
        }
    }
}