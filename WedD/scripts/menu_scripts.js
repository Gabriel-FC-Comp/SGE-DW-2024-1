/*

Autores:
  * Ana Carolina Ribeiro Miranda 
  * Cristian Andre Sanches
  * Gabriel Finger Conte
  * Leonardo Fagote

*/

// Função para o botão de redirecionamento da página de cadastro de produtos
function redirect_cad_prod() {
  window.location.href = "cadastro_produtos.php";
}

// Função para o botão de redirecionamento da página de cadastro de funcionários
function redirect_cad_func() {
  window.location.href = "cadastro_funcionarios.php";
}

// Função para o botão de redirecionamento da página de geração de relatórios
function redirect_gera_rel() {
  window.location.href = "gera_relatorios.php";
}

// Função para o botão de redirecionamento da página de gerenciamento do tipo de produtos
function redirect_gerenc_tipos() {
  window.location.href = "gerencia_tipos.php";
}

// Função para o botão de redirecionamento da página de ajuste de estoque
function redirect_aj_estoque() {
  window.location.href = "ajuste_estoque.php";
}

// Função para o botão de redirecionamento da página de ajuste de estoque
function redirect_consulta_prod() {
  window.location.href = "consulta_produtos.php";
}

// Função para o botão de redirecionamento da página de mais informações
function redirect_mais_info() {
  window.location.href = "mais_informacoes.php";
}

window.onload = function () {

  // Pega os botões
  let menu_cd_prod_btn = document.getElementById("menu_cd_prod_btn");
  let menu_cd_func_btn = document.getElementById("menu_cd_func_btn");
  let menu_gr_rel_btn = document.getElementById("menu_gr_rel_btn");
  let menu_gc_prod_type_btn = document.getElementById("menu_gc_prod_type_btn");
  let menu_aj_estoq_btn = document.getElementById("menu_aj_estoq_btn");
  let menu_cons_prod_btn = document.getElementById("menu_cons_prod_btn");
  let menu_more_info_btn = document.getElementById("menu_more_info_btn");

  // Adiciona função de redirecionamento da página de cadastro de produtos ao botão
  if (menu_cd_prod_btn != null) {
    menu_cd_prod_btn.addEventListener(
      "click", redirect_cad_prod, false
    );
  }

  // Adiciona função de redirecionamento da página de cadastro de funcionários ao botão
  if (menu_cd_func_btn != null) {
    menu_cd_func_btn.addEventListener(
      "click", redirect_cad_func, false
    );
  }

  // Adiciona função de redirecionamento da página de geração de relatórios ao botão 
  if (menu_gr_rel_btn != null) {
    menu_gr_rel_btn.addEventListener(
      "click", redirect_gera_rel, false
    );
  }

  // Adiciona função de redirecionamento da página de gerenciamento do tipo de produtos ao botão
  if (menu_gc_prod_type_btn != null) {
    menu_gc_prod_type_btn.addEventListener(
      "click", redirect_gerenc_tipos, false
    );
  }

  // Adiciona função de redirecionamento da página de ajuste de estoque ao botão
  if (menu_aj_estoq_btn != null) {
    menu_aj_estoq_btn.addEventListener(
      "click", redirect_aj_estoque, false
    );
  }

  // Adiciona função de redirecionamento da página de ajuste de estoque ao botão
  if (menu_cons_prod_btn != null) {
    menu_cons_prod_btn.addEventListener(
      "click", redirect_consulta_prod, false
    );
  }

  // Adiciona função de redirecionamento da página de mais informações
  if (menu_more_info_btn != null) {
    menu_more_info_btn.addEventListener(
      "click", redirect_mais_info, false
    );
  }

};