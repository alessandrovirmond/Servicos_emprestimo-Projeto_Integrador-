import { Cliente } from '../model/cliente';
import { Emprestimo } from '../model/emprestimo';
import { FormaDePagamento } from '../model/formaDePagamento';
import { EmprestimoService } from '../service/emprestimoService';
import { EmprestimoView } from '../view/emprestimoView';


export class EmprestimoController{
    private emprestimoService: EmprestimoService; 
    private emprestimoView: EmprestimoView;
  
    constructor() {
      this.emprestimoService = new EmprestimoService();
      this.emprestimoView = new EmprestimoView()
    }
  
    async realizarEmprestimo(cliente: Cliente, formaPagamento: FormaDePagamento, valor: number, valorTotal: number): Promise<number> {
      try {
        if (!cliente) {
          this.emprestimoView.exibirErro("Identifique o cliente antes de realizar o empréstimo");
          return 0; 
        }
  
        if (valor > 50000 || valor < 500 || valor == null) {
          this.emprestimoView.exibirErro("Valor incorreto");
          return 0;
        }
    
        const emprestimo = new Emprestimo(cliente, formaPagamento, new Date(), valor, valorTotal);
    
        await this.emprestimoService.salvarEmprestimo(emprestimo);
        this.emprestimoView.exibirErro("Sucesso ao salvar empréstimo");
        return 1; // Retorna 1 em caso de sucesso
      } catch (error) {
        this.emprestimoView.exibirErro("Falha ao salvar empréstimo: " + error.message);
        return 0; 
      }
    }
    

      async listarEmprestimos() {
        try {
            const emprestimos: Emprestimo[] = await this.emprestimoService.getEmprestimos();
            
            this.emprestimoView.desenharTabela(emprestimos);
        } catch (error) {
            console.error('Erro ao listar empréstimos:', error);
        }
    }
  }

