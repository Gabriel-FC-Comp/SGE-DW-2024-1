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

let contador = 0;

let selectedOptionId = ""; // ID do tipo selecionado

function Adicionar() {
  let id_estoq = id.value;
  let qtd_estoq = quantidade.value;
  
  if(id_estoq.trim() != "" && new Decimal(qtd_estoq) != 0){
    let preco_estoq = preco.value;
    let desconto_estoq = desconto.value;
    let total_estoq = total.value;

    contador = contador+1;
    let reg_estoq = document.createElement("div");
    reg_estoq.id = "reg_" + (contador);
    reg_estoq.classList.add("scroll_component");
    reg_estoq.classList.add("rounded-5");
    reg_estoq.classList.add("ps-3");
    reg_estoq.classList.add("my-2");

    let p_estoq = document.createElement("span");
    p_estoq.classList.add("corTexto");
    p_estoq.classList.add("bg-transparent");
    p_estoq.innerHTML = `<span class="idCamp text-center">${id_estoq}</span>`;
    p_estoq.innerHTML += " | ";
    p_estoq.innerHTML += `<span class="nameCamp text-center">Produto</span>`;
    p_estoq.innerHTML += " | ";
    p_estoq.innerHTML += `<span class="qtdeCamp text-center">${qtd_estoq}</span>`;
    p_estoq.innerHTML += " | ";
    p_estoq.innerHTML += `<span class="valueCamp text-center">${preco_estoq}</span>`;
    p_estoq.innerHTML += " | ";
    p_estoq.innerHTML += `<span class="valueCamp text-center">${total_estoq}</span>`;

    if (cor) {
      reg_estoq.classList.add("dark-mode");
      p_estoq.classList.add("dark-mode");
    }

    reg_estoq.appendChild(p_estoq);

      reg_estoq.addEventListener(
      "click", function() {
        selectOption(reg_estoq.id);
      }, false
    );

    scroll_div.appendChild(reg_estoq);
  }else{
    alert("Informe um ID e uma quantidade para adicionar um registro!");
    console.log("Informe um ID e uma quantidade para adicionar um registro!");
  }
  
}

function atualizaTotal() {
  // Aqui você pode colocar o código para atualizar o total com base na grandeza e no valor recebidos
  let qtde = new Decimal(quantidade.value);
  let prec = new Decimal(preco.value.replace(",","."));
  let desc = new Decimal(desconto.value.replace(",","."));
  
  total.value = (qtde*prec - desc).toFixed(2).replace(".",",");
}

/* Função para quando for selecionar um registro para excluir */
function selectOption(id) {
  // Verifica se o ID começa com "reg_" para garantir que seja um registro válido
  if (id.startsWith("reg_")) {
    let newOption = document.getElementById(id);
    if (newOption != null) {
      // Remove a classe de seleção do tipo anteriormente selecionado
      let lastOption = document.getElementById(selectedOptionId);
      if (lastOption != null) {
        lastOption.classList.remove("selected_scroll_component");
      }
      // Atualiza o ID do tipo selecionado e adiciona a classe de seleção ao novo registro
      selectedOptionId = id;
      newOption.classList.add("selected_scroll_component");
    } else {
      // Se o registro não existir, mostra um alerta
      alert("Erro - Opção selecionada não encontrada!");
      console.log("Erro - Opção selecionada não encontrada!");
    }
  } else {
    // Se o ID não começar com "reg_", mostra um alerta
    alert("Erro ao selecionar opção, tente novamente!");
    console.log("Erro ao selecionar opção, tente novamente!");
  }
}

/* Função para remover um registro da lista de registro */
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
      // Se o registro não existir, mostra um alerta
      alert("Erro inesperado, registro não encontrado!");
      console.log("Erro inesperado, registro não encontrado!");
    }
  }
};

function finalize_ajuste(){
  
  if(aj_date.value != "" && aj_type.value != "" && scroll_div.children.length > 0){
    console.log("Data do Ajuste: " + aj_date.value);
    console.log("Tipo do Ajuste: " + aj_type.value);
    console.log("Observações: " + obs.value);
    console.log("Registro de alterações");
    console.log("");
  }else{
    alert("Insira um registro para ajuste e todas as informações necessárias (*) !");
    console.log("Insira um registro para ajuste e todas as informações necessárias (*) !");
  }
}

// Adiciona um evento de clique ao botão "add_button" (supondo que ele já tenha sido definido em algum lugar do seu código)
add_button.addEventListener("click", Adicionar, false);
finalize_alt_btn.addEventListener("click",finalize_ajuste,false);

quantidade.addEventListener('keydown', function(event) {
  // Obtém o código da tecla pressionada
  var key = event.key;
  // Verifica se a tecla é uma vírgula ou ponto
  if (key == "." || key == "," || key == "-") {
    // Previnir a ação padrão da tecla (não permitir a inserção da vírgula ou ponto)
    event.preventDefault();
  }
});

preco.addEventListener('keydown', function(event) {
  // Obtém o código da tecla pressionada
  var key = event.key;
  // Verifica se a tecla é uma vírgula ou ponto
  if (key == "-") {
    // Previnir a ação padrão da tecla (não permitir a inserção da vírgula ou ponto)
    event.preventDefault();
  }
});

desconto.addEventListener('keydown', function(event) {
  // Obtém o código da tecla pressionada
  var key = event.key;
  // Verifica se a tecla é uma vírgula ou ponto
  if (key == "-") {
    // Previnir a ação padrão da tecla (não permitir a inserção da vírgula ou ponto)
    event.preventDefault();
  }
});

// Adiciona um evento de input ao elemento "quantidade"
quantidade.addEventListener('input', function(event) {
  if(event.target.value === ''){
    quantidade.value = "0";
    // Chama a função atualizaTotal com os parâmetros adequados
    atualizaTotal("qtde", new Decimal(0));
  }else{
    // Chama a função atualizaTotal com os parâmetros adequados
    atualizaTotal("qtde", new Decimal(event.target.value));
  }
},false);

// Adiciona um evento de input ao elemento "preco"
  preco.addEventListener('input', function(event) {
  if(event.target.value === ''){
      preco.value = "0,00";
  }
    // Chama a função atualizaTotal com os parâmetros adequados
    atualizaTotal();
  
},false);

// Adiciona um evento de input ao elemento "desconto"
desconto.addEventListener('input', function(event) {
  if(event.target.value === ''){
    desconto.value = "0,00";
    }
  atualizaTotal();
},false);

remove_reg_btn.addEventListener('click',rmv_reg,false);

// Adiciona a função de seleção aos tipos já existentes na lista
scroll_div.querySelectorAll('.scroll_component').forEach(function(scroll_component) {
  scroll_component.addEventListener(
    "click", function() {
      selectOption(scroll_component.id);
    }, false
  );
});