/* Pegando os elementos uma vez para adicionar as funcionalidades */
let add_type_btn = document.getElementById("add_type_btn");
let rmv_type_btn = document.getElementById("rmv_type_btn");
let save_type_change_btn = document.getElementById("save_type_change_btn");
let prod_type_inp = document.getElementById("prod_type_inp");

/* Definindo as funções de ação */
let teve_alteracao = false;

/* Função para adicionar um novo tipo a lista de tipos */
function add_type(){
    // Verifica se tem algum nome para ser adicionado
    if(prod_type_inp.value != ""){
        // Adiciona o novo tipo
        console.log("Novo tipo adiconado: " + prod_type_inp.value)
        // Ativa a flag de alterações
        teve_alteracao = true;
    }else{
        // Informa ao usuário que deve inserir um nome para adicionar um novo tipo
        alert("Por favor, insira um nome para o tipo que quer adiconar!");
        console.log("Por favor, insira um nome para o tipo que quer adiconar!");
    }
};

/* Função para remover algum tipo da lista de tipos selecionada */
function rmv_type(){
    // Remove o tipo selecionado
    console.log("Remove algum tipo");
    // Ativa a flag de alterações
    teve_alteracao = true;
};

/* Função para Gerar o relatório conforme as especificações do usuário */
function save_type_change(){

    /* Verifica se teve alteração para efetivamente acessar o banco de dados */
    if(teve_alteracao){
        /* Reseta indicando que o banco de dados está atualizado */
        teve_alteracao = false;
    }
    console.log("Salva alteração nos tipos");

}


/* Atribuindo as funções aos elementos */
add_type_btn.addEventListener(
    "click",add_type,false
);

rmv_type_btn.addEventListener(
    "click",rmv_type,false
);

save_type_change_btn.addEventListener(
    "click",save_type_change,false
);

