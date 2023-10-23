import { Cliente } from '../model/cliente';

export class ClienteService {
  async consultarCPF(cpf: string): Promise<Cliente | null> {


    try {
      const response = await fetch(`http://localhost:8080/clientes.php?cpf=${cpf}`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
      });


      if (response.ok) {
        const cliente = await response.json() as Cliente;
        return cliente; 
      } else {
        return null;
      }
    } catch (error) {
      console.error('Erro ao consultar CPF no serviço:', error);
      throw error; 
    }
  }
}
