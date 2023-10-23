<?php
require_once 'D:/Alessandro/Faculdade/PROJETO_INTEGRADOR/acme/beckend/src/controller/emprestimoController.php'; 
require_once './src/model/emprestimo.php'; // Certifique-se de ajustar o nome do arquivo e o caminho, se necessário

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Adicione 'GET' e 'POST' como métodos permitidos
header("Access-Control-Allow-Headers: Content-Type");

// Verifica o método da solicitação (OPTIONS é usado para verificação de pré-voo em CORS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Adicione 'GET' e 'POST' como métodos permitidos
    header("Access-Control-Allow-Headers: Content-Type");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');  // Cache pré-voo por 24 horas
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $emprestimoController = new EmprestimoController();
    header('Content-Type: application/json');
    return $emprestimoController->getEmprestimos();

/*     if ($emprestimos) {
        // Se os empréstimos forem encontrados, envie-os como resposta em formato JSON
        header('Content-Type: application/json');
        echo $emprestimos;
    } else {
        http_response_code(404); // Not Found
        echo json_encode(['mensagem' => 'Empréstimos não encontrados']);
    } */
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe o JSON enviado
    $json = file_get_contents('php://input');

    // Converte o JSON em um array associativo
    $data = json_decode($json, true);

    $clienteId = $data['cliente']['id'];
    $formaPagamentoId = $data['formaPagamento']['idFormaPagamento'];

    $emprestimo = new Emprestimo(
        $clienteId,
        $formaPagamentoId,
        $data['dataHora'],
        $data['valorEmprestimo'],
        $data['valorFinal']
    );

    // Neste ponto, você tem o objeto $emprestimo pronto para ser usado

    // Agora você pode chamar a função postEmprestimo do EmprestimoController (certifique-se de incluir o código do controller)
    $emprestimoController = new EmprestimoController();
    $emprestimoController->postEmprestimo($emprestimo);
}
?>
