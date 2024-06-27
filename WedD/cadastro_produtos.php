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
        <!-- Título do Cadastro de Produtos -->
        <div class="col">
          <h1 class="mb-0 corTexto">Cadastro de Produtos</h1>
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

        <<<<<<< Updated upstream=======<script src="./scripts/end_session.js">
          </script>
          >>>>>>> Stashed changes
          <!-- Switch para alternar o modo de cor -->
          <div class="col-auto">
            <div class="form-check form-switch">
              <input id="colorModeSwitch" class="form-check-input" type="checkbox" role="switch">
              <label class="form-check-label" for="colorModeSwitch"></label>
            </div>
          </div>
      </div>
    </div>

    <div class="container mt-5 pt-4">
      <!-- Formulário para entrada de dados sobre o produto -->
      <form id="cad_prod_form" action="/cad_prod" method="post">
        <div class="row align-items-left">
          <!-- Campo para ID -->
          <div class="col-auto mb-3">
            <p class="corTexto">Código Produto*</p>
            <input id="prod_id_inp" name="prod_id" type="number" class="form-control" required>
          </div>

          <!-- Campo para Nome do Produto -->
          <div class="col-auto mb-3">
            <p class="corTexto">Nome do Produto*</p>
            <input id="prod_name_inp" name="prod_name" type="text" class="form-control" required>
          </div>

          <!-- Campo para Tipo do Produto -->
          <div class="col-auto mb-3">
            <p class="corTexto">Tipo do Produto*</p>
            <select id="prod_type_inp" name="prod_type" class="form-select" required>
              <option value="" selected>Selecione um tipo</option>
              <?php

              // Inclui o arquivo db_access.php e obtém a conexão com o banco de dados
              $conn = require_once './scripts/db_access.php';

              // Busca os tipos de produtos no BD
              $prod_types = $conn->query("SELECT * FROM tipos_produto");

              // Se encontrou algum, coloca na lista
              if ($prod_types->num_rows > 0) {
                // Exibir os dados retornados
                $element_first_part = "<option value=\"";
                $element_second_part = "\">";
                $element_last_part = "</option>";

                while ($row = $prod_types->fetch_assoc()) {
                  if ($row["tipo_produto"] != "") {
                    echo $element_first_part . $row["tipo_produto"] . $element_second_part . $row["tipo_produto"] . $element_last_part;
                  }
                }
              }

              // Fecha a conexão com o banco de dados
              $conn->close();
              ?>
            </select>
          </div>
        </div>

        <div class="row align-items-left mt-2">
          <!-- Campo para Custo -->
          <div class="col-auto mb-3">
            <p class="corTexto">Custo*</p>
            <input id="prod_cost_inp" name="prod_cost" type="text" class="form-control" required>
          </div>

          <!-- Campo para Modelo -->
          <div class="col-auto mb-3">
            <p class="corTexto">Modelo*</p>
            <input id="prod_model_inp" name="prod_model" type="text" class="form-control" required>
          </div>
        </div>

        <div class="row align-items-left mt-2">
          <!-- Campo para Código de Barras -->
          <div class="col-auto">
            <p class="corTexto">Codigo de Barras*</p>
            <input id="prod_barcode_inp" name="prod_barcode" type="text" class="form-control" required>
          </div>
        </div>

        <div class="row align-items-left mt-5 pt-5">
          <!-- Botão para Salvar -->
          <div class="col-auto">
            <button type="submit" class="rounded-pill degradeButton">Salvar Produto</button>
          </div>

          <!-- Botão para Limpar -->
          <div class="col-auto">
            <button type="reset" class="rounded-pill degradeButton">Limpar Campos</button>
          </div>

          <!-- Botão para Excluir Produto -->
          <div class="col-auto">
            <button id="delet_prod_button" type="button" class="rounded-pill degradeButton">Excluir Produto</button>
          </div>

        </div>

      </form>
    </div>

    <!-- Adicionando os Scripts -->
    <script src="./scripts/scripts.js"></script>
    <script src="./scripts/mascaras.js"></script>
    <script src="./scripts/cadastro_prod.js"></script>
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