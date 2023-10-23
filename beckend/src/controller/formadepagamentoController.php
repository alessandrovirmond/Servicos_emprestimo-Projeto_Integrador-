<?php
require_once 'D:/Alessandro/Faculdade/PROJETO_INTEGRADOR/acme/beckend/src/repository/formadepagamentoRepository.php'; 
require_once 'D:/Alessandro/Faculdade/PROJETO_INTEGRADOR/acme/beckend/src/model/formadepagamento.php'; 


class FormaDePagamentoController {
    private $formaDePagamentoRepository;

    public function __construct() {
        $this->formaDePagamentoRepository = new FormaDePagamentoRepository();
    }

    public function getFormaDePagamento($numero) {
        $formaDePagamentoData = $this->formaDePagamentoRepository->consultarFormaDePagamento($numero);

        if ($formaDePagamentoData) {
            $formaDePagamento = new FormaDePagamento(
                $formaDePagamentoData['id'],
                $formaDePagamentoData['descricao'],
                $formaDePagamentoData['numero_meses'],
                $formaDePagamentoData['juros']
            );


            return json_encode($formaDePagamento); 
        } else {
            http_response_code(404); 
            return json_encode(['mensagem' => 'Forma de pagamento nao encontrada']);
        }
    }
}
?>
