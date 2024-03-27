/* Pegando os elementos uma vez para adicionar as funcionalidades */
let rel_type_select = document.getElementById("rel_type_select");
let data_inicial_rel_inp = document.getElementById("data_inicial_rel_inp");
let data_final_rel_inp = document.getElementById("data_final_rel_inp");
let rel_type_input = document.getElementById("");
let redefine_rel_inputs_btn = document.getElementById("redefine_rel_inputs_btn");
let gen_rel_btn = document.getElementById("gen_rel_btn");
let exp_rel_btn = document.getElementById("exp_rel_btn");

let relatorio_disponivel = false;

/* Definindo as funções de ação */

/* Função para redefinir os campos*/
function redefine_rel_inputs(){
    console.log("Rset")
    rel_type_select.value = "None";
    data_inicial_rel_inp.value = "";
    data_final_rel_inp.value = "";
};

/* Função para Gerar o relatório conforme as especificações do usuário */
function gen_rel(){

    if(rel_type_select.value != "None" && data_inicial_rel_inp.value != "" && data_final_rel_inp.value != ""){
        console.log("Tipo do relatório: " + rel_type_select.value);
        console.log("Data Inicial: " + data_inicial_rel_inp.value);
        console.log("Data Final: " + data_final_rel_inp.value);
        relatorio_disponivel = true;
    }else{
        alert("Por favor, preencha todos os campos!");
        console.log("Por favor, preencha todos os campos!");
    }

}

/* Função para Exportar o relatório gerado */
function exp_rel(){

    if(relatorio_disponivel){
        console.log("Exportando relatório");
    }else{
        alert("Gere um relatório primeiro!");
        console.log("Gere um relatório primeiro!");
    }

}

/* Atribuindo as funções aos elementos */
redefine_rel_inputs_btn.addEventListener(
    "click",redefine_rel_inputs,false
);

gen_rel_btn.addEventListener(
    "click",gen_rel,false
);

exp_rel_btn.addEventListener(
    "click",exp_rel,false
);