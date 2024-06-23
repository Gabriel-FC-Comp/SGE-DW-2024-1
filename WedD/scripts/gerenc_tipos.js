/*

Autores:
  * Ana Carolina Ribeiro Miranda 
  * Cristian Andre Sanches
  * Gabriel Finger Conte
  * Leonardo Fagote

*/

/* Pegando os elementos necessários do HTML */
let add_type_btn = document.getElementById("add_type_btn"); // Botão para adicionar tipo
let rmv_type_btn = document.getElementById("rmv_type_btn"); // Botão para remover tipo
let save_type_change_btn = document.getElementById("save_type_change_btn"); // Botão para salvar alterações
let prod_type_inp = document.getElementById("prod_type_inp"); // Input para digitar o tipo
let scroll_div = document.getElementById("component_list"); // Div que contém a lista de tipos
let selectedOptionId = ""; // ID do tipo selecionado

/* Flag para indicar se houve alterações na lista de tipos */
let teve_alteracao = false;

/* Função para adicionar um novo tipo à lista de tipos */
function add_type() {
  // Verifica se foi digitado um nome para o tipo
  let prodType = prod_type_inp.value;
  let existing_type = null;
  if (prodType != "") {
    // Verifica se o tipo já existe na lista
    let tipo_jaExiste = false;
    scroll_div.querySelectorAll('.scroll_component').forEach(function(scroll_component) {
      if (scroll_component.id == ("type_" + prodType)) {
        tipo_jaExiste = true;
        existing_type = scroll_component;
        return;
      }
    });
    if (tipo_jaExiste) {

      if (existing_type.classList.contains("rm_type")) {
        // Se já foi adicionado, mas foi marcado para remoção, apenas remove a marcação
        existing_type.classList.remove("rm_type");
        existing_type.style.display = "block";
      } else {
        // Se o tipo já existir, mostra um alerta e encerra a função
        alert("Tipo já existente!\nNão suportamos tipos duplicados!");
        console.log("Tipo já existente!\nNão suportamos tipos duplicados!");
        return;
      }
    }
    // Cria um novo componente para o tipo e adiciona ao HTML
    // console.log("Novo tipo adicionado: " + prodType)
    let newComponent = document.createElement("div");
    newComponent.classList.add('scroll_component', 'rounded-5', 'ps-3', 'my-2', "new_type");

    newComponent.id = "type_" + prodType;
    newComponent.addEventListener(
      "click", function() {
        selectOption(newComponent.id);
      }, false
    );
    let newComponentContent = document.createElement("p");
    newComponentContent.classList.add("corTexto", "bg-transparent");
    newComponentContent.innerText = prodType;

    // Verifica se está no dark-mode
    if (cor) {
      newComponent.classList.add("dark-mode");
      newComponentContent.classList.add("dark-mode");
    }
    // Adiciona o novo tipo na lista
    newComponent.appendChild(newComponentContent);
    scroll_div.appendChild(newComponent);
    // Ativa a flag de alterações
    teve_alteracao = true;
    // Atualiza a lista de componentes
    scroll_component_list = scroll_div.querySelectorAll('.scroll_component');
  } else {
    // Se não foi digitado um nome, mostra um alerta
    alert("Por favor, insira um nome para o tipo que quer adicionar!");
    console.log("Por favor, insira um nome para o tipo que quer adicionar!");
  }
};

/* Função para remover um tipo da lista de tipos */
function rmv_type() {
  // Verifica se há um tipo selecionado para remover
  if (selectedOptionId.startsWith("type_")) {
    let tipo_a_remover = document.getElementById(selectedOptionId);
    // Verifica se o tipo a ser removido existe
    if (tipo_a_remover != null) {
      // Remove o tipo da lista
      tipo_a_remover.style.display = "none";

      // Verifica se já existia no BD
      if (tipo_a_remover.classList.contains("new_type")) {
        // Se não existia só remove da lista
        tipo_a_remover.parentNode.removeChild(tipo_a_remover);
      } else {
        // Se já existia marca para remover
        tipo_a_remover.classList.add("rm_type");
      }

      // console.log("Remove o tipo: " + tipo_a_remover.id);

      // Ativa a flag de alterações
      teve_alteracao = true;
      selectedOptionId = "";
    } else {
      // Se o tipo não existir, mostra um alerta
      alert("Erro inesperado, tipo não encontrado!");
      console.log("Erro inesperado, tipo não encontrado!");
    }
  }
  // Atualiza a lista de componentes
  scroll_component_list = scroll_div.querySelectorAll('.scroll_component');
};

/* Função para salvar as alterações feitas na lista de tipos */
function save_type_change() {
  // Verifica se houve alterações para efetivamente salvar no banco de dados
  if (teve_alteracao) {
    // Reseta a flag indicando que o banco de dados está atualizado
    teve_alteracao = false;
  }
  console.log("Salva alteração nos tipos");

  // Seleciona os elementos que deseja enviar
  let types_to_add = [];
  scroll_div.querySelectorAll('.new_type').forEach(function(type) {
    types_to_add.push(type.firstElementChild.innerHTML);
    type.classList.remove("new_type");
  });
  let types_to_rmv = [];
  scroll_div.querySelectorAll('.rm_type').forEach(function(type) {
    types_to_rmv.push(type.firstElementChild.innerHTML);
    type.parentNode.removeChild(type);
  });

  // Cria um objeto de dados a serem enviados
  var data = {
    types_to_add: types_to_add,
    types_to_rmv: types_to_rmv
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
  fetch('./scripts/update_prod_types.php', options)
    .then(response => {
      if (!response.ok) {
        throw new Error('Erro na requisição');
      }
      return response.text();
    })
    .then(data => {
      console.log(data); // Aqui você pode tratar a resposta do servidor
    })
    .catch(error => console.error('Erro:', error));
}

/* Função para quando for selecionar um tipo para excluir */
function selectOption(id) {
  // Verifica se o ID começa com "type_" para garantir que seja um tipo válido
  if (id.startsWith("type_")) {
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

function search_type() {
  let prod_type_input = "type_" + prod_type_inp.value;
  scroll_component_list.forEach(function(prod_type) {
    if (!prod_type.id.startsWith(prod_type_input)) {
      prod_type.style.display = "none";
    } else if (!prod_type.classList.contains("rm_type")) {
      prod_type.style.display = "block";
    }
  });
}

/* Atribuindo as funções aos elementos HTML */
add_type_btn.addEventListener(
  "click", add_type, false
);

rmv_type_btn.addEventListener(
  "click", rmv_type, false
);

save_type_change_btn.addEventListener(
  "click", save_type_change, false
);

prod_type_inp.addEventListener(
  "input", search_type, false
);

// Adiciona a função de seleção aos tipos já existentes na lista
let scroll_component_list = scroll_div.querySelectorAll('.scroll_component');
scroll_component_list.forEach(function(scroll_component) {
  scroll_component.addEventListener(
    "click", function() {
      selectOption(scroll_component.id);
    }, false
  );
});
