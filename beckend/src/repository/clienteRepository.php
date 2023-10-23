<?php

class ClienteRepository {
    private $db;

    public function __construct() {


        try {
         
            
            $this->db = new PDO("mysql:host=localhost;dbname=acme", "root", "");


           
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
           
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function consultarCliente($cpf) {
        
        $query = "SELECT * FROM cliente WHERE cpf = :cpf";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();

        
        if ($stmt->rowCount() > 0) {
           
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
            return $cliente;
        } else {
            return null; 
        }
    }
}

?>
