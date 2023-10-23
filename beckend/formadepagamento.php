<?php
require_once './src/controller/formadepagamentoController.php';

$formaDePagamentoController = new FormaDePagamentoController();

// Obtenha o valor do parâmetro "id" da URL, se estiver definido
$numero = isset($_GET['id']) ? $_GET['id'] : null;

if ($numero !== null) {
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

    // Chame a função para obter a forma de pagamento
    $formaPagamento = $formaDePagamentoController->getFormaDePagamento($numero);

    if ($formaPagamento) {
        header('Content-Type: application/json');
        echo $formaPagamento;
    } else {
        http_response_code(404); // Not Found
        echo json_encode(['mensagem' => 'Forma de pagamento não encontrada']);
    }
} else {
    http_response_code(400); // Bad Request
    echo json_encode(['mensagem' => 'Parâmetro "id" não fornecido na URL']);
}
