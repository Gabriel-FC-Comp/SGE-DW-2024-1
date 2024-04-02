// Função para redefinir todos os checkboxes para o estado desmarcado
function resetCheckboxes() {
  // Seleciona todos os checkboxes dentro da lista de tarefas
  var checkboxes = document.querySelectorAll('.custom-checkbox input[type="checkbox"]');

  // Define o estado de cada checkbox como desmarcado
  checkboxes.forEach(function(checkbox) {
    checkbox.checked = false;
  });
}

// Função simples para salvar dados
function simpleSalvar() {
  console.log("Salvou com sucesso!"); // Exibe uma mensagem no console
}

// Função simples para excluir dados
function simpleExcluir() {
  console.log("Excluiu com sucesso!"); // Exibe uma mensagem no console
}

// Adiciona o evento de clique ao botão de redefinição de checkboxes
document.getElementById("redfine_func_perm_button").addEventListener("click", resetCheckboxes, false);

// Adiciona o evento de clique ao botão de salvar
document.getElementById("save_func_button").addEventListener("click", simpleSalvar, false);

// Adiciona o evento de clique ao botão de excluir
document.getElementById("delet_func_button").addEventListener("click", simpleExcluir, false);
