<?php

// Inicia a sessão
session_start();
// Verifica se o usuário está conectado
if (!isset($_SESSION['user_connected']) || $_SESSION['user_connected'] === false) {
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SGE</title>
    <!-- Favicon na Aba do Navegador -->
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body>
    <!-- Container principal do cabeçalho -->
    <div id="cabecalho" class="container">
      <div class="row align-items-center pt-4">
        <!-- Logo -->
        <div class="col-auto">
          <img id="logo" src="./imgs/logoPreta.png" class="img-fluid" width="100px" alt="logo">
        </div>
        <!-- Título do Login -->
        <div class="col">
          <h1 class="mb-0 corTexto">Login</h1>
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
            <input type="range" min="50" max="200" value="100" class="slider" id="fontSlider" onchange="alterarTamanhoFonte(this.value)">
            <button class="close" onclick="fecharModalFonte()">&times;</button>
          </div>
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
    <!-- ---------------------------------------------------------------------- -->
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <form id="login_form" action="/validate_session" method="post">
                <div class="form-group mb-3">
                  <label for="username" class="corTexto">Usuário*</label>
                  <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                  <label for="password" class="corTexto">Senha*</label>
                  <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group mb-3 text-center">
                  <button type="submit" class="btn degradeButton rounded-pill">Entrar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Adicionando os Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./scripts/login.js"></script>
    <script src="./scripts/scripts.js"></script>
    <!-- Adicionando o Bootstrap no Body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>

  </html>

<?php

} else {
  header("Location: menu.php");
  exit;
}

?>