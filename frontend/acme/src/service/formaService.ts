import { FormaDePagamento } from '../model/formaDePagamento';

export class FormaService {
    async getFormaPagamento(formaPagamentoNumero: number): Promise<FormaDePagamento | null> {
        try {


            // Faça a solicitação GET
            const response = await fetch(`http://localhost:8080/formadepagamento.php?id=${formaPagamentoNumero}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (response.ok) {
                // Analise a resposta como JSON
                const formaPagamento = await response.json();
                return formaPagamento as FormaDePagamento;
            } else {
                // Lidar com erros, como formaPagamento não encontrado
                // Você pode lançar uma exceção ou retornar null, dependendo do que desejar
                return null;
            }
        } catch (error) {
            // Lidar com erros de rede ou outros erros
            console.error('Erro ao obter forma de pagamento:', error);
            return null;
        }
    }
}
