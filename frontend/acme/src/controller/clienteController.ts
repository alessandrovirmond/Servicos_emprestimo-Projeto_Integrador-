import { ClienteView } from '../view/clienteView'
import { Cliente } from '../model/cliente';
import { ClienteService } from '../service/clienteService'; // Importe a classe de serviço

export class ClienteController {
  public ClienteView: ClienteView;
  public clienteService: ClienteService; 
  public cliente: Cliente;

  constructor() {
    this.ClienteView = new ClienteView();
    this.clienteService = new ClienteService;
  }

  getCliente(){

    return this.cliente;
  }

  async logar() {
    const cpf = this.ClienteView.getCPFInput().value;

    try {
       const cliente = await this.clienteService.consultarCPF(cpf); 

      if (cliente) {
        this.cliente = cliente;
        this.ClienteView.exibirClienteEncontrado(cliente);
        this.ClienteView.exibirErro("");
      } else {
        this.cliente = null;
        this.ClienteView.exibirErro("Cliente não encontrado");    
      }
    } catch (error) {
 
      this.ClienteView.exibirErro("Cliente não encontrado");  
      throw error; 
    }
  }
}
