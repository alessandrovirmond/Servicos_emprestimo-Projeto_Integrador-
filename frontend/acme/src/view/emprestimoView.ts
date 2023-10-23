import { Emprestimo } from '../model/emprestimo';

export class EmprestimoView {
    private mensagemErroElement: HTMLElement;
    constructor(){
        this.mensagemErroElement = document.getElementById('mensagemErro');

    }

    exibirErro(mensagem: string) {
        this.mensagemErroElement.textContent = mensagem;
    }

    desenharTabela(emprestimos: Emprestimo[]): void {
        const tabelaEmprestimos = document.getElementById('tabelaEmprestimos');

        if (!tabelaEmprestimos) {
            console.error('Elemento da tabela não encontrado.');
            return;
        }

       

        tabelaEmprestimos.innerHTML = '';

        emprestimos.forEach(emprestimo => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${emprestimo.dataHora}</td>
                <td>${emprestimo.cliente.nome}</td>
                <td>${emprestimo.cliente.cpf}</td>
                <td>${emprestimo.valorEmprestimo}</td>
                <td>${emprestimo.formaPagamento.descricao}</td>
                <td>${emprestimo.valorFinal}</td>
            `;
            tabelaEmprestimos.appendChild(row);
        });
    }
}
