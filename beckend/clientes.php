<?php
require_once './src/controller/ClienteController.php';

$clienteController = new ClienteController();

$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : null;

if ($cpf) {
    // Permita o acesso a partir de qualquer origem (*)
    header("Access-Control-Allow-Origin: *");
    
    // Permita métodos específicos (GET, POST, OPTIONS, etc.)
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    
    // Permita cabeçalhos personalizados (se necessário)
    header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");
    
    // Permita credenciais (cookies, autenticação, etc.) se necessário
    header("Access-Control-Allow-Credentials: true");

    // Defina o tipo de conteúdo da resposta como JSON
    header("Content-Type: application/json");

    $resposta = $clienteController->getCliente($cpf);
    header('Content-Type: application/json');
    echo $resposta; 
} else {
    http_response_code(400); // Bad Request
    echo json_encode(['mensagem' => 'CPF não fornecido na solicitação']);
}
?>
