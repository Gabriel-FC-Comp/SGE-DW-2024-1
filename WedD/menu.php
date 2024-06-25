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
    <!-- Define a codificação de caracteres e a escala inicial para dispositivos móveis -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGE</title>

    <!-- Adiciona o Bootstrap ao cabeçalho da página -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Adicionando o jQuery no Header -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Favicon na Aba do Navegador -->
    <link rel="icon" href="./favicon.ico" type="image/x-icon">

    <!-- Estilos personalizados da aplicação -->
    <link id="theme-style" rel="stylesheet" href="./css/style.css">
    <link id="menu-theme-style" rel="stylesheet" href="./css/menuStyle.css">
  </head>

  <body>

    <!-- Container principal do cabeçalho -->
    <div id="cabecalho" class="container">
      <div class="row align-items-center pt-4">
        <!-- Logo -->
        <div class="col-auto">
          <img id="logo" src="./imgs/logoPreta.png" class="img-fluid" width="100px" alt="logo">
        </div>
        <!-- Título do menu -->
        <div class="col">
          <h1 class="mb-0 corTexto">Menu</h1>
        </div>

        <!-- Botão de acessibilidade -->
        <div class="col-auto">
          <button id="accessibility_btn" class="btn">
            <img src="./imgs/accessibilityPreta.png" class="img-fluid" width="30px" alt="accessibility">
          </button>
        </div>
        <!-- Modal para escolha de tamanho da fonte -->
        <div id="modalFonte" class="modal">
          <div class="modal-content">
            <p>Escolha o tamanho da fonte:</p>
            <!-- Controle deslizante para ajustar o tamanho da fonte -->
            <input type="range" min="50" max="200" value="100" class="slider" id="fontSlider" onchange="alterarTamanhoFonte(this.value)">
            <!-- Botão para fechar a modal -->
            <button class="close" onclick="fecharModalFonte()">&times;</button>
          </div>
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

    <?php
    // <!-- Container dos botões de menu -->
    echo "<div id='menu' class='container text-center align-items-center justify-content-center d-flex pt-3'>";
    // <!-- Botão para a página de Cadastro de Produtos -->

    $cadProd = "<button id='menu_cd_prod_btn' class='buttonMenu'>
          <img src='./imgs/icons/cadastroProduto.png' class='img-fluid' alt='Cadastro de Produto'>
          <span class=''>Cadastrar Produtos</span>
        </button>";
    if ($_SESSION['podi_cad_prod']) {
      echo $cadProd;
    }

    //  Botão para a página de Cadastro de Funcionários 
    $cadFunc = "<button id='menu_cd_func_btn' class='buttonMenu'>
          <img src='./imgs/icons/cadastroFuncionario.png' class='img-fluid' alt='Cadastro de Funcionario'>
          <span> Cadastrar Funcionários </span>
        </button>";
    if ($_SESSION['podi_cad_func']) {
      echo $cadFunc;
    }

    // <!-- Botão para a página de Gerar Relatórios -->
    $geraRel = "<button id='menu_gr_rel_btn' class='buttonMenu'>
          <img src='./imgs/icons/gerarRelatorios.png' class='img-fluid' alt='Gerar Relatorios'>
          <span class=''>Gerar Relatórios</span>
        </button>";
    if ($_SESSION['podi_ger_relt']) {
      echo $geraRel;
    }

    // <!-- Botão para a página de Gerenciamento dos tipos de produtos -->
    $gerenTipos = "<button id='menu_gc_prod_type_btn' class='buttonMenu'>
          <img src='./imgs/icons/gerenciarTipos.png' class='img-fluid' alt='Gerenciar Tipos de Produtos'>
          <span class=''>Tipos de Produtos</span>
        </button>";
    if ($_SESSION['podi_ajs_prod']) {
      echo $gerenTipos;
    }

    // <!-- Botão para a página de Ajustes de estoque -->
    $ajsEstoque = "<button id='menu_aj_estoq_btn' class='buttonMenu'>
          <img src='./imgs/icons/ajusteEstoque.png' class='img-fluid' alt='Ajuste de Estoque'>
          <span class=''>Ajustes de Estoque</span>
        </button>";
    if ($_SESSION['podi_ajs_estq']) {
      echo $ajsEstoque;
    }

    // <!-- Botão para a página de Consultar Produtos -->
    $consultProd = "<button id='menu_cons_prod_btn' class='buttonMenu'>
          <img src='./imgs/icons/consultarProduto.png' class='img-fluid' alt='Consultar Produtos'>
          <span class=''>Consultar Produtos</span>
        </button>";
    if ($_SESSION['consult_prod']) {
      echo $consultProd;
    }

    // <!-- Botão para Mais Informações -->      
    $info = "<button id='menu_more_info_btn' class='buttonMenu'>
          <img src='./imgs/icons/sobre.png' class='img-fluid' alt='Sobre'>
          <span class=''>Mais Informações</span>
        </button>";
    echo $info;

    echo "</div>";
<<<<<<< Updated upstream
    ?>

    <!-- Adicionando os Scripts Próprios -->
    <script src='./scripts/menu_scripts.js'></script>
    <script src='./scripts/scripts.js'></script>
=======
    // <!-- Adicionando os Scripts -->
    echo "<script src='./scripts/menu_scripts.js'></script>
      <script src='./scripts/scripts.js'></script>
      <script src='./scripts/end_session.js'></script>";
    ?>

>>>>>>> Stashed changes
    <!-- Adicionando o Bootstrap ao final do corpo da página -->
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