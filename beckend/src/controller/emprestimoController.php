<?php
require_once 'D:/Alessandro/Faculdade/PROJETO_INTEGRADOR/acme/beckend/src/repository/emprestimoRepository.php'; 
require_once 'D:/Alessandro/Faculdade/PROJETO_INTEGRADOR/acme/beckend/src/model/emprestimo.php'; 
 
class EmprestimoController {
    private $emprestimoRepository;

    public function __construct() {
        $this->emprestimoRepository = new EmprestimoRepository();
    }

    public function postEmprestimo($emprestimo) {
         


        return  $this->emprestimoRepository->salvarEmprestimo($emprestimo);

    }
    
    
    public function getEmprestimos() {
         


      echo $this->emprestimoRepository->consultarEmprestimos();

}


}
?>