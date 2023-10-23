import { FormaView } from '../view/formaView.'
import { FormaService } from '../service/formaService';
import { FormaDePagamento } from '../model/formaDePagamento'; 
import { Parcela } from '../model/parcela';

export class FormaController {

    private formaView: FormaView;
    private formaService: FormaService;
    public formaDePagamento: FormaDePagamento; 
    public valor: number;
    public valorTotal: number;

    constructor() {
        this.formaView = new FormaView();
        this.formaService = new FormaService();
    }

    getValor(){
        return this.valor;
    }

    getValorTotal(){
        return this.valorTotal 
    }

    getFormaDePagamento(){
        return this.formaDePagamento;
    }

    atualizarValor(){
        this.valor = this.formaView.getValue();
    }



    async calcularParcelas() {
        const formaPagamentoNumero = this.formaView.getOption();
        const valorEmprestimo = this.formaView.getValue();
        if(!valorEmprestimo){
            this.formaView.exibirErro("Preencha o valor de emprestimo");
            return;
        }else if(valorEmprestimo < 500 || valorEmprestimo > 50000){
            this.formaView.exibirErro("O valor tem que ser entre 500 e 50000 reais");
            return;
;
        }
        this.formaView.exibirErro("");
        
        this.valor = valorEmprestimo

        this.formaDePagamento = await this.formaService.getFormaPagamento(formaPagamentoNumero); 

        if (this.formaDePagamento) {
            const parcelas: Parcela[] = this.calcularParcelasComJuros(this.formaDePagamento, valorEmprestimo);

            this.formaView.mostrarParcelas(parcelas);
        } else {
            this.formaView.exibirErro('Forma de pagamento não encontrada.');
        }
    }
    
    calcularParcelasComJuros(formaPagamento: FormaDePagamento, valorEmprestimo: number): Parcela[] {
        const parcelas: Parcela[] = [];
        const juros = formaPagamento.juros / 100;
        this.valorTotal = valorEmprestimo * (1 + juros);
        const valorParcelaBase = this.valorTotal / formaPagamento.numeroMeses;
        const diferencaTotal = this.valorTotal - (valorParcelaBase * formaPagamento.numeroMeses);
        let diferencaParcela = diferencaTotal / formaPagamento.numeroMeses;
    
        const calcularDataVencimento = (numeroParcela: number) => {
            const hoje = new Date();
            const vencimento = new Date(hoje);
            vencimento.setDate(hoje.getDate() + 30 * numeroParcela);
            return vencimento;
        };
    
        for (let i = 1; i <= formaPagamento.numeroMeses; i++) {
            const vencimento = calcularDataVencimento(i);
            let valorParcela = valorParcelaBase;
    
            if (diferencaParcela > 0) {
                valorParcela += diferencaParcela;
                diferencaParcela = 0;
            }
    
            valorParcela = Number(valorParcela.toFixed(2));
    
            const parcela = new Parcela(i, 1, i, vencimento, valorParcela);
            parcelas.push(parcela);
        }
    
        return parcelas;
    }
    
    
    
}
