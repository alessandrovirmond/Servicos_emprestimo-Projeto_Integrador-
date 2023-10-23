import { Emprestimo } from "../model/emprestimo";

export class EmprestimoService {
    async salvarEmprestimo(emprestimo : Emprestimo) {
      try {
        console.log(emprestimo);
        const emprestimoJSON = JSON.stringify(emprestimo);
        console.log(emprestimoJSON);
        const response = await fetch('http://localhost:8080/emprestimos.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: emprestimoJSON,
        });
  
    
      } catch (error) {
        console.error('Erro ao salvar o empréstimo:', error);
      }
    }

    async getEmprestimos(): Promise<Emprestimo[]> {
      try {
          const response = await fetch('http://localhost:8080/emprestimos.php', {
              method: 'GET',
              headers: {
                  'Content-Type': 'application/json',
              },
          });

          if (response.ok) {
              const emprestimos: Emprestimo[] = await response.json();
              return emprestimos;
          } else {
              console.error('Erro ao buscar empréstimos:', response.statusText);
              return [];
          }
      } catch (error) {
          console.error('Erro ao buscar empréstimos:', error);
          return [];
      }
  }
  }
  