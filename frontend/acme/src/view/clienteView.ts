import { Cliente } from '../model/cliente';

export class ClienteView {
  private consultarCPFButton: HTMLElement;
  private cpfInput: HTMLInputElement;
  private  mensagemErroElement: HTMLElement;
  private clienteEncontradoElement: HTMLElement;
  private clienteNomeElement: HTMLElement;
  private clienteCPFElement: HTMLElement;
  private clienteDataNascimentoElement: HTMLElement;

  constructor() {

    this.mensagemErroElement = document.getElementById('mensagemErro') as HTMLElement;
    this.clienteEncontradoElement = document.getElementById('clienteEncontrado') as HTMLElement;
    this.clienteNomeElement = document.getElementById('clienteNome') as HTMLElement;



  }


 getCPFInput(): HTMLInputElement | null {
    return document.getElementById('cpfInput') as HTMLInputElement;
  }

  exibirClienteEncontrado(cliente: Cliente) {

    console.log(cliente.dataNascimento)
    const idade = this.calcularIdade(cliente.dataNascimento);

    const nomeCompleto = `${cliente.nome}, ${idade} anos`;

    this.clienteNomeElement.textContent = nomeCompleto;

}


  calcularIdade(data: Date): number {
    const dataAtual = new Date();
    const dataNascimento = new Date(data);

    const diff = dataAtual.getTime() - dataNascimento.getTime();
    const idade = new Date(diff);

    return Math.abs(idade.getUTCFullYear() - 1970);
  }



   exibirErro(mensagem: string) {
    this.mensagemErroElement.textContent = mensagem;

  }


}
