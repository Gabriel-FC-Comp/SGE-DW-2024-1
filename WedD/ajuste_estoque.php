<!-- 

Autores:
  * Ana Carolina Ribeiro Miranda 
  * Cristian Andre Sanches
  * Gabriel Finger Conte
  * Leonardo Fagote

-->

<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está conectado
if (isset($_SESSION['user_connected']) && $_SESSION['user_connected'] === true) {
  // O usuário está conectado, exibe o conteúdo HTML
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGE</title>

    <!-- Adicionando o Bootstrap no Header -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Adicionando o jQuery no Header -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Favicon na Aba do Navegador -->
    <link rel="icon" href="./favicon.ico" type="image/x-icon">

    <!-- Adicionando o estilo personalizado -->
    <link id="theme-style" rel="stylesheet" href="./css/style.css">
  </head>

  <body>

    <!-- Container principal do cabeçalho -->
    <div id="cabecalho" class="container">
      <div class="row align-items-center pt-4">
        <!-- Logo -->
        <div class="col-auto">
          <img id="logoMenu" src="./imgs/homePreta.png" class="img-fluid" width="100px" alt="home">
        </div>
        <!-- Título do Ajuste de Estoque -->
        <div class="col">
          <h1 class="mb-0 corTexto">Ajuste de Estoque</h1>
        </div>
        <!-- Botão de acessibilidade -->
        <div class="col-auto">
          <button id="accessibility_btn" class="btn">
            <img src="./imgs/accessibilityPreta.png" class="img-fluid" width="30px" alt="accessibility">
          </button>
        </div>
        <!-- Botão de logout -->
        <div class="col-auto">
          <form action="./scripts/end_session.php" method="POST">
            <button id="logout_btn" class="btn">
              <img src="./imgs/logout.png" class="img-fluid" width="30px" alt="logout">
            </button>
          </form>
        </div>

        <!-- Switch para alternar o modo de cor -->
        <div class="col-auto">
          <div class="form-check form-switch">
            <input id="colorModeSwitch" class="form-check-input" type="checkbox" role="switch">
            <label class="form-check-label" for="colorModeSwitch"></label>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-5">

      <!-- Formulário com as informações do ajuste realizado -->
      <form>
        <div class="row align-items-left">
          <!-- Input para Data de Ajuste -->
          <div class="col-auto mb-2">
            <p class="corTexto">Data Ajuste*</p>
            <input id="dataAjuste" name="ajuste_date" type="date" class="form-control" required>
          </div>

          <!-- Seleção de Tipo de Ajuste -->
          <div class="col-auto mb-2">
            <p class="corTexto">Tipo de Ajuste*</p>
            <select id="aj_type_inp" name="ajuste_type" class="form-select" id="floatingSelect" required>
              <option selected>Selecione um tipo</option>
              <option value="Entrada">Entrada</option>
              <option value="Saída">Saída</option>
              <option value="Ajuste">Ajuste</option>
            </select>
          </div>

          <!-- Observações -->
          <div class="col mb-2">
            <p class="corTexto">Observações</p>
            <textarea id="observacoes" name="obs_text" class="form-control" rows="4" cols="50"></textarea>
          </div>

        </div>
      <!-- </form>

      <form> -->
        <div class="row align-items-left mt-3">
          <!-- Formulário com para adicionar um registro no ajuste -->

          <!-- ID do Produto -->
          <div class="col-auto mb-2">
            <p class="corTexto">ID*</p>
            <input id="id_estoq" name="prod_id" type="number" class="form-control" required>
          </div>

          <!-- Quantidade -->
          <div class="col-auto mb-2">
            <p class="corTexto">Quantidade*</p>
            <input id="qtd_estoq" name="qtde_ajuste" type="number" class="form-control" step="1" min=0 value="0" required>
          </div>

          <!-- Preço -->
          <div class="col-auto mb-2">
            <p class="corTexto">Preço*</p>
            <input id="preco_estoq" name="preco_ajuste" type="text" class="form-control" value="0,00" required>
          </div>

          <!-- Desconto -->
          <div class="col-auto mb-2">
            <p class="corTexto">Desconto Total</p>
            <input id="desconto_estoq" name="desconto_ajuste" type="text" value="0,00" class="form-control">
          </div>

          <!-- Total -->
          <div class="col-auto mb-2">
            <p class="corTexto">Total</p>
            <input id="total_estoq" name="total_ajuste" type="text" class="form-control" disabled>
          </div>

          <!-- Botão para Adicionar -->
          <div class="col-auto pt-4 mt-2 mb-2">
            <button id="btn_adicionar" name="add_ajuste" type="button" class="rounded-pill degradeButton">Adicionar</button>
          </div>


        </div>
      <!-- </form> -->

      <!-- Lista de Itens -->
      <div class="row div_list mt-3 py-4 px-3 rounded-5">
        <div class="row rounded-5 my-2 mx-0 pe-0 h-25">
          <!-- Cabeçalho da Lista de Itens -->
          <div class="col ps-3 rounded-5 scroll_header">
            <span class="corTexto">
              <span class="text-center idCamp">ID</span>|
              <!-- <span class="text-center nameCamp">Nome do Produto</span>| -->
              <span class="text-center qtdeCamp">Qtde</span>|
              <span class="text-center valueCamp">Valor Un (R$)</span>|
              <span class="text-center valueCamp">Desconto Total (R$)</span>|
              <span class="text-center valueCamp">Total (R$)</span>
            </span>
          </div>
          <!-- Botão para Remover Item -->
          <div class="col-auto m-0 pe-0">
            <button id="rmv_reg_btn" type="button" class="scroll_header rounded-circle"><span class="corTexto">&nbsp-&nbsp</span></button>
          </div>
        </div>

        <!-- Lista de Itens -->
        <div id="component_list" class="scroll_div bg-transparent overflow-y-scroll pe-4">

        </div>
      </div>

      <!-- Botões para Finalizar Ajuste e Exibir Total -->
      <div class="row mt-4">
        <!-- Botão para Finalizar Ajuste -->
        <div class="col-auto p-0">
          <button id="btn_finalizar" name="fin_ajuste" type="button" class="rounded-pill degradeButton">Finalizar Ajuste</button>
        </div>

        <!-- Exibição do Ajuste Total -->
        <div class="col text-end">
          <p class="corTexto">Ajuste Total: R$<span id="ajuste_total_value">0,00</span></p>
        </div>
      </div>
      </form>
    </div>

    <!-- Adicionando os Scripts -->
    <script src="./scripts/scripts.js"></script>
    <script src="./scripts/decimal.js"></script> <!-- Biblioteca decimal.js -->
    <script src="./scripts/ajuste_estoque.js"></script>
    <!-- Adicionando o Bootstrap no Body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  </body>

  </html>

<?php
} else {
  // O usuário não está conectado, redireciona para a página de login
  header("Location: index.php");
  exit;
}
?>