<?php
require_once 'D:/Alessandro/Faculdade/PROJETO_INTEGRADOR/acme/beckend/src/repository/clienteRepository.php';
require_once 'D:/Alessandro/Faculdade/PROJETO_INTEGRADOR/acme/beckend/src/model/cliente.php'; // Substitua pelo caminho real da sua classe Cliente

// ClienteController.php
class ClienteController {
    private $clienteRepository;

    public function __construct() {
        $this->clienteRepository = new ClienteRepository();
    }

    public function getCliente($cpf) {
        $clienteData = $this->clienteRepository->consultarCliente($cpf);

        if ($clienteData) {
            $cliente = new Cliente($clienteData['id'],$clienteData['nome'], $clienteData['cpf'], $clienteData['data_nascimento']); 

            $jsonString = "{
                \"id\": \"" . $cliente->id . "\",
                \"nome\": \"" . $cliente->nome . "\",
                \"cpf\": \"" . $cliente->cpf . "\",
                \"dataNascimento\": \"" . $cliente->dataNascimento . "\"
            }";

            

            return $jsonString;
            
        } else {
            http_response_code(404); // Not Found
            return json_encode(['mensagem' => 'Cliente nao encontrado']);
        }
    }
}



?>
