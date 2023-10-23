<?php
class Parcela {
    public $id;
    public $emprestimoId; // ID do empréstimo ao qual esta parcela pertence
    public $numero; // Número da parcela (1, 2, 3, ...)
    public $vencimento; // Data de vencimento da parcela
    public $valor; // Valor da parcela em reais (R$)

    public function __construct($id, $emprestimoId, $numero, $vencimento, $valor) {
        $this->id = $id;
        $this->emprestimoId = $emprestimoId;
        $this->numero = $numero;
        $this->vencimento = $vencimento;
        $this->valor = $valor;
    }
}

?>