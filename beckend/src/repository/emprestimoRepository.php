<?php

require_once 'D:/Alessandro/Faculdade/PROJETO_INTEGRADOR/acme/beckend/src/model/emprestimo.php'; 

class EmprestimoRepository {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=acme", "root", "");

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function salvarEmprestimo(Emprestimo $emprestimo) {
        try {
            $idCliente = $emprestimo->idCliente;
            $idFormaPagamento = $emprestimo->idFormaPagamento;
            $dataHora = $emprestimo->dataHora;
            $valorEmprestimo = $emprestimo->valorEmprestimo;
            $valorTotal = $emprestimo->valorTotal;

        echo "ID Cliente: $idCliente<br>";
        echo "ID Forma de Pagamento: $idFormaPagamento<br>";
        echo "Data e Hora: $dataHora<br>";
        echo "Valor do Empréstimo: $valorEmprestimo<br>";
        echo "Valor Total: $valorTotal<br>";

       
            $query = "INSERT INTO emprestimos (idCliente, idFormaPagamento, dataHora, valorEmprestimo, valorTotal) VALUES (:idCliente, :idFormaPagamento, NOW(), :valorEmprestimo, :valorTotal)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':idCliente', $idCliente);
            $stmt->bindParam(':idFormaPagamento', $idFormaPagamento);
            $stmt->bindParam(':valorEmprestimo', $valorEmprestimo);
            $stmt->bindParam(':valorTotal', $valorTotal);

            if ($stmt->execute()) {
                return true; 
            } else {
                return false;
            }
        } catch (PDOException $e) {
            
            return false;
        }
    }

    public function consultarEmprestimos() {
        try {
            $query = "SELECT e.*, c.*, f.* 
            FROM emprestimos e
            JOIN cliente c ON e.idCliente = c.id
            JOIN formasPagamento f ON e.idFormaPagamento = f.id
            ORDER BY e.id DESC";
  
            $stmt = $this->db->query($query);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $emprestimos = [];
            foreach ($result as $row) {
                $cliente = [
                    'id' => $row['idCliente'],
                    'nome' => $row['nome'],
                    'cpf' => $row['cpf'],
                    'dataNascimento' => $row['data_nascimento'],
                ];
    
                $formaPagamento = [
                    'idFormaPagamento' => $row['idFormaPagamento'],
                    'descricao' => $row['descricao'],
                    'numeroMeses' => $row['numero_meses'],
                    'juros' => $row['juros'],
                ];
    
                $emprestimo = [
                    'cliente' => $cliente,
                    'formaPagamento' => $formaPagamento,
                    'dataHora' => $row['dataHora'],
                    'valorEmprestimo' => $row['valorEmprestimo'],
                    'valorFinal' => $row['valorTotal'],
                ];
    
                $emprestimos[] = $emprestimo;
            }
    
            $jsonString = '[';  

            foreach ($emprestimos as $emprestimo) {
                $emprestimoJSON = '{
                    "cliente": {
                        "id": "' . $emprestimo['cliente']['id'] . '",
                        "nome": "' . $emprestimo['cliente']['nome'] . '",
                        "cpf": "' . $emprestimo['cliente']['cpf'] . '",
                        "dataNascimento": "' . $emprestimo['cliente']['dataNascimento'] . '"
                    },
                    "formaPagamento": {
                        "idFormaPagamento": "' . $emprestimo['formaPagamento']['idFormaPagamento'] . '",
                        "descricao": "' . $emprestimo['formaPagamento']['descricao'] . '",
                        "numeroMeses": "' . $emprestimo['formaPagamento']['numeroMeses'] . '",
                        "juros": "' . $emprestimo['formaPagamento']['juros'] . '"
                    },
                    "dataHora": "' . $emprestimo['dataHora'] . '",
                    "valorEmprestimo": ' . $emprestimo['valorEmprestimo'] . ',
                    "valorFinal": ' . $emprestimo['valorFinal'] . '
                }';
            
                $jsonString .= $emprestimoJSON . ',';  
            }
            
            $jsonString = rtrim($jsonString, ','); 
            $jsonString .= ']';  
            
            return $jsonString;
            
        } catch (PDOException $e) {
            return json_encode(['erro' => 'Erro ao consultar empréstimos']);
        }
    }
    
}


?>
