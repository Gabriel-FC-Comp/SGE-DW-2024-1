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
  </head>

  <body>

    <!-- Container principal do cabeçalho -->
    <div id="cabecalho" class="container">
      <div class="row align-items-center pt-4">
        <!-- Logo -->
        <div class="col-auto">
          <img id="logoMenu" src="./imgs/homePreta.png" class="img-fluid" width="100px" alt="home">
        </div>
        <!-- Título do Gerenciador de Tipo de Produtos -->
        <div class="col">
          <h1 class="mb-0 corTexto">Gerenciador de Tipo de Produtos</h1>
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

    <!-- Container principal do conteúdo -->
    <div class="container pt-4">

      <!-- Seção de entrada de dados -->
      <div class="row align-items-center ">
        <!-- Inicia o formulário para adição o tipo de produto -->
        <div class="row justify-content-center text-center">
          <div class="col-auto">
            <!-- Campo de entrada para o tipo a ser inserido/excluído -->
            <p class="corTexto">Nome do tipo:*</p>
            <input id="prod_type_inp" type="text" class="form-control">
          </div>
        </div>

        <!-- Botões para adicionar e excluir tipos de produtos -->
        <div class="row justify-content-center py-4">
          <div class="col-auto">
            <button id="add_type_btn" type="button" class="rounded-pill degradeButton">Adicionar</button>
          </div>
          <div class="col-auto">
            <button id="rmv_type_btn" type="button" class="rounded-pill degradeButton">Excluir</button>
          </div>
        </div>
      </div>


      <!-- Lista de tipos de produtos -->
      <div class="row div_list py-4 px-3 rounded-5">
        <div id="component_list" class="scroll_div bg-transparent overflow-y-scroll pe-4">
          <!-- Aqui serão listados os tipos de produtos -->
          <?php
          // Inclui o arquivo db_access.php e obtém a conexão com o banco de dados
          $conn = require_once './scripts/db_access.php';

          // Busca os tipos de produtos no BD
          $prod_types = $conn->query("SELECT * FROM tipos_produto");

          // Se encontrou algum, coloca na lista
          if ($prod_types->num_rows > 0) {
            // Exibir os dados retornados
            $element_first_part = "<div class=\"scroll_component rounded-5 ps-3 my-2 \" id=\"";
            $element_second_part = "\">\n<p class=\"corTexto bg-transparent\">";
            $element_last_part = "</p>\n</div>";

            while ($row = $prod_types->fetch_assoc()) {
              if ($row["tipo_produto"] != "") {
                echo $element_first_part . "type_" . $row["tipo_produto"] . $element_second_part . $row["tipo_produto"] . $element_last_part;
              }
            }
          }

          // Fecha a conexão com o banco de dados
          $conn->close();

          ?>
        </div>
      </div>

      <!-- Botão para salvar alterações -->
      <div class="row align-items-center justify-content-center py-5">
        <div class="col-auto">
          <button id="save_type_change_btn" class="rounded-pill degradeButton">Salvar Alterações</button>
        </div>
      </div>

    </div>

    <!-- Adicionando os Scripts -->
    <script src="./scripts/scripts.js"></script>
    <script src="./scripts/gerenc_tipos.js"></script>
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