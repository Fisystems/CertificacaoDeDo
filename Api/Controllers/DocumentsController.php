<?php
namespace  Controllers;

use Core\Controller;
use services\DocumentsService;

class DocumentsController extends Controller
{
    public function getfile(){
// Verifica se o arquivo foi enviado corretamente
if ($_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
    // Caminho temporário do arquivo
    $tempFile = $_FILES['pdf']['tmp_name'];
    
    // Nome do arquivo original
    $fileName = $_FILES['pdf']['name'];
    
    // Move o arquivo do diretório temporário para o local desejado
    move_uploaded_file($tempFile, '/Applications/XAMPP/xamppfiles/htdocs/certificacao/Public/' . $fileName);

    // Calcular hash SHA-1
    $sha1Hash = sha1_file('/Applications/XAMPP/xamppfiles/htdocs/certificacao/Public/' . $fileName);

    // Calcular hash SHA-256
    $sha256Hash = hash_file('sha256', '/Applications/XAMPP/xamppfiles/htdocs/certificacao/Public/' . $fileName);

    // Calcular hash SHA-512
    $sha512Hash = hash_file('sha512', '/Applications/XAMPP/xamppfiles/htdocs/certificacao/Public/' . $fileName);

    // Responder com uma mensagem de sucesso e os hashes calculados
    echo 'Arquivo enviado com sucesso!' . '<br>';
    echo 'SHA-1: ' . $sha1Hash . '<br>';
    echo 'SHA-256: ' . $sha256Hash . '<br>';
    echo 'SHA-512: ' . $sha512Hash . '<br>';
} else {
    // Se houver algum erro no envio do arquivo, responda com uma mensagem de erro
    echo 'Erro no envio do arquivo.';
}

    }

    public function hash(){
        // $service = new DocumentsService();
         $this->getfile();

    }
}