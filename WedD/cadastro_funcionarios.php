<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está conectado
if (isset($_SESSION['user_connected']) && $_SESSION['user_connected'] === true) {
  // Verifica se o formulário foi enviado
  /*
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Conexão com o banco de dados
      $servername = "localhost";
      $username = "usuario";
      $password = "senha";
      $dbname = "db_sge";

      // Cria uma conexão
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Verifica a conexão
      if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
      }

      // Prepara os dados para inserção no banco de dados
      $cpf = $_POST['cpf_func'];
      $nome = $_POST['func_name'];
      $senha = $_POST['func_password'];
      $permissao_cadastro_func = isset($_POST['checkCadastroFuncionario']) ? 1 : 0;
      $permissao_cadastro_prod = isset($_POST['checkCadastroProdutos']) ? 1 : 0;
      $permissao_gerar_rel = isset($_POST['checkGerarRelatorios']) ? 1 : 0;
      $permissao_ajuste_estoque_compras = isset($_POST['checkCompras']) ? 1 : 0;
      $permissao_ajuste_estoque_vendas = isset($_POST['checkVendas']) ? 1 : 0;
      $permissao_ajuste_estoque_ajuste = isset($_POST['checkCorrecao']) ? 1 : 0;
      $permissao_mudar_permissoes = isset($_POST['checkPermissoesFunc']) ? 1 : 0;

      $check = "SELECT * FROM funcionario WHERE cpf_funcionario =$cpf";
      if ($conn->query($check) === TRUE) {
        echo "Funcionário encontrado. Atualizando Dados...";
        $sql = "UPDATE funcionarios SET (nome_funcionario, permissao_cadastro_func, permissao_cadastro_prod, permissao_gerar_rel, permissao_ajuste_estoque_compras, permissao_ajuste_estoque_vendas, permissao_ajuste_estoque_ajuste, permissao_mudar_permissoes) = ('$nome', '$permissao_cadastro_func', '$permissao_cadastro_prod', '$permissao_gerar_rel', '$permissao_ajuste_estoque_compras', '$permissao_ajuste_estoque_vendas', '$permissao_ajuste_estoque_ajuste', '$permissao_mudar_permissoes') WHERE cpf_funcionario=$cpf";  

      } else {
        // Query SQL para inserir os dados na tabela de funcionários
        echo "Novo funcionário. Inserindo...";
        $sql = "INSERT INTO funcionarios (cpf_funcionario, nome_funcionario, senha_funcionario, permissao_cadastro_func, permissao_cadastro_prod, permissao_gerar_rel, permissao_ajuste_estoque_compras, permissao_ajuste_estoque_vendas, permissao_ajuste_estoque_ajuste, permissao_mudar_permissoes) VALUES ('$cpf', '$nome', '$senha', '$permissao_cadastro_func', '$permissao_cadastro_prod', '$permissao_gerar_rel', '$permissao_ajuste_estoque_compras', '$permissao_ajuste_estoque_vendas', '$permissao_ajuste_estoque_ajuste', '$permissao_mudar_permissoes')";

      }


      // Executa a query
      if ($conn->query($sql) === TRUE) {
        echo "Ação realizada com Sucesso!";
      } else {
        echo "Erro ao realizar ação: " . $conn->error;
      }

      // Fecha a conexão com o banco de dados
      $conn->close();
    }
    */

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
        <!-- Título do Cadastro de Funcionários -->
        <div class="col">
          <h1 class="mb-0 corTexto">Cadastro de Funcionários</h1>
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
          <form action="end_session.php" method="POST">
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

      <!-- Formulário para pegar as informações do funcionário e suas permissões -->
      <form id="cad_func_form" action="./scripts/cadastra_func.php" method="post">
        <div class="row align-items-left">
          <!-- Input para CPF -->
          <div class="col-auto">
            <p class="corTexto">CPF*</p>
            <input id="cpf_func_inp" name="cpf_func" type="text" class="form-control" required>
          </div>

          <!-- Input para Nome Completo -->
          <div class="col-auto">
            <p class="corTexto">Nome Completo*</p>
            <input id="func_name_inp" name="func_name" type="text" class="form-control" required>
          </div>

          <!-- Input para Senha -->
          <div class="col-auto">
            <p class="corTexto">Senha*</p>
            <input id="func_password_inp" name="func_password" type="password" class="form-control" required>
          </div>
        </div>

        <div class="row align-items-left pt-3 mt-5 permit rounded-5 ">
          <div class="row align-items-left bg-transparent ms-1">
            <p class="custom-label222 corTexto">Permissões</p>
          </div>
          <!-- Checkbox para permissões -->
          <div class="col-auto ms-3">
            <!-- Checkbox para Cadastro de Funcionário -->
            <div class="custom-checkbox">
              <input id="checkCadastroFuncionario" name="check_cad_func" type="checkbox">
              <label class="corTexto" for="checkCadastroFuncionario">Cadastro Funcionário</label>
            </div>
            <!-- Checkbox para Cadastro de Produtos -->
            <div class="custom-checkbox">
              <input id="checkCadastroProdutos" name="check_cad_prod" type="checkbox">
              <label class="corTexto" for="checkCadastroProdutos">Cadastro Produtos</label>
            </div>
            <!-- Checkbox para Gerar Relatórios -->
            <div class="custom-checkbox">
              <input id="checkGerarRelatorios" name="check_gen_rel" type="checkbox">
              <label class="corTexto" for="checkGerarRelatorios">Gerar Relatórios</label>
            </div>
            <!-- Checkbox adicional -->
            <div class="custom-checkbox">
              <input id="checkPermissoesFunc" name="check_permiss_func" type="checkbox">
              <label class="corTexto" for="checkPermissoesFunc">Permissões dos Funcionários</label>
            </div>
          </div>

          <!-- Outro conjunto de checkboxes -->
          <div class="col-auto ms-4">
            <!-- Checkbox para Ajuste de Estoque -->
            <div class="custom-checkbox">
              <input id="checkAjuste" name="check_ajust_estoq" type="checkbox">
              <label class="corTexto" for="checkAjuste">Ajuste de Estoque:</label>
            </div>
            <!-- Checkbox para Compras -->
            <div class="custom-checkbox ps-4">
              <input id="checkCompras" name="check_ajust_compras" type="checkbox">
              <label class="corTexto" for="checkCompras">Compras</label>
            </div>
            <!-- Checkbox para Vendas -->
            <div class="custom-checkbox ps-4">
              <input id="checkVendas" name="check_ajust_vendas" type="checkbox">
              <label class="corTexto" for="checkVendas">Vendas</label>
            </div>
            <!-- Checkbox adicional -->
            <div class="custom-checkbox ps-4">
              <input id="checkCorrecao" name="check_ajust_correcoes" type="checkbox">
              <label class="corTexto" for="checkCorrecao">Correção de Estoque</label>
            </div>
            <br><br><br>
          </div>

          <!-- Botão para redefinir permissões -->
          <div class="position-relative">
            <button id="redfine_func_perm_btn" type="button" class="rounded-pill degradeButton position-absolute bottom-0 end-0 m-3">Redefinir Permissões</button>
          </div>
        </div>

        <div class="row align-items-left mt-5">
          <!-- Botão para salvar informações do funcionário -->
          <div class="col-auto">
            <button type="submit" class="rounded-pill degradeButton end-0 m-3" type="submit">Salvar Funcionário</button>
          </div>

          <!-- Botão para excluir funcionário -->
          <div class="col-auto">
            <button id="delet_func_btn" type="button" class="rounded-pill degradeButton end-0 m-3">Excluir
              Funcionário</button>
          </div>
        </div>

      </form>
    </div>

    <!-- Adicionando os Scripts -->
    <script src="./scripts/scripts.js"></script>
    <script src="./scripts/gerenc_funci.js"></script>
    <script src="./scripts/mascaras.js"></script>
    <script src="./scripts/end_session.js"></script>
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