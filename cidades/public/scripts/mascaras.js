/*

Autores:
  * Ana Carolina Ribeiro Miranda 
  * Cristian Andre Sanches
  * Gabriel Finger Conte
  * Leonardo Fagote

*/

// Máscara Dinheiro
document.addEventListener('DOMContentLoaded', function() {

  let custo = document.getElementById('custoProduto');
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
});
