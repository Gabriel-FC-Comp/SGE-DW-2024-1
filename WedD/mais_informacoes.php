<!-- 

Autores:
  * Ana Carolina Ribeiro Miranda 
  * Cristian Andre Sanches
  * Gabriel Finger Conte
  * Guilherme Henrique Soeiro Fontes
  * Leonardo Fagote
  * Rodrigo Badega de Oliveira

Descrição: 

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Adicionando o jQuery no Header -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Favicon na Aba do Navegador -->
    <link rel="icon" href="./favicon.ico" type="image/x-icon">

    <!-- Estilos personalizados da aplicação -->
    <link id="theme-style" rel="stylesheet" href="./css/style.css">
    <link id="more-info-theme-style" rel="stylesheet" href="./css/maisInformacoesStyle.css">
  </head>

  <body>

    <!-- Animação de Particulas -->
    <div id="animation-container" class="container mt-2"></div>

    <!-- Container principal do cabeçalho -->
    <div id="cabecalho" class="container">
      <div class="row align-items-center pt-4">
        <!-- Logo -->
        <div class="col-auto">
          <img id="logoMenu" src="./imgs/homePreta.png" class="img-fluid" width="100px" alt="home">
        </div>
        <!-- Título do Mais Informações -->
        <div class="col">
          <h1 class="mb-0 corTexto">Mais Informações</h1>
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

    <!-- Título principal da página -->
    <div class="text-center">
      <h1 class="corTexto" style="font-weight: bold;">Site desenvolvido por:</h1>
      <br>
    </div>

    <!-- Container dos botões com nomes e imagens -->
    <div class="container text-center align-items-center justify-content-center d-flex">

      <!-- Botão com o nome e imagem de Ana Carolina -->
      <button class="buttonNovo nome">
        <img src="./imgs/icons/Ana.png" class="img-fluid" alt="Ana">
        <span>Ana Carolina</span>
      </button>
      <br><br><br>

      <!-- Botão com o nome e imagem de Cristian Sanches -->
      <button class="buttonNovo nome">
        <img src="./imgs/icons/Cristian.png" class="img-fluid" alt="Cristian">
        <span>Cristian Sanches</span>
      </button>
      <br><br><br>

      <!-- Botão com o nome e imagem de Gabriel Finger -->
      <button class="buttonNovo nome">
        <img src="./imgs/icons/Gabriel.png" class="img-fluid" alt="Gabriel">
        <span> Gabriel Finger</span>
      </button>
    </div>

    <!-- Container dos botões com nomes e imagens -->
    <div class="container text-center align-items-center justify-content-center d-flex">

      <!-- Botão com o nome e imagem de Gabriel Finger -->
      <button class="buttonNovo nome">
        <img src="./imgs/icons/Guilherme.png" class="img-fluid" alt="Guilherme">
        <span> Guilherme Henrique</span>
      </button>
      <br><br><br>

      <!-- Botão com o nome e imagem de Leonardo Fagote -->
      <button class="buttonNovo nome">
        <img src="./imgs/icons/Leonardo.png" class="img-fluid" alt="Leonardo">
        <span> Leonardo Fagote</span>
      </button>
      <br><br><br>

      <!-- Botão com o nome e imagem de Leonardo Fagote -->
      <button class="buttonNovo nome">
        <img src="./imgs/icons/Rodrigo.png" class="img-fluid" alt="Rodrigo">
        <span> Rodrigo Badega</span>
      </button>
    </div>

    <!-- Adicionando os Scripts -->
    <script src="./scripts/scripts.js"></script>
    <script src="./scripts/maisInfo.js"></script>
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