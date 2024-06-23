/*

Autores:
  * Ana Carolina Ribeiro Miranda 
  * Cristian Andre Sanches
  * Gabriel Finger Conte
  * Leonardo Fagote

*/

document.addEventListener('DOMContentLoaded', function() {

  // Máscara Dinheiro
  let custo = document.getElementById('prod_cost_inp');
  if (custo) {
    custo.addEventListener('input', function() {
      // Remove caracteres não numéricos do valor do campo
      this.value = this.value.replace(/\D/g, '');
      // Inicializa a variável que conterá o valor formatado
      var valorFormatado = '';
      // Obtém o valor do campo e remove espaços em branco
      var valor = this.value.trim();
      // Obtém o comprimento do valor atual do campo
      var comprimentoValor = valor.length;
      // Verifica se o valor possui mais de 2 caracteres
      if (comprimentoValor > 2) {
        // Adiciona uma vírgula após os dois primeiros dígitos
        valorFormatado = valor.substring(0, comprimentoValor - 2) + ',' + valor.substring(comprimentoValor - 2);
      } else {
        // Caso contrário, o valor formatado é o mesmo que o valor atual
        valorFormatado = valor;
      }
      // Atualiza o valor do campo com o valor formatado
      this.value = valorFormatado;
    });
  }

  // Máscara CPF
  let inputCPF = document.getElementById('cpf_func_inp');
  if (inputCPF) {
    // Formatar o CPF
    function formatarCPF(cpf) {
      cpf = cpf.replace(/\D/g, ''); // Remove caracteres não numéricos
      cpf = cpf.slice(0, 11); // Limita a string para ter no máximo 11 caracteres
      cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Coloca um ponto após os primeiros três dígitos
      cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Coloca um ponto após os segundos três dígitos
      cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Coloca um hífen antes do último dígito
      return cpf;
    }

    // Aplicar a máscara
    function mascaraCPF() {
      var input = document.getElementById('cpf_func_inp');
      var valor = input.value.replace(/\D/g, '');
      var novoValor = formatarCPF(valor);
      input.value = novoValor;
    }

    // Adiciona um listener de evento para aplicar a máscara enquanto o usuário digita
    inputCPF.addEventListener('input', mascaraCPF);
  }

});
