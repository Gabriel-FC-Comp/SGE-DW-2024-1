/*

Autores:
  * Ana Carolina Ribeiro Miranda 
  * Cristian Andre Sanches
  * Gabriel Finger Conte
  * Leonardo Fagote

*/

/* Pegando os elementos uma vez para adicionar as funcionalidades */
let exp_rel_btn = document.getElementById("exp_rel_btn"); // Botão para exportar relatório
let genRelForm = document.getElementById('gera_rel_form'); // Formulário com os dados de geração o relatório
let scroll_div = document.getElementById("component_list"); // Div que contém a lista de tipos
let selectedOptionId = ""; // ID do tipo selecionado

let relatorio_disponivel = false; // Flag para indicar se um relatório está disponível ou não

/* Definindo as funções de ação */

/* Função para gerar o relatório com base nos dados fornecidos */
function gen_rel(event) {
  event.preventDefault(); // Impedir o envio padrão do formulário
  let relFormData = new FormData(this); // Pega os dados do formulário

  // Pega as datas para verificação de cronologia
  let dataInicial = new Date(relFormData.get("data_inicial_rel"));
  let dataFinal = new Date(relFormData.get("data_final_rel"));

  // Verifica a cronologia das datas inicial e final
  if (dataFinal < dataInicial) {
    alert("A data final é MAIOR que a data inicial!");
    return;
  }// if

  // Pega os dados do formulário para utilização futura
  let tipoRelatorio = relFormData.get("rel_type");
  dataInicial = relFormData.get("data_inicial_rel");
  dataFinal = relFormData.get("data_final_rel");

  // Exibe os dados dos inputs no console
  console.log(tipoRelatorio);
  console.log(dataInicial);
  console.log(dataFinal);

  relatorio_disponivel = true; // Marca o relatório como disponível
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

// Adiciona a lógica para tratar a geração de relatório
genRelForm.addEventListener('submit', gen_rel);

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
