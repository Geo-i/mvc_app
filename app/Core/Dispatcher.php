<?php

namespace Core;

class Dispatcher
{

    private $controller, $action;
    private $controller_name;

    public function process($route)
    {
        $controller_name       = $route['controller'] . 'Controller';
        $this->controller_name = $controller_name;
        $controller_path       = APP_DIR . '/Controllers/' . $controller_name . '.php';
        if (file_exists($controller_path)) {
            include $controller_path;
            $this->controller = new $controller_name();

            if (method_exists($this->controller, $route['action'])) {
                $this->action = $route['action'];
            } else {
                throw new \Exception('Method ' . $route['action'] . ' not found in Controller ' . $controller_name, 404);
            }
        } else {
            throw new \Exception('Controller ' . $controller_name . ' not found', 404);
        }
    }

    public function dispatch($route)
    {
        $this->process($route);
        ob_start();
        $this->controller->{$this->action}();
//        $controller_output = ob_get_clean();

        return $this->controller->view->render($this->controller_name, $this->action);
    }
}