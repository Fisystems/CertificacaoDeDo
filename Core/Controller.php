<?php
namespace Core;

use Config\Response;

class Controller {
    protected $router;

    public function __construct() {
        $this->router = new Router();
    }
    protected function getMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }

    protected function getRequestData(){
        switch($this->getMethod()){
            case 'GET':
                return $_GET;
                break;
            case 'PUT':
            case 'DELETE':
                $header = getallheaders();
                if (isset($header['Content-Type']) && $header['Content-Type'] == 'application/json') {
                    $data = json_decode(file_get_contents('php://input'));
                } else {
                    parse_str(file_get_contents('php://input'), $data);
                }
                return (array) $data;
                break;
            
            case 'POST':
                $data = json_decode(file_get_contents('php://input'));
                if (is_null($data))
                    $data = $_POST;
                return (array) $data;
                break;
        }
    }

    public function returnJson(string $code, string $message, array $data = []) {
        var_dump($this->getRequestData());
        exit();
        echo json_encode(Response::getResponse("C|DOC|S|200|001"));
        exit();
    }
}