<?php

namespace Core;

use Core\Exceptions\RouteNotFound;
use Core\Exceptions\PageNotFound;

class Router
{

    private $requestUri, $requestedRoute, $finalRoute;

//    private $regex_path;

    public function process()
    {
        $this->parseRequestUri();

        $final_route = null;
        foreach (\App\Application::$config['routes'] as $route) {
            if ($this->checkRoute($route)) {
                $final_route = $route;
                break;
            }
        }

        if (!$final_route) {
            $e = new RouteNotFound();
            $e->setParsedRoute($this->requestedRoute);
            $e->setRequestUri($this->requestUri);
            throw $e;
        }

        $this->finalRoute = $final_route;
        return $this;
    }

    public function getFinalRoute()
    {
        $this->process();
        return $this->finalRoute;
    }

    public function parseRequestUri()
    {
        $this->requestUri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $path             = explode('/', $this->requestUri);
        $path             = array_filter($path); //чистка от пустых элементов
        $path             = implode('/', $path);

//        $this->regex_path = '';
        $this->requestedRoute = $path;
    }

    public function checkRoute($route)
    {
        if ($route['contain_regex']) {
            return $this->parseRegexRoute($route);
        } else {
            return $route['url'] === $this->requestedRoute;
        }
    }

    public function parseRegexRoute()
    {
        //заглушка если потребуется роут с условием, страничная навигация или ещё что-то
    }

    public function getRoute($name)
    {
        $routes = \App\Application::$config['routes'];
        return isset($routes[$name]) ? $routes[$name] : null;
    }
}