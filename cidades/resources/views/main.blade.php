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
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>SGE</title>

  <link rel="icon" href="{{ asset('favicon.ico') }}">

	<!-- Bootstrap local: -->
	<!-- <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}"> -->
	<!-- jQuery local: pasta public/js/ -->
	<script src="{{asset('js/jquery-3.7.1.js')}}"></script>

    <!-- jQuery remoto-->
	<!-- https://cdnjs.com/libraries/jquery-->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
-->

	<!-- Folha de estilos do Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
  <!-- Adiciona o Bootstrap ao cabeçalho da página -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Estilos personalizados da aplicação -->
  <link id="theme-style" rel="stylesheet" href="{{asset('css/style.css')}}">
  <link id="theme-style" rel="stylesheet" href="{{asset('css/menuStyle.css')}}">

</head>

<body>

  <!-- Container principal do cabeçalho -->
  <div id="cabecalho" class="container">
    <div class="row align-items-center pt-4">
      <!-- Logo -->
      <div class="col-auto">
        <img id="logo" src="{{asset('imgs/logoPreta.png')}}" class="img-fluid" width="100px" alt="logo">
      </div>
      <!-- Título do menu -->
      <div class="col">
        <h1 class="mb-0 corTexto">Menu</h1>
      </div>
      <!-- Botão de acessibilidade -->
      <div class="col-auto">
        <button class="btn">
          <img src="{{asset('imgs/accessibilityPreta.png')}}" class="img-fluid" width="30px" alt="accessibility">
        </button>
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

  <!-- Container dos botões de menu -->
  <div id="menu" class="container text-center align-items-center justify-content-center d-flex pt-3">
    <!-- Botão para a página de Cadastro de Produtos -->
    <button id="menu_cd_prod_btn" class="buttonMenu">
      <img src="{{asset('imgs/icons/cadastroProduto.png')}}" class="img-fluid" alt="Cadastro de Produto">
      <span class="">Cadastrar Produtos</span>
    </button>

    <!-- Botão para a página de Cadastro de Funcionários -->
    <button id="menu_cd_func_btn" class="buttonMenu">
      <img src="{{asset('imgs/icons/cadastroFuncionario.png')}}" class="img-fluid" alt="Cadastro de Funcionario">
      <span> Cadastrar Funcionários </span>
    </button>

    <!-- Botão para a página de Gerar Relatórios -->
    <button id="menu_gr_rel_btn" class="buttonMenu">
      <img src="{{asset('imgs/icons/gerarRelatorios.png')}}" class="img-fluid" alt="Gerar Relatorios">
      <span class="">Gerar Relatórios</span>
    </button>

    <!-- Botão para a página de Gerenciamento dos tipos de produtos -->
    <button id="menu_gc_prod_type_btn" class="buttonMenu">
      <img src="{{asset('imgs/icons/gerenciarTipos.png')}}" class="img-fluid" alt="Gerenciar Tipos de Produtos">
      <span class="">Tipos de Produtos</span>
    </button>

    <!-- Botão para a página de Ajustes de estoque -->
    <button id="menu_aj_estoq_btn" class="buttonMenu">
      <img src="{{asset('imgs/icons/ajusteEstoque.png')}}" class="img-fluid" alt="Ajuste de Estoque">
      <span class="">Ajustes de Estoque</span>
    </button>

    <!-- Botão para a página com mais informações -->
    <button id="menu_info" class="buttonMenu">
      <img src="{{asset('imgs/icons/sobre.png')}}" class="img-fluid" alt="Sobre">
      <span class="">Mais Informações</span>
    </button>

  </div>

  <!-- Cidades -->

  <div class="container" >
		<!-- Menu no topo da pagina -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{URL::to('/') }}">Cidades</a>
      <!-- Para o menu responsivo quando alterar as dimensoes -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
          </ul>
          
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal-search" >Search</button>
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal-add-city" >Add City</button>
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal-remove-city" >Remove City</button>

        </div>
      </div>
    </nav>

		<!-- Conteudo principal da pagina-->
		<table class="table">
			<tr>
				<th>Código</th>
				<th>Cidade</th>
				<th>Estado</th>
			</tr>
            <!-- Linhas da tabela-->
			@foreach($cidades as $cidade)
			<tr>
				<td>{{$cidade->codigo}}</td>
				<td>{{$cidade->nome}}</td>
				<td>{{$cidade->sigla_estado}}</td>
			</tr>
			@endforeach
		</table>

		<!-- Rodape de acesso as paginas-->
		<div class="row">
            <div class="col-sm-12 text-center">
				<nav><?php echo $cidades->render(); ?></nav>
			</div>
		</div>

		<!-- Janela modal com as opcoes de pesquisa-->
		<div id="modal-search" class="modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<input id="search-val" type="input" class="form-control" placeholder="Nome da cidade...">
					
						<!-- Botoes de radio para tipo de pesquisa-->
						<div class="radio">
                           	<label>
							<input id="opt0" type="radio" name="search-type" value="0" checked>Exatamente</label>
						</div>
						<div class="radio">
                           	<label>
							<input id="opt1" type="radio" name="search-type" value="1" checked>Inicia com</label>
						</div>
						<div class="radio">
                           	<label>
							<input id="opt2" type="radio" name="search-type" value="2" checked>Contém</label>
						</div>
					</div>
					<div class="modal-footer">
							<button id="btn-search" class="btn btn-primary" data-dismiss="modal">Pesquisar</button>
					</div>
				</div>
			</div>
		</div>

    <!-- Janela modal com as opcoes de add cidade-->
		<div id="modal-add-city" class="modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<p>Adicinando uma nova Cidade</p>
					</div>
					<form id="add-city-form" action="/cidades/add" method="POST">
					<div class="modal-body">
							<label>Sigla do Estado:</label>
							<input id="add-city-state" type="text" class="form-control" name="city_state" placeholder="Ex: PR" required>
							<label>Nome da Cidade:</label>
							<input id="add-city-name" type="text" class="form-control" name="city_name" placeholder="Ex: Apucarana" required>
							<label>Codigo:</label>
							<input id="add-city-code" type="number" class="form-control" name="city_code" placeholder="Ex: 00033" required>
					</div>
					<div class="modal-footer">
						<button type="submit" id="btn-add-city" class="btn btn-primary" data-dismiss="modal">Adicionar Cidade</button>
					</div>
					</form>
				</div>
			</div>
		</div>

    <!-- Janela modal com as opcoes de remover cidade-->
		<div id="modal-remove-city" class="modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<p>Removendo uma nova Cidade</p>
					</div>
					<form id="rmv-city-form">
					<div class="modal-body">
						<label>Nome da Cidade:</label><input id="remove-city-name" type="text" class="form-control" placeholder="Ex: Apucarana" required>
					</div>
					<div class="modal-footer">
						<button type="submit" id="btn-remove-city" class="btn btn-primary" data-dismiss="modal">Remover Cidade</button>
					</div>
					</form>
				</div>
			</div>
		</div>

		<!-- JavaScript para converter a opcao de pesquisa em um link -->
		<script>
			$(function(){
				$("#btn-search").click(function(){
					var val = $("#search-val").val();
					if(val.length==0)
						val = "*";

						//Chamar metodo do controller
						window.location.assign("http://129.148.36.100/cidades/public/index.php/cidades/" +
							$("input[name=search-type]:checked").val()+
							"/" + val + "/search"
						
						);
				});
			});

			$(function() {
				// Intercepta o evento de submissão do formulário
				$("#add-city-form").on('submit', function(e) {
					e.preventDefault(); // Impede o envio do formulário de forma síncrona

					// Obtém o token CSRF do meta tag no HTML
					var csrfToken = $('meta[name="csrf-token"]').attr('content');

					// Obtém os dados do formulário
					var formData = $(this).serialize();

					// Adiciona o token CSRF aos dados do formulário
					formData += '&_token=' + csrfToken;

					// Fazer a chamada assíncrona para adicionar cidade
					$.post('/cidades/add', formData, function(response) {
						console.log(response);
						alert("Cidade adicionada com sucesso!");
						// Atualize sua lista de cidades ou faça outras ações necessárias
					});

					// Impedir o envio do formulário padrão
					return false;
				});
			});


			$(async function() {
				// Captura o evento de submissão do formulário
				$("#rmv-city-form").on('submit', function(e) {
					e.preventDefault(); // Impede o envio do formulário de forma síncrona

					// Obtém o token CSRF do meta tag no HTML
					var csrfToken = $('meta[name="csrf-token"]').attr('content');

					var val = $("#remove-city-name").val();
					if (val.length == 0) val = "*";

					// Fazer a chamada assíncrona para remover cidade
					$.post('/cidades/rmv', {
						_token: csrfToken,
						city_name: val
					}, function(response) {
						// Lidar com a resposta da API aqui
						console.log(response);
						alert(response.message); // Exemplo de exibir uma mensagem de retorno
					});

					// Impedir o envio do formulário padrão
					return false;
				});
			});


		</script>
		
	</div>

  <!-- Adicionando os Scripts -->
  <script src="{{asset('scripts/menu_scripts.js')}}"></script>
  <script src="{{asset('scripts/scripts.js')}}"></script>

  <!-- Adicionando o Bootstrap ao final do corpo da página -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>