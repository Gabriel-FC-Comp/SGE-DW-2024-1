/*

Autores:
  * Ana Carolina Ribeiro Miranda 
  * Cristian Andre Sanches
  * Gabriel Finger Conte
  * Leonardo Fagote

*/

// Obtendo referências dos elementos do DOM através de seus IDs para manipulação
let prod_id_inp = document.getElementById("prod_id_inp"); // Campo de entrada do ID do produto
let prod_name_inp = document.getElementById("prod_name_inp"); // Campo de entrada do nome do produto
let prod_type_inp = document.getElementById("prod_type_inp"); // Campo de entrada do tipo do produto
let prod_cost_inp = document.getElementById("prod_cost_inp"); // Campo de entrada do custo do produto
let prod_model_inp = document.getElementById("prod_model_inp"); // Campo de entrada do modelo do produto
let prod_barcode_inp = document.getElementById("prod_barcode_inp"); // Campo de entrada do código de barras do produto


let cad_prod_form = document.getElementById("cad_prod_form"); // Botão para salvar o produto
// let del_prod_btn = document.getElementById("delet_prod_button"); // Botão para deletar um produto

// Função para salvar informações do produto
// function save_prod(event) {
// //   // event.preventDefault(); // Impedir o envio padrão do formulário

//   // Pega os dados do formulário
//   let prod_form_data = new FormData(this);
//   let prod_id = prod_form_data.get("prod_id");
//   let prod_name = prod_form_data.get("prod_name");
//   let prod_type = prod_form_data.get("prod_type");
//   let prod_model = prod_form_data.get("prod_model");
//   let prod_barcode = prod_form_data.get("prod_barcode");

//   // Registra no console a adição de um novo produto
//   console.log("Adicionando novo produto:");
//   console.log("ID: " + prod_id);
//   console.log("Nome: " + prod_name);
//   console.log("Tipo: " + "type_" + prod_type);
//   console.log("Modelo: " + prod_model);
//   console.log("Código de Barras: " + prod_barcode);

// }

//Função para deletar um produto baseado no ID fornecido
// function del_prod() {
//   if (prod_id_inp.value != "") {
//     // Registra a exclusão do produto no console
//     console.log("Produto Excluído");
//     // Limpa somente o campo de ID do produto
//     prod_id_inp.value = "";
//   } else {
//     // Alerta o usuário para fornecer um ID antes de tentar remover um produto
//     alert("Insira um ID para poder removê-lo!");
//     console.log("Insira um ID para poder removê-lo!");
//   }
// }

function search_prod() {

  // Cria um objeto de dados a serem enviados
  var data = {
    prod_id: prod_id_inp.value,
  };

  // Configura as opções da requisição
  var options = {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  };

  // Faz a requisição usando a API Fetch
  fetch('./scripts/search_prod_data.php', options)
    .then(response => {
      if (!response.ok) {
        throw new Error('Erro na requisição');
      }
      return response.json();
    })
    .then(data => {
      // Verifica se achou o produto
      if (data.error == undefined) {

        prod_name_inp.value = data.prod_name;
        prod_cost_inp.value = data.prod_cost;
        prod_model_inp.value = data.prod_model;
        prod_barcode_inp.value = data.prod_barcode;
        // prod_qtde = data.prod_qtde;
        console.log(data);
        Array.from(prod_type_inp.options).forEach((option, i) => {
          if (option.value === data.prod_type) {
            prod_type_inp.selectedIndex = i;
          }
        });

      } else {
        console.log(data.error);
        prod_name_inp.value = "";
        prod_type_inp.selectedIndex = 0;
        prod_cost_inp.value = "";
        prod_model_inp.value = "";
        prod_barcode_inp.value = "";
        // prod_qtde = data.prod_qtde;
      }
    })
    .catch(error => console.error('Erro:', error));
}

// Adicionando event listeners para os botões que disparam as funções correspondentes ao clicar
// cad_prod_form.addEventListener("submit", save_prod, false);
// del_prod_btn.addEventListener("click", del_prod, false);
prod_id_inp.addEventListener("blur", search_prod, false);