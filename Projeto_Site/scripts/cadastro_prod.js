// Obtendo referências dos elementos do DOM através de seus IDs para manipulação
let prod_id = document.getElementById("prod_id_inp"); // Campo de entrada do ID do produto
let prod_name = document.getElementById("nomeProduto"); // Campo de entrada do nome do produto
let prod_type = document.getElementById("prod_type_inp"); // Campo de entrada do tipo do produto
let prod_cost = document.getElementById("custoProduto"); // Campo de entrada do custo do produto
let prod_model = document.getElementById("modeloProduto"); // Campo de entrada do modelo do produto
let prod_barcode = document.getElementById("codigoProduto"); // Campo de entrada do código de barras do produto
let save_prod_btn = document.getElementById("save_prod_button"); // Botão para salvar o produto
let clean_btn = document.getElementById("clean_button"); // Botão para limpar os campos de entrada
let del_prod_btn = document.getElementById("delet_prod_button"); // Botão para deletar um produto

// Função para salvar informações do produto
function save_prod() {
  // Verifica se todos os campos obrigatórios estão preenchidos
  if (prod_id.value != "" && prod_name.value != "" && prod_type.value != "" && prod_cost.value != "" && prod_model.value != "") {
    // Registra no console a adição de um novo produto
    console.log("Adicionando novo produto:");
    console.log("ID: " + prod_id.value);
    console.log("Nome: " + prod_name.value);
    console.log("Tipo: " + "type_" + prod_type.value);

    // Verifica se o modelo foi fornecido, caso contrário, imprime "Null"
    if (prod_model.value != "") {
      console.log("Modelo: " + prod_model.value);
    } else {
      console.log("Modelo: " + "Null");
    }

    // Verifica se o código de barras foi fornecido, caso contrário, imprime "Null"
    if (prod_barcode.value != "") {
      console.log("Código de Barras: " + prod_barcode.value);
    } else {
      console.log("Código de Barras: " + "Null");
    }
  } else {
    // Alerta o usuário para preencher todas as informações antes de adicionar um produto
    alert("Insira TODAS as informações para adicionar um produto!");
    console.log("Insira TODAS as informações para adicionar um produto!");
  }
}

// Função para limpar todos os campos de entrada
function clean_inputs() {
  prod_id.value = "";
  prod_name.value = "";
  prod_type.value = "";
  prod_cost.value = "";
  prod_model.value = "";
  prod_barcode.value = "";
}

// Função para deletar um produto baseado no ID fornecido
function del_prod() {
  if (prod_id.value != "") {
    // Registra a exclusão do produto no console
    console.log("Produto Excluído");
    // Limpa somente o campo de ID do produto
    prod_id.value = "";
  } else {
    // Alerta o usuário para fornecer um ID antes de tentar remover um produto
    alert("Insira um ID para poder removê-lo!");
    console.log("Insira um ID para poder removê-lo!");
  }
}

// Adicionando event listeners para os botões que disparam as funções correspondentes ao clicar
save_prod_btn.addEventListener("click", save_prod, false);
clean_btn.addEventListener("click", clean_inputs, false);
del_prod_btn.addEventListener("click", del_prod, false);
