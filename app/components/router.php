<?php

class Router
{
    private array $routes;

    public function __construct($config)
    {
        $this->routes = $config;
    }

    public function run()
    {
        $uri = $this->getURI();
        foreach ($this->routes as $pattern => $value) {
            if ($uri === $pattern) {
                // var_dump($this->getControllerFile('contacts'));
                $segments = explode('/', $value);
                // var_dump($segments);
                $controllerName = ucfirst(array_shift($segments));
                // var_dump($controllerName);
                $method = array_shift($segments);
                // var_dump($method);
                $controllerFile = $this->getControllerFile($controllerName);
                // var_dump($controllerFile);
                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $controller = new $controllerName;
                    $controller->$method();
                } else {
                    echo 404;
                    exit();
                }
            }
        }
    }

    private function getControllerFile($controllerName)
    {
        return "../app/controllers/$controllerName.php";
    }

    private function getURI()
    {
        return $_SERVER['REQUEST_URI'];
    }
}
