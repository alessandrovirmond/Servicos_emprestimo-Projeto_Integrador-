import { ClienteController } from './src/controller/clienteController';
import { EmprestimoController } from './src/controller/emprestimoController';
import { FormaController } from './src/controller/formaController';
import { Emprestimo } from './src/model/emprestimo';

// Declara as constantes dos controladores fora das funções de evento
const cliente = new ClienteController();
const forma = new FormaController();


const consultarCPFButton = document.getElementById('consultarCPFButton');
const selectPagamento = document.getElementById('formaPagamento');
const realizarEmprestimo = document.getElementById('realizarEmprestimo');

const inputValorEmprestimo = document.getElementById('valorEmprestimo');

inputValorEmprestimo.addEventListener('input', function (event) {
  forma.atualizarValor();
  forma.calcularParcelas();
});

consultarCPFButton.addEventListener('click', (event) => {
  event.preventDefault();
  cliente.logar();
});

selectPagamento.addEventListener('change', () => {
  forma.calcularParcelas();
});


realizarEmprestimo.addEventListener('click', async (event) => {
  event.preventDefault();
  const clienteObj = cliente.getCliente();
  const formaPagamento = forma.getFormaDePagamento();
  const valor = forma.getValor();
  const valorTotal = forma.getValorTotal();
  const emprestimo = new EmprestimoController();

  try {
    const exito = await emprestimo.realizarEmprestimo(clienteObj, formaPagamento, valor, valorTotal);

    if (exito === 1) {
      setTimeout(() => {
        window.location.href = 'emprestimo.html';
      }, 3000); 
    }
  } catch (error) {
    console.error('Erro ao realizar empréstimo:', error);
  }
});


