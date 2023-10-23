import { ClienteController } from '../src/controller/clienteController';
import { test, expect } from 'vitest';


test('logar com cliente encontrado', () => {
  const clienteController = new ClienteController();

  const inputElement = document.createElement('input');
  inputElement.value = '12345678900';

  clienteController.ClienteView.getCPFInput = () => inputElement;

  clienteController.clienteService.consultarCPF = async () => ({
    id: 1,
    nome: 'João',
    cpf: '12345678900',
    dataNascimento: new Date('1990-01-15'),
  });

  clienteController.logar();

  expect(clienteController.cliente).not.toBeNull();
  expect(clienteController.ClienteView.exibirClienteEncontrado).toHaveBeenCalledWith({
    id: 1,
    nome: 'João',
    cpf: '12345678900',
    dataNascimento: new Date('1990-01-15'),
  });

});


test('logar com cliente não encontrado', () => {
  const clienteController = new ClienteController();
    const inputElement = document.createElement('input');
  inputElement.value = '12345678900';

  clienteController.ClienteView.getCPFInput = () => inputElement;

  clienteController.clienteService.consultarCPF = async () => null;

  clienteController.logar();

  expect(clienteController.cliente).toBeNull();
  expect(clienteController.ClienteView.exibirErro).toHaveBeenCalledWith('Cliente não encontrado');

});

