<?php
    namespace Core;


    class Core {
        private $currentAction; 
        private $prefix;
        private $notfound;
        protected $router;

        function __construct() {
            $this->currentAction = 'index';
            $this->notfound      = 'NotfoundController';
            $this->prefix        = '\Controllers\\';
            $this->router        = new Router;

            require_once('../config/router.php');
        }

        private function get_endpoint_url(){
            $url = '/';
            if (isset($_GET['url']) && !empty($_GET['url']))
                return $url .= $_GET['url'];
            return $url;
        }
        private function dispatchRoute($route) {
            // Obtenha o controlador e a ação atual
            $controllerName = $route['Controllers'];
            $actionName = $route['currentAction'];
    
            // Construa o nome completo da classe do controlador
            $controllerClassName = $this->prefix . ucfirst($controllerName) . "Controller";
            var_dump($controllerClassName);
            // $controllerClassName =  "DocumentsController";
            // Verifique se a classe do controlador existe
            // new DocumentsController;
            if(class_exists($controllerClassName)) {
                // Instancie o controlador corretamente
                $controllerInstance = new $controllerClassName();
    
                // Verifique se a ação existe no controlador
                if (method_exists($controllerInstance, $actionName)) {
                    // Chame a ação no controlador
                    $controllerInstance->$actionName();
                } else {
                    // A ação não existe, trata isso como uma rota inválida
                    var_dump("Ação não encontrada: $actionName");
                }
            } else {
                // O controlador não existe, trata isso como uma rota inválida
                var_dump("Controlador não encontrado: $controllerClassName");
            }
        }

        private function checkRouter(){

            $test = $this->router->getRoute();
            $endpointUrl = $this->get_endpoint_url();
            
            // Verifica se a rota atual está dentro das rotas definidas
            $isValidRoute = false;
            foreach ($test as $route) {
                // Converte a rota em uma expressão regular para coincidir com a URL atual
                $regex = preg_replace_callback('/:(\w+)/', function($matches) {
                    return "(?P<{$matches[1]}>[\w-]+)";
                }, $route['path']);
        
                // Adiciona delimitadores para garantir que seja uma correspondência exata
                $regex = '/^' . str_replace('/', '\/', $regex) . '$/';
        
                // Tenta fazer uma correspondência com a URL atual
                if ($_SERVER['REQUEST_METHOD'] === $route['method'] && preg_match($regex, $endpointUrl, $matches)) {
                    $isValidRoute = true;
                
                    // Não é necessário remover o primeiro elemento, pois ele é a URL completa
                    array_shift($matches);
                    var_dump($matches);
                    // Salva os parâmetros da URL no array $ParamUrl
                    break;
                }
            }
        
            if ($isValidRoute) {
                var_dump("Rota válida!");
            
                $this->dispatchRoute($route);
            } else {
                var_dump("Rota inválida!");
                // Execute qualquer ação de tratamento para rotas inválidas
            }
        }
        
        
        
        
        public function run(){     
 
            $this->checkRouter();

        }
    }