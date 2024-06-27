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


class ScrollComponent {
  constructor() {
    this.element = document.createElement("div");
    this.element.classList.add("row", "scroll_component", "rounded-4", "ps-3", "my-2");
  }

  config_header() {
    this.element.classList.replace("scroll_component", "scroll_header");
  }

  add_element_id(id) {
    this.element.id = id;
  }

  add_prod_id(codigo_produto) {
    let prodCol = document.createElement("div");
    prodCol.classList.add("col-", "p-0", "m-0", "me-1", "my-1", "right_borded");
    let prodText = document.createElement("span");
    prodText.textContent = codigo_produto;
    prodText.classList.add("corTexto");
    prodCol.appendChild(prodText);
    prodCol.style.width = "50px";
    this.element.appendChild(prodCol);
  }

  add_prod_name(nome_produto) {
    let nameCol = document.createElement("div");
    nameCol.classList.add("col-", "p-0", "m-0", "me-1", "my-1", "right_borded");
    let nameText = document.createElement("span");
    nameText.textContent = nome_produto;
    nameText.classList.add("corTexto");
    nameCol.appendChild(nameText);
    nameCol.style.width = "450px";
    this.element.appendChild(nameCol);
  }

  add_prod_qtde(quantidade_produtos) {
    let qtdeCol = document.createElement("div");
    qtdeCol.classList.add("col-", "p-0", "m-0", "me-1", "my-1", "right_borded");
    let qtdeText = document.createElement("span");
    qtdeText.textContent = quantidade_produtos;
    qtdeText.classList.add("corTexto");
    qtdeCol.appendChild(qtdeText);
    qtdeCol.style.width = "65px";
    this.element.appendChild(qtdeCol);
  }

  add_prod_cost(custo_produto) {
    let costCol = document.createElement("div");
    costCol.classList.add("col-", "p-0", "m-0", "me-1", "my-1", "right_borded");
    let costText = document.createElement("span");
    costText.textContent = "R$" + parseFloat(custo_produto).toFixed(2).toString().replace(".", ",");
    costText.classList.add("corTexto");
    costCol.appendChild(costText);
    costCol.style.width = "90px";
    this.element.appendChild(costCol);
  }
  add_data(data_produto) {
    let dataCol = document.createElement("div");
    dataCol.classList.add("col-", "p-0", "m-0", "me-1", "my-1", "right_borded");
    let dataText = document.createElement("span");
    dataText.textContent = data_produto;
    dataText.classList.add("corTexto");
    dataCol.appendChild(dataText);
    dataCol.style.width = "100px";
    this.element.appendChild(dataCol);
  }

  add_price(preco_produto) {
    let priceCol = document.createElement("div");
    priceCol.classList.add("col-", "p-0", "m-0", "me-1", "my-1", "right_borded");
    let priceText = document.createElement("span");
    priceText.textContent = "R$" + parseFloat(preco_produto).toFixed(2).toString().replace(".", ",");
    priceText.classList.add("corTexto");
    priceCol.appendChild(priceText);
    priceCol.style.width = "100px";
    this.element.appendChild(priceCol);
  }
}


let relatorio_disponivel = false; // Flag para indicar se um relatório está disponível ou não
function createListHeader() {
  let newHead = new ScrollComponent();
  newHead.config_header();
  newHead.add_element_id("scroll_list_header");
  newHead.add_prod_id("ID");
  newHead.add_prod_name("Nome do Produto");
  newHead.add_prod_cost("Custo");
  newHead.add_prod_qtde("Qtde");
  newHead.add_data("Data");
  newHead.add_price("Preco");
  newHead.element.style.removeProperty(":hover");
  return newHead;
}
/* Definindo as funções de ação */
let listHeader = createListHeader();
scroll_div.appendChild(listHeader.element);
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
  var data = {
    tipoRelatorio: tipoRelatorio,
    dataInicial: dataInicial,
    dataFinal: dataFinal
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
  fetch('./scripts/search_report.php', options)
    .then(response => {
      if (!response.ok) {
        throw new Error('Erro na requisição');
      }
      return response.json();
    })
    .then(data => {
      // Verifica se achou o produto
      if (data.error == undefined) {
        // Remove todos os elementos já pesquisados
        scroll_div.replaceChildren(listHeader.element);
        // Remove a referência do último elemento selecionado
        lastOption = null;
        // Verifica todos os produtos encontrados e cria os elementos para mostrá-los
        console.log(data);

        for (i = 0; i < data.length; i++) {
          let newProd = new ScrollComponent();
          newProd.add_element_id("reg_" + i);
          newProd.add_prod_id(data[i].codigo_produto);
          newProd.add_prod_name(data[i].nome_produto);
          newProd.add_data(data[i].data_criacao)
          newProd.add_prod_cost(data[i].custo_produto);
          newProd.add_prod_qtde(data[i].quantidade_produtos);
          newProd.add_price(data[i].custo_produto);
          newProd.element.addEventListener("click", function () {
            selectOption(newProd.element.id);
          }, false);
          scroll_div.appendChild(newProd.element);
        }


        relatorio_disponivel = true; // Marca o relatório como disponível
      } else {
        alert(data.error);
        console.log(data.error);
      }
    })
    .catch(error => console.error('Erro:', error));

}

/* Função para exportar o relatório gerado */
function exp_rel() {
  // Verifica se o relatório está disponível para exportação
  if (relatorio_disponivel) {
    //tranforma a lista em pdf
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
genRelForm.addEventListener('submit', gen_rel, false);

// Adiciona a função de exportação de relatório ao botão correspondente
exp_rel_btn.addEventListener("click", exp_rel, false);




// Adiciona a função de seleção às opções existentes na lista
scroll_div.querySelectorAll('.scroll_component').forEach(function (scroll_component) {
  scroll_component.addEventListener(
    "click", function () {
      selectOption(scroll_component.id);
    }, false
  );
});
