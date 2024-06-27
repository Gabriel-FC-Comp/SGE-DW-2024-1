<!-- 

Autores:
  * Ana Carolina Ribeiro Miranda 
  * Cristian Andre Sanches
  * Gabriel Finger Conte
  * Leonardo Fagote

-->


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
      <!-- Título do Gerador de Relatórios -->
      <div class="col">
        <h1 class="mb-0 corTexto">Gerador de Relatórios</h1>
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
<<<<<<< HEAD
        </form>
      </div>

      <!-- Switch para alternar o modo de cor -->
      <div class="col-auto">
        <div class="form-check form-switch">
          <input id="colorModeSwitch" class="form-check-input" type="checkbox" role="switch">
          <label class="form-check-label" for="colorModeSwitch"></label>
=======
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
>>>>>>> 601769f7875b0c0894778218c52982bb357d4618
        </div>
      </div>
    </div>
  </div>

  <div class="container pt-5">

    <!-- Formulário para entrada de dados -->
    <form id="gera_rel_form" method="post">
      <div class="row align-items-left">
        <!-- Seleção de tipo de relatório -->
        <div class="col-auto pb-3">
          <p class="corTexto">Tipo do Relatório*</p>
          <select id="rel_type_select" name="rel_type" class="form-select" required>
            <option value="" selected>Selecione um tipo</option>
            <option value="Entrada">Entradas</option>
            <option value="Saída">Saídas</option>
          </select>
        </div>

        <!-- Entrada da data inicial -->
        <div class="col-auto pb-3">
          <p class="corTexto">Inicial*</p>
          <input id="data_inicial_rel_inp" name="data_inicial_rel" type="date" class="form-control" required>
        </div>

        <!-- Entrada da data final -->
        <div class="col-auto pb-3">
          <p class="corTexto">Data Final*</p>
          <input id="data_final_rel_inp" name="data_final_rel" type="date" class="form-control" required>
        </div>

        <!-- Botão para redefinir inputs -->
        <div class="col-auto pt-4 pb-5">
          <button type="reset" class="rounded-pill degradeButton">Redefinir</button>
        </div>
      </div>

      <!-- Lista de componentes -->
      <div class="row div_list py-4 px-3 rounded-5">
        <div id="component_list" class="scroll_div bg-transparent overflow-y-scroll pe-4">

        </div>
      </div>

      <!-- Botões para gerar e exportar relatório -->
      <div class="row align-items-left pt-4">
        <div class="col-auto pt-4">
          <button id="gen_rel_btn" type="submit" class="rounded-pill degradeButton">Gerar Relatório</button>
        </div>

        <div class="col-auto pt-4 pb-5">
          <button id="exp_rel_btn" type="button" class="rounded-pill degradeButton">Exportar Relatório</button>
        </div>
      </div>
    </form>

  </div>

  <!-- Adicionando os Scripts -->
  <script src="./scripts/scripts.js"></script>
  <script src="./scripts/gera_rel.js"></script>
  <!-- Adicionando o Bootstrap no Body -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>