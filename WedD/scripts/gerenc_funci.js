/*

Autores:
  * Ana Carolina Ribeiro Miranda 
  * Cristian Andre Sanches
  * Gabriel Finger Conte
  * Leonardo Fagote

*/

let cpf_func_inp = document.getElementById("cpf_func_inp");
let cad_func_form = document.getElementById("cad_func_form");
let redfine_func_perm_btn = document.getElementById("redfine_func_perm_btn");
let delet_func_btn = document.getElementById("delet_func_btn");

// Função para redefinir todos os checkboxes para o estado desmarcado
function resetCheckboxes() {
  // Seleciona todos os checkboxes dentro da lista de tarefas
  let checkboxes = document.querySelectorAll('.custom-checkbox input[type="checkbox"]');

  // Define o estado de cada checkbox como desmarcado
  checkboxes.forEach(function(checkbox) {
    checkbox.checked = false;
  });
}

// Função simples para excluir dados
function simpleExcluir() {
  console.log("Excluiu com sucesso!"); // Exibe uma mensagem no console
}

function search_func() {

  let func_name_inp = document.getElementById("func_name_inp");
  let checkCadastroFuncionario = document.getElementById("checkCadastroFuncionario");
  let checkCadastroProdutos = document.getElementById("checkCadastroProdutos");
  let checkGerarRelatorios = document.getElementById("checkGerarRelatorios");
  let checkPermissoesFunc = document.getElementById("checkPermissoesFunc");
  let checkAjuste = document.getElementById("checkAjuste");
  let checkCompras = document.getElementById("checkCompras");
  let checkVendas = document.getElementById("checkVendas");
  let checkCorrecao = document.getElementById("checkCorrecao");

  // Remove a máscara
  let value_cpf_func = cpf_func_inp.value.replace(/[.,-]/g, '');

  // Cria um objeto de dados a serem enviados
  var data = {
    cpf_func: value_cpf_func
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
  fetch('./scripts/search_func_data.php', options)
    .then(response => {
      if (!response.ok) {
        throw new Error('Erro na requisição');
      }
      return response.json();
    })
    .then(data => {
      // Verifica se achou o produto
      if (data.error == undefined) {

        func_name_inp.value = data.func_name;
        checkCadastroFuncionario.checked = data.cad_func_permiss;
        checkCadastroProdutos.checked = data.cad_prod_permiss;
        checkGerarRelatorios.checked = data.gera_rel_permiss;
        checkPermissoesFunc.checked = data.permiss_change_permiss;
        checkAjuste.checked = data.aj_estoq_permiss;
        checkCompras.checked = data.aj_estoq_comp_permiss;
        checkVendas.checked = data.aj_estoq_said_permiss;
        checkCorrecao.checked = data.aj_estoq_aj_permiss;

      } else {
        console.log(data.error)
        func_name_inp = "";
        checkCadastroFuncionario.checked = false;
        checkCadastroProdutos.checked = false;
        checkGerarRelatorios.checked = false;
        checkPermissoesFunc.checked = false;
        checkAjuste.checked = false;
        checkCompras.checked = false;
        checkVendas.checked = false;
        checkCorrecao.checked = false;

      }
    })
    .catch(error => console.error('Erro:', error));
}


// Adiciona o evento de clique ao botão de redefinição de checkboxes
redfine_func_perm_btn.addEventListener("click", resetCheckboxes, false);

// Adiciona o evento de clique ao botão de excluir
delet_func_btn.addEventListener("click", simpleExcluir, false);

cpf_func_inp.addEventListener("blur", search_func, false);