
let prodList = document.getElementById("component_list");
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
        // prodCol.style.backgroundColor = "red";
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
        // nameCol.style.backgroundColor = "green";
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
        // qtdeCol.style.backgroundColor = "blue";
        qtdeCol.appendChild(qtdeText);
        qtdeCol.style.width = "65px";
        this.element.appendChild(qtdeCol);
    }

    add_header_cost(custo_produto) {
        let costCol = document.createElement("div");
        costCol.classList.add("col-", "p-0", "m-0", "me-1", "my-1", "right_borded");
        let costText = document.createElement("span");
        costText.textContent = custo_produto;
        costText.classList.add("corTexto");
        // costCol.style.backgroundColor = "red";
        costCol.appendChild(costText);
        costCol.style.width = "90px";
        this.element.appendChild(costCol);
    }

    add_prod_cost(custo_produto) {
        let costCol = document.createElement("div");
        costCol.classList.add("col-", "p-0", "m-0", "me-1", "my-1", "right_borded");
        let costText = document.createElement("span");
        costText.textContent = "R$" + parseFloat(custo_produto).toFixed(2).toString().replace(".", ",");
        costText.classList.add("corTexto");
        // costCol.style.backgroundColor = "red";
        costCol.appendChild(costText);
        costCol.style.width = "90px";
        this.element.appendChild(costCol);
    }

    add_prod_type(tipo_produto) {
        let typeCol = document.createElement("div");
        typeCol.classList.add("col-", "p-0", "m-0", "me-1", "my-1", "right_borded");
        let typeText = document.createElement("span");
        typeText.textContent = tipo_produto;
        typeText.classList.add("corTexto");
        // typeCol.style.backgroundColor = "green";
        typeCol.appendChild(typeText);
        typeCol.style.width = "250px";
        this.element.appendChild(typeCol);
    }

    add_prod_model(modelo_produto) {
        let modelCol = document.createElement("div");
        modelCol.classList.add("col-", "p-0", "m-0", "me-1", "my-1");
        let modelText = document.createElement("span");
        modelText.textContent = modelo_produto;
        modelText.classList.add("corTexto");
        // modelCol.style.backgroundColor = "blue";
        modelCol.appendChild(modelText);
        modelCol.style.width = "250px";
        this.element.appendChild(modelCol);
    }

    add_prod_barcode(codigo_barras_produto) {
        let barcodeCol = document.createElement("div");
        barcodeCol.classList.add("col-", "p-0", "m-0", "me-1", "my-1");
        let barcodeText = document.createElement("span");
        barcodeText.textContent = codigo_barras_produto;
        barcodeText.classList.add("corTexto");
        // barcodeCol.style.backgroundColor = "red";
        barcodeCol.appendChild(barcodeText);
        barcodeCol.style.width = "250px";
        this.element.appendChild(barcodeCol);
    }

}

function createListHeader() {
    let newHead = new ScrollComponent();
    newHead.config_header();
    newHead.add_element_id("scroll_list_header");
    newHead.add_prod_id("ID");
    newHead.add_prod_name("Nome do Produto");
    newHead.add_header_cost("Custo");
    newHead.add_prod_qtde("Qtde");
    newHead.add_prod_type("Tipo");
    newHead.add_prod_model("Modelo");
    newHead.add_prod_barcode("Código de Barras");
    newHead.element.style.removeProperty(":hover");
    return newHead;
}

let listHeader = createListHeader();
prodList.appendChild(listHeader.element);

function search_prod(event) {
    event.preventDefault();

    // Pega os dados do formulário
    let prod_form_data = new FormData(this);
    let prod_id = prod_form_data.get("prod_ID");
    let prod_name = prod_form_data.get("prod_name");
    let prod_type = prod_form_data.get("prod_type");
    let prod_model = prod_form_data.get("prod_model");
    let prod_barcode = prod_form_data.get("prod_barcode");

    // Cria um objeto de dados a serem enviados
    var data = {
        prod_ID: prod_id,
        prod_name: prod_name,
        prod_type: prod_type,
        prod_model: prod_model,
        prod_barcode: prod_barcode
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
    fetch('./scripts/search_multiple_prod_data.php', options)
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
                prodList.replaceChildren(listHeader.element);
                // Remove a referência do último elemento selecionado
                lastOption = null;
                // Verifica todos os produtos encontrados e cria os elementos para mostrá-los
                for (i = 0; i < data.length; i++) {
                    let newProd = new ScrollComponent();
                    newProd.add_element_id("ret_" + i);
                    newProd.add_prod_id(data[i].codigo_produto);
                    newProd.add_prod_name(data[i].nome_produto);
                    newProd.add_prod_cost(data[i].custo_produto);
                    newProd.add_prod_qtde(data[i].quantidade_produtos);
                    newProd.add_prod_type(data[i].tipo_produto);
                    newProd.add_prod_model(data[i].modelo_produto);
                    newProd.add_prod_barcode(data[i].codigo_barras_produto);
                    newProd.element.addEventListener("click", function() {
                        selectOption(newProd.element.id);
                    }, false);
                    prodList.appendChild(newProd.element);
                }
            } else {
                alert(data.error);
                console.log(data.error);
            }
        })
        .catch(error => console.error('Erro:', error));
}

/* Função para quando for selecionar um tipo para excluir */
function selectOption(id) {
    // Verifica se o ID começa com "type_" para garantir que seja um tipo válido
    if (id.startsWith("ret_")) {
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

document.getElementById("searchProdForm").addEventListener("submit", search_prod, false);