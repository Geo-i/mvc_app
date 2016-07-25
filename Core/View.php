<?php

namespace Core;

class View
{
    private $templates_format = '.php';

    public $views_dir, $partials_dir, $title, $disable;

    public function __construct()
    {
        $config      = \App\Application::$config;
        $conf        = $config['view'];
        $this->title = $config['site']['title'];

        $this->views_dir    = $conf['views_dir'];
        $this->partials_dir = $conf['partials_dir'];

    }

    public function render($controller, $action, $custom_html = '')
    {
        $controller_name     = strtolower(substr($controller, 0, -10)); //обрезем слово Controller из названия контроллера
        $action_name         = strtolower($action);
        $controller_template = $this->views_dir . $controller_name . '/' . $action_name . $this->templates_format;
        if (file_exists($controller_template)) {
            ob_start();
            include $controller_template;
            $this->controller_html = ob_get_clean();


            return $this->renderLayout();
        } elseif ($this->disable) {
            //значит это ajax метод или метод с редиректом @todo закончить и проверить чтоб ошибки не шли в вывод
        } else {
            throw new \Exception('Template ' . $controller_template . ' not found', 404);
        }
    }

    public function renderLayout()
    {
        $main_layout = $this->views_dir . 'layout.php';
        ob_start();
        include $main_layout;
        return ob_get_clean();
    }

    public function disable($disable = true)
    {
        $this->disable = $disable;
    }
}