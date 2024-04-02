/*

Autores:
  * Ana Carolina Ribeiro Miranda 
  * Cristian Andre Sanches
  * Gabriel Finger Conte
  * Leonardo Fagote

*/

$(document).ready(function() {
    var lista = $('#listaReunioes li').get(); // Seleciona todos os itens de listaReunioes e os coloca em um array
    lista.sort(function(a, b) { // Ordena o array com base na função de comparação fornecida
        var dataA = getDateFromBRString($(a).text()); // Obtém a data do texto do elemento 'a' como um objeto Date
        var dataB = getDateFromBRString($(b).text()); // Obtém a data do texto do elemento 'b' como um objeto Date

        return dataB - dataA; // Retorna a diferença em milissegundos entre as datas (ordem decrescente)
    });
    $('#listaReunioes').empty().append(lista); // Limpa a lista e insere os itens ordenados de volta
});

// Função para converter uma string no formato DD/MM/AAAA em um objeto Date
function getDateFromBRString(dateString) {
    var parts = dateString.split('/');
    return new Date(parts[2], parts[1] - 1, parts[0]); // Ano, Mês (0-11), Dia
}
