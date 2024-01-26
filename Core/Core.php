<?php
    namespace Core;


    class Core {
        private $prefix;
        protected $router;

        function __construct() {
            $this->router        = new Router;
            $this->prefix        = '\Controllers\\';
            require_once('../config/router.php');
        }

        private function notfound404() {
            $controllerInstance = new \Controllers\NotfoundController();
            $controllerInstance->index();
        }

        private function get_endpoint_url(){
            $url = '/';
            if (isset($_GET['url']) && !empty($_GET['url']))
                return $url .= $_GET['url'];
            return $url;
        }

        private function dispatchRoute($route) {
            $controllerName = $route['Controllers'];
            $actionName = $route['currentAction'];
            $controllerClassName = $this->prefix . ucfirst($controllerName) . "Controller";
       
            if (class_exists($controllerClassName) && method_exists($controllerClassName, $actionName)) {
                $controllerInstance = new $controllerClassName();
                $controllerInstance->$actionName();
            } 
            $this->notfound404();
        }

        private function checkRouter(){
            $test = $this->router->getRoute();
            $endpointUrl = $this->get_endpoint_url();
            $isValidRoute = false;
            foreach ($test as $route) {
                $regex = preg_replace_callback('/:(\w+)/', function($matches) {
                    return "(?P<{$matches[1]}>[\w-]+)";
                }, $route['path']);
                $regex = '/^' . str_replace('/', '\/', $regex) . '$/';        
                if ($_SERVER['REQUEST_METHOD'] === $route['method'] && preg_match($regex, $endpointUrl, $matches)) {
                    $isValidRoute = true;                
                    array_shift($matches);
                    var_dump($matches);
                    break;
                }
            }
            $this->dispatchRoute($route);
            if ($isValidRoute)       
                $this->dispatchRoute($route);
            $this->notfound404();
        }
        
        public function run(){     
            $this->checkRouter();
        }
    }