<?php
require_once 'D:/Alessandro/Faculdade/PROJETO_INTEGRADOR/acme/beckend/src/controller/clienteController.php'; 


describe("ClienteController", function () {
    
    beforeAll(function () {
        
    });
    it("deve retornar o cliente encontrado", function () {
        $clienteController = new ClienteController();
        $cpf = '12345678900';
    
        $result = $clienteController->getCliente($cpf);
        $expected = '{
            "id": "1",
            "nome": "Andre da Silva",
            "cpf": "12345678900",
            "dataNascimento": "1990-01-15"
        }';
        expect(json_decode($result))->toEqual(json_decode($expected));
    });
    

    it("deve retornar mensagem de cliente não encontrado", function () {
        $clienteController = new ClienteController();
        $cpf = '98765432100'; 

        $result = $clienteController->getCliente($cpf);

        expect($result)->toBe("{\"mensagem\":\"Cliente nao encontrado\"}");
    });
});
?>