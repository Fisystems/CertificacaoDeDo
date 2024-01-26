<?php
namespace Config;
class Response {
    private static $responses = [
        "C|DOC|S|200|001"=> [
            "Message"=> "Sucesso",
            "Code"=> 200
        ],
        "C|DOC|E|400|002"=> [
            "Message"=> "Erro",
            "Code"=> 400
        ],
        "C|NOT|E|404|001"=> [
            "Message"=> "Not Found 404",
            "Code"=> 404
        ],
    ];

    public static function getResponse($key) {
        return self::$responses[$key] ?? null;
    }
}

// Exemplo de uso:
// $response = Response::getResponse("C|DOC|S|200|001");

