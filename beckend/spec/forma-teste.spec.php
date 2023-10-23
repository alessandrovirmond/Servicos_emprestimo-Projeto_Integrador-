<?php
require_once 'D:/Alessandro/Faculdade/PROJETO_INTEGRADOR/acme/beckend/src/controller/formadepagamentoController.php'; 

describe("FormaDePagamentoController", function () {
    it("deve retornar a forma de pagamento encontrada", function () {
        $formaDePagamentoController = new FormaDePagamentoController();
        $numero = '2';
        $result = $formaDePagamentoController->getFormaDePagamento($numero);
        $expected = "{\"idFormaPagamento\":\"2\",\"descricao\":\"2 meses\",\"numeroMeses\":\"2\",\"juros\":\"50.00\"}";

        expect($result)->toEqual($expected);
    });

    it("deve retornar mensagem de forma de pagamento não encontrada", function () {
        $formaDePagamentoController = new FormaDePagamentoController();
        $numero = '987';

        $result = $formaDePagamentoController->getFormaDePagamento($numero);

        expect($result)->toBe('{"mensagem":"Forma de pagamento nao encontrada"}');
    });
});
?>
