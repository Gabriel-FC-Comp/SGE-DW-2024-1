/*

Autores:
  * Ana Carolina Ribeiro Miranda 
  * Cristian Andre Sanches
  * Gabriel Finger Conte
  * Leonardo Fagote

*/

// botão para adicionar produtos
let add_button = document.getElementById("btn_adicionar");

// Inputs
let id = document.getElementById("id_estoq");
let quantidade = document.getElementById("qtd_estoq");
let preco = document.getElementById("preco_estoq");
let desconto = document.getElementById("desconto_estoq");
let total = document.getElementById("total_estoq");
let aj_date = document.getElementById("dataAjuste");
let aj_type = document.getElementById("aj_type_inp");
let obs = document.getElementById("observacoes");

// Lista de registros
let scroll_div = document.getElementById("component_list");
let remove_reg_btn = document.getElementById("rmv_reg_btn");
let finalize_alt_btn = document.getElementById("btn_finalizar");

let contador = 0; // Inicializa um contador para IDs únicos
let selectedOptionId = ""; // ID do tipo selecionado


// function search_func() {


//   // Remove a máscara
//   let value_cpf_func = cpf_func_inp.value.replace(/[.,-]/g, '');

//   // Cria um objeto de dados a serem enviados
//   var data = {
//     cpf_func: value_cpf_func
//   };

//   // Configura as opções da requisição
//   var options = {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json'
//     },
//     body: JSON.stringify(data)
//   };

//   // Faz a requisição usando a API Fetch
//   fetch('./scripts/search_func_data.php', options)
//     .then(response => {
//       if (!response.ok) {
//         throw new Error('Erro na requisição');
//       }
//       return response.json();
//     })
//     .then(data => {
//       // Verifica se achou o produto
//       if (data.error == undefined) {

//         func_name_inp.value = data.func_name;
//         checkCadastroFuncionario.checked = data.cad_func_permiss;
//         checkCadastroProdutos.checked = data.cad_prod_permiss;
//         checkGerarRelatorios.checked = data.gera_rel_permiss;
//         checkPermissoesFunc.checked = data.permiss_change_permiss;
//         checkAjuste.checked = data.aj_estoq_permiss;
//         checkCompras.checked = data.aj_estoq_comp_permiss;
//         checkVendas.checked = data.aj_estoq_said_permiss;
//         checkCorrecao.checked = data.aj_estoq_aj_permiss;
//         checkConsultarProd.checked = data.consultar_prod;
//         checkTiposProdutos.checked = data.gen_tipo_prod;
//       } else {
//         console.log(data.error)
//         func_name_inp = "";
//         checkCadastroFuncionario.checked = false;
//         checkCadastroProdutos.checked = false;
//         checkGerarRelatorios.checked = false;
//         checkPermissoesFunc.checked = false;
//         checkAjuste.checked = false;
//         checkCompras.checked = false;
//         checkVendas.checked = false;
//         checkCorrecao.checked = false;
//         checkConsultarProd.checked = false;
//         checkTiposProdutos.checked = false;
//       }
//     })
//     .catch(error => console.error('Erro:', error));
// }


// Função para adicionar um registro à lista
function Adicionar() {
  // Obtém os valores dos campos
  let id_estoq = id.value;
  let qtd_estoq = quantidade.value;

  // Verifica se os campos obrigatórios estão preenchidos
  if (id_estoq.trim() != "" && new Decimal(qtd_estoq) != 0) {
    let preco_estoq = preco.value;
    let desconto_estoq = desconto.value;
    let total_estoq = total.value;

    contador++; // Incrementa o contador para IDs únicos
    let reg_estoq = document.createElement("div");
    reg_estoq.id = "reg_" + contador; // Define um ID único para o registro
    reg_estoq.classList.add("scroll_component", "rounded-5", "ps-3", "my-2");

    let p_estoq = document.createElement("span");
    p_estoq.classList.add("corTexto", "bg-transparent");
    // Define o conteúdo do registro
    p_estoq.innerHTML = `<span class="idCamp text-center">${id_estoq}</span> | <span class="nameCamp text-center">Produto</span> | <span class="qtdeCamp text-center">${qtd_estoq}</span> | <span class="valueCamp text-center">${preco_estoq}</span> | <span class="valueCamp text-center">${total_estoq}</span>`;

    // Verifica se está em modo escuro e aplica as classes correspondentes
    if (cor) {
      reg_estoq.classList.add("dark-mode");
      p_estoq.classList.add("dark-mode");
    }

    reg_estoq.appendChild(p_estoq);

    // Adiciona um evento de clique para selecionar o registro
    reg_estoq.addEventListener("click", function() {
      selectOption(reg_estoq.id);
    }, false);

    // Adiciona o registro à lista
    scroll_div.appendChild(reg_estoq);
  } else {
    // Mostra um alerta se os campos obrigatórios não estiverem preenchidos
    alert("Informe um ID e uma quantidade para adicionar um registro!");
    console.log("Informe um ID e uma quantidade para adicionar um registro!");
  }
}

// Função para atualizar o total com base nos valores dos campos
function atualizaTotal() {
  let qtde = new Decimal(quantidade.value);
  let prec = new Decimal(preco.value.replace(",", "."));
  let desc = new Decimal(desconto.value.replace(",", "."));

  total.value = (qtde * prec - desc).toFixed(2).replace(".", ",");
}

/* Função para selecionar um registro para exclusão */
function selectOption(id) {
  // Verifica se o ID começa com "reg_" para garantir que seja um registro válido
  if (id.startsWith("reg_")) {
    let newOption = document.getElementById(id);
    if (newOption != null) {
      // Remove a classe de seleção do registro anteriormente selecionado
      let lastOption = document.getElementById(selectedOptionId);
      if (lastOption != null) {
        lastOption.classList.remove("selected_scroll_component");
      }
      // Atualiza o ID do registro selecionado e adiciona a classe de seleção ao novo registro
      selectedOptionId = id;
      newOption.classList.add("selected_scroll_component");
    } else {
      // Mostra um alerta se o registro não for encontrado
      alert("Erro - Opção selecionada não encontrada!");
      console.log("Erro - Opção selecionada não encontrada!");
    }
  } else {
    // Mostra um alerta se o ID não começar com "reg_"
    alert("Erro ao selecionar opção, tente novamente!");
    console.log("Erro ao selecionar opção, tente novamente!");
  }
}

/* Função para remover um registro da lista */
function rmv_reg() {
  // Verifica se há um registro selecionado para remover
  if (selectedOptionId.startsWith("reg_")) {
    let tipo_a_remover = document.getElementById(selectedOptionId);
    // Verifica se o registro a ser removido existe
    if (tipo_a_remover != null) {
      // Remove o registro da lista
      scroll_div.removeChild(tipo_a_remover);
      console.log("Remove o tipo: " + tipo_a_remover.id);
      // Ativa a flag de alterações
      teve_alteracao = true;
      selectedOptionId = "";
    } else {
      // Mostra um alerta se o registro não for encontrado
      alert("Erro inesperado, registro não encontrado!");
      console.log("Erro inesperado, registro não encontrado!");
    }
  }
}

// Função para finalizar o ajuste
function finalize_ajuste() {
  // Verifica se todos os campos necessários estão preenchidos
  if (aj_date.value != "" && aj_type.value != "" && scroll_div.children.length > 0) {
    console.log("Data do Ajuste: " + aj_date.value);
    console.log("Tipo do Ajuste: " + aj_type.value);
    console.log("Observações: " + obs.value);
    console.log("Registro de alterações");
    console.log("");
  } else {
    // Mostra um alerta se algum campo obrigatório estiver vazio
    alert("Insira um registro para ajuste e todas as informações necessárias (*) !");
    console.log("Insira um registro para ajuste e todas as informações necessárias (*) !");
  }
}

// Adiciona eventos aos botões e campos relevantes
add_button.addEventListener("click", Adicionar, false);
finalize_alt_btn.addEventListener("click", finalize_ajuste, false);
quantidade.addEventListener('input', function(event) {
  // Chama a função para atualizar o total quando houver entrada no campo de quantidade
  if (event.target.value === '') {
    quantidade.value = "0";
    atualizaTotal("qtde", new Decimal(0));
  } else {
    atualizaTotal("qtde", new Decimal(event.target.value));
  }
}, false);

preco.addEventListener('input', function(event) {
  // Chama a função para atualizar o total quando houver entrada no campo de preço
  if (event.target.value === '') {
    preco.value = "0,00";
  }
  atualizaTotal();
}, false);

desconto.addEventListener('input', function(event) {
  // Chama a função para atualizar o total quando houver entrada no campo de desconto
  if (event.target.value === '') {
    desconto.value = "0,00";
  }
  atualizaTotal();
}, false);

remove_reg_btn.addEventListener('click', rmv_reg, false);

// Adiciona a função de seleção aos tipos já existentes na lista
scroll_div.querySelectorAll('.scroll_component').forEach(function(scroll_component) {
  scroll_component.addEventListener("click", function() {
    selectOption(scroll_component.id);
  }, false);
});
