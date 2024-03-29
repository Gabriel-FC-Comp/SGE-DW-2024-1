/* Pegando os elementos uma vez para adicionar as funcionalidades */
let rel_type_select = document.getElementById("rel_type_select");
let data_inicial_rel_inp = document.getElementById("data_inicial_rel_inp");
let data_final_rel_inp = document.getElementById("data_final_rel_inp");
let rel_type_input = document.getElementById("");
let redefine_rel_inputs_btn = document.getElementById("redefine_rel_inputs_btn");
let gen_rel_btn = document.getElementById("gen_rel_btn");
let exp_rel_btn = document.getElementById("exp_rel_btn");
let scroll_div = document.getElementById("component_list"); // Div que contém a lista de tipos
let selectedOptionId = ""; // ID do tipo selecionado

let relatorio_disponivel = false;

/* Definindo as funções de ação */

/* Função para redefinir os campos*/
function redefine_rel_inputs() {
  console.log("Rset")
  rel_type_select.value = "None";
  data_inicial_rel_inp.value = "";
  data_final_rel_inp.value = "";
};

/* Função para Gerar o relatório conforme as especificações do usuário */
function gen_rel() {

  if (rel_type_select.value != "None" && data_inicial_rel_inp.value != "" && data_final_rel_inp.value != "") {
    console.log("Tipo do relatório: " + rel_type_select.value);
    console.log("Data Inicial: " + data_inicial_rel_inp.value);
    console.log("Data Final: " + data_final_rel_inp.value);
    relatorio_disponivel = true;
  } else {
    alert("Por favor, preencha todos os campos!");
    console.log("Por favor, preencha todos os campos!");
  }

}

/* Função para Exportar o relatório gerado */
function exp_rel() {

  if (relatorio_disponivel) {
    console.log("Exportando relatório");
  } else {
    alert("Gere um relatório primeiro!");
    console.log("Gere um relatório primeiro!");
  }

}

/* Função para quando for selecionar um tipo */
function selectOption(id) {
  // Verifica se o ID começa com "type_" para garantir que seja um tipo válido
  if (id.startsWith("reg_")) {
    let newOption = document.getElementById(id);
    if (newOption != null) {
      // Remove a classe de seleção do tipo anteriormente selecionado
      let lastOption = document.getElementById(selectedOptionId);
      if (lastOption != null) {
        lastOption.classList.remove("selected_scroll_component");
      }
      // Atualiza o ID do tipo selecionado e adiciona a classe de seleção ao novo tipo
      selectedOptionId = id;
      newOption.classList.add("selected_scroll_component");
    } else {
      // Se o tipo não existir, mostra um alerta
      alert("Erro - Opção selecionada não encontrada!");
      console.log("Erro - Opção selecionada não encontrada!");
    }
  } else {
    // Se o ID não começar com "type_", mostra um alerta
    alert("Erro ao selecionar opção, tente novamente!");
    console.log("Erro ao selecionar opção, tente novamente!");
  }
}

/* Atribuindo as funções aos elementos */
redefine_rel_inputs_btn.addEventListener(
  "click", redefine_rel_inputs, false
);

gen_rel_btn.addEventListener(
  "click", gen_rel, false
);

exp_rel_btn.addEventListener(
  "click", exp_rel, false
);

// Adiciona a função de seleção aos tipos já existentes na lista
scroll_div.querySelectorAll('.scroll_component').forEach(function(scroll_component) {
  scroll_component.addEventListener(
    "click", function() {
      selectOption(scroll_component.id);
    }, false
  );
});
