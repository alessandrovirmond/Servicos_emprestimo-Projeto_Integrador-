<?php
class Cliente {
    public $id; // Adicione o atributo id
    public $nome;
    public $cpf;
    public $dataNascimento;

    public function __construct($id, $nome, $cpf, $dataNascimento) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->dataNascimento = $dataNascimento;
    }
}

?>