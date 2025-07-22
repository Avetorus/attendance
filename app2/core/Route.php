<?php

class Route{
    protected array $routes = [];
    protected array $default;

    public function __construct() {
        
    }

    public function post(string $route, array $method){
        $this->routes[$route]["POST"] = $method;
    }

    public function get(string $route, array $method){
        $this->routes[$route]["GET"] = $method;
    }

    public function fallback(array $method){
        $this->default = $method;
    }

    public function resolve(string $route, string $method){
        if(isset($routes[$route][$method])){
            $action = $this->routes[$route][$method];
            [$class, $method] = $action;

            if(class_exists($class)){
                $class = new $class;

                if(method_exists($class, $method)){
                    return call_user_func([$class, $method]);
                }
            }
        }

        return call_user_func($this->default);
    }

}