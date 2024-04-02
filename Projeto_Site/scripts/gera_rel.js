/* Pegando os elementos uma vez para adicionar as funcionalidades */
let rel_type_select = document.getElementById("rel_type_select"); // Select para escolher o tipo de relatório
let data_inicial_rel_inp = document.getElementById("data_inicial_rel_inp"); // Input para data inicial
let data_final_rel_inp = document.getElementById("data_final_rel_inp"); // Input para data final
let rel_type_input = document.getElementById(""); // Elemento não especificado no código, está vazio
let redefine_rel_inputs_btn = document.getElementById("redefine_rel_inputs_btn"); // Botão para redefinir campos
let gen_rel_btn = document.getElementById("gen_rel_btn"); // Botão para gerar relatório
let exp_rel_btn = document.getElementById("exp_rel_btn"); // Botão para exportar relatório
let scroll_div = document.getElementById("component_list"); // Div que contém a lista de tipos
let selectedOptionId = ""; // ID do tipo selecionado

let relatorio_disponivel = false; // Flag para indicar se um relatório está disponível ou não

/* Definindo as funções de ação */

/* Função para redefinir os campos do relatório */
function redefine_rel_inputs() {
  console.log("Resetando campos do relatório");
  // Redefine os valores dos campos para seus valores padrão
  rel_type_select.value = "None";
  data_inicial_rel_inp.value = "";
  data_final_rel_inp.value = "";
};

/* Função para gerar o relatório com base nos dados fornecidos */
function gen_rel() {
  // Verifica se todos os campos necessários foram preenchidos
  if (rel_type_select.value != "None" && data_inicial_rel_inp.value != "" && data_final_rel_inp.value != "") {
    console.log("Tipo do relatório: " + rel_type_select.value);
    console.log("Data Inicial: " + data_inicial_rel_inp.value);
    console.log("Data Final: " + data_final_rel_inp.value);
    relatorio_disponivel = true; // Marca o relatório como disponível
  } else {
    // Se algum campo estiver vazio, exibe um alerta
    alert("Por favor, preencha todos os campos!");
    console.log("Por favor, preencha todos os campos!");
  }
}

/* Função para exportar o relatório gerado */
function exp_rel() {
  // Verifica se o relatório está disponível para exportação
  if (relatorio_disponivel) {
    console.log("Exportando relatório");
  } else {
    // Se o relatório não estiver disponível, exibe um alerta
    alert("Gere um relatório primeiro!");
    console.log("Gere um relatório primeiro!");
  }
}

/* Função para selecionar uma opção na lista */
function selectOption(id) {
  // Verifica se o ID começa com "reg_" para garantir que seja uma opção válida
  if (id.startsWith("reg_")) {
    let newOption = document.getElementById(id);
    if (newOption != null) {
      // Remove a classe de seleção da opção anteriormente selecionada
      let lastOption = document.getElementById(selectedOptionId);
      if (lastOption != null) {
        lastOption.classList.remove("selected_scroll_component");
      }
      // Atualiza o ID da opção selecionada e adiciona a classe de seleção à nova opção
      selectedOptionId = id;
      newOption.classList.add("selected_scroll_component");
    } else {
      // Se a opção não existir, exibe um alerta
      alert("Erro - Opção selecionada não encontrada!");
      console.log("Erro - Opção selecionada não encontrada!");
    }
  } else {
    // Se o ID não começar com "reg_", exibe um alerta
    alert("Erro ao selecionar opção, tente novamente!");
    console.log("Erro ao selecionar opção, tente novamente!");
  }
}

/* Atribuindo as funções aos elementos HTML */

// Adiciona a função de redefinição de campos ao botão correspondente
redefine_rel_inputs_btn.addEventListener(
  "click", redefine_rel_inputs, false
);

// Adiciona a função de geração de relatório ao botão correspondente
gen_rel_btn.addEventListener(
  "click", gen_rel, false
);

// Adiciona a função de exportação de relatório ao botão correspondente
exp_rel_btn.addEventListener(
  "click", exp_rel, false
);

// Adiciona a função de seleção às opções existentes na lista
scroll_div.querySelectorAll('.scroll_component').forEach(function(scroll_component) {
  scroll_component.addEventListener(
    "click", function() {
      selectOption(scroll_component.id);
    }, false
  );
});
