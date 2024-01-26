<?php
namespace Core;

class Router {
    public static $routes = [];
    private static $routeList = [];

    public function addRoute($method, $path, $controllers, $currentAction) {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'Controllers' => $controllers,
            'currentAction' => $currentAction,
        ];

        self::$routeList[] = [
            'method' => $method,
            'path' => $path,
        ];
    }
     
    public function getRouteList() {
        return self::$routeList;
    }

    public function getRoute() {
        return self::$routes;
    }
}
