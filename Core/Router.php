<?php
namespace Core;

class Router {
    public static $routes = [];

    public function addRoute($method, $path, $controllers, $currentAction) {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'Controllers' => $controllers,
            'currentAction' => $currentAction,
        ];
    }
     
    public function getRoute() {
        return self::$routes;
    }   
}
