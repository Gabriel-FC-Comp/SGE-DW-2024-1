
// Função para o botão de redirecionamento da página de cadastro de produtos
function redirect_cad_prod(){
  window.location.href = "cadastro_produtos.html";
}

// Função para o botão de redirecionamento da página de cadastro de funcionários
function redirect_cad_func(){
  window.location.href = "cadastro_funcionarios.html";
}

// Função para o botão de redirecionamento da página de geração de relatórios
function redirect_gera_rel(){
  window.location.href = "gera_relatorios.html";
}

// Função para o botão de redirecionamento da página de gerenciamento do tipo de produtos
function redirect_gerenc_tipos(){
  window.location.href = "gerencia_tipos.html";
}

// Função para o botão de redirecionamento da página de ajuste de estoque
function redirect_aj_estoque(){
  window.location.href = "ajuste_estoque.html";
}


// Adiciona função de redirecionamento da página de cadastro de produtos ao botão
document.getElementById("menu_cd_prod_btn").addEventListener(
  "click",redirect_cad_prod,false
);
  
// Adiciona função de redirecionamento da página de cadastro de funcionários ao botão
document.getElementById("menu_cd_func_btn").addEventListener(
  "click",redirect_cad_func,false
);

// Adiciona função de redirecionamento da página de geração de relatórios ao botão 
document.getElementById("menu_gr_rel_btn").addEventListener(
  "click",redirect_gera_rel,false
);

// Adiciona função de redirecionamento da página de gerenciamento do tipo de produtos ao botão
document.getElementById("menu_gc_prod_type_btn").addEventListener(
  "click",redirect_gerenc_tipos,false
);

// Adiciona função de redirecionamento da página de ajuste de estoque ao botão
document.getElementById("menu_aj_estoq_btn").addEventListener(
  "click",redirect_aj_estoque,false
);

