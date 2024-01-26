<?php
use Core\Router;
$router = new Router();
$router->addRoute('POST',   '/documents',                  "Documents", "Index"); // Criar um novo documento
$router->addRoute('GET',    '/documents/:id',              "Documents", "exibir"); // Obter informações de um documento específico
$router->addRoute('PUT',    '/documents/:id',              "Documents", "Index"); // Atualizar um documento existente
$router->addRoute('DELETE', '/documents/:id',              "Documents", "Index"); // Excluir um documento
//tags 
$router->addRoute('POST',   '/documents/:id/tags',         "Documents", "addTag"); // Adicionar tag a um documento
$router->addRoute('DELETE', '/documents/:id/tags/:tag',    "Documents", "removeTag"); // Remover tag de um documento
