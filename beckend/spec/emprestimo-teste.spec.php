<?php
require_once 'D:/Alessandro/Faculdade/PROJETO_INTEGRADOR/acme/beckend/src/controller/emprestimoController.php'; 

describe("EmprestimoController", function () {
    it("deve salvar um empréstimo com sucesso", function () {
        $emprestimoController = new EmprestimoController();

        $emprestimo = new Emprestimo(1, 3, '2023-10-30 15:30:00', 500.000, 870.000);

        $result = $emprestimoController->postEmprestimo($emprestimo);

        expect($result)->toBe(true); 
    });

    it("deve consultar empréstimos", function () {
        $emprestimoController = new EmprestimoController();

        $result = $emprestimoController->getEmprestimos();

        expect($result)->not->toBe(" "); 
    });
});
?>
