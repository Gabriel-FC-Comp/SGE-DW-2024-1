// Variável para controlar o estado de cor (true: modo escuro, false: modo claro)
let corString = sessionStorage.getItem('cor');
var cor;
// var cor = false;
// Verifica se já está instanciada, se não instancia
if (corString !== null && corString !== undefined) {
  console.log('A variável existe no SessionStorage.');
  cor = JSON.parse(corString);

  // Se está no modo escuro, arruma a exibição
  if (cor) {
    mudar_cor(false);
    document.getElementById("colorModeSwitch").checked = true;
  }
} else {
  console.log('A variável não existe no SessionStorage.');
  cor = false;
  sessionStorage.setItem('cor', JSON.stringify(cor));
}

// Função para mudar a cor do tema
function mudar_cor(inverter_valor = true) {
  // Selecionando os elementos que serão afetados pela mudança de cor
  let text = $('.corTexto');
  let inputs = $('.form-control');
  let select = $('.form-select');
  let buttons = $('.degradeButton');
  let logo = $('#logo');
  let home = $('img[alt="home"]');
  let acessibilidade = $('img[alt="accessibility"]');
  let buttonsMenu = $('.buttonMenu');
  let listas = $('.div_list');
  let list_components = $('.scroll_component');
  let scrollBars = $('.scroll_div');
  let permit = $('.permit');
  let scrollHeaders = $('.scroll_header');
  let card = $('.card');  // Adicionando o card


  // Invertendo o valor da variável cor
  //cor = !cor;
  if (inverter_valor) {
    // Invertendo o valor da variável cor
    cor = !cor;
    sessionStorage.setItem('cor', JSON.stringify(cor));
  }

  if (cor) {
    // Aplicando estilo para modo escuro
    $('body').css('background', '#222222'); // Cor de fundo preta
    text.css('color', '#ededeb'); // Cor do texto branca

    // Adicionando classes para elementos específicos no modo escuro
    inputs.addClass('dark-mode');
    select.addClass('dark-mode');
    buttons.addClass('dark-mode');
    listas.addClass('dark-mode');
    list_components.addClass('dark-mode');
    scrollBars.addClass('dark-mode');
    scrollHeaders.addClass('dark-mode');
    buttonsMenu.addClass('dark-mode');
    permit.addClass('dark-mode');
    card.addClass('dark-mode');

    // Alterando imagens para modo escuro
    acessibilidade.attr('src', './imgs/accessibilityBranca.png');
    home.attr('src', './imgs/homeBranca.png');
    logo.attr('src', './imgs/logoBranca.png');

    console.log('Modo Escuro Ligado');

  } else {
    // Aplicando estilo para modo claro
    $('body').css('background', '#ededeb'); // Cor de fundo branca
    text.css('color', '#222222'); // Cor do texto preta

    // Removendo classes do modo escuro
    inputs.removeClass('dark-mode');
    select.removeClass('dark-mode');
    buttons.removeClass('dark-mode');
    listas.removeClass('dark-mode');
    list_components.removeClass('dark-mode');
    scrollBars.removeClass('dark-mode');
    scrollHeaders.removeClass('dark-mode');
    buttonsMenu.removeClass('dark-mode');
    permit.removeClass('dark-mode');
    card.removeClass('dark-mode');

    // Restaurando imagens originais
    acessibilidade.attr('src', './imgs/accessibilityPreta.png');
    home.attr('src', './imgs/homePreta.png');
    logo.attr('src', './imgs/logoPreta.png');

    console.log('Modo Escuro Desligado');
  }
}

// Adicionando evento de clique para o botão de mudança de cor
$("#colorModeSwitch").click(mudar_cor);

// Função para redirecionar para a página de menu (menu.php)
function redirect_menu() {
  window.location.href = "menu.php";
}

// Adicionando evento de clique para o logo do menu
if ($("#logoMenu").length > 0) {
  $("#logoMenu").click(redirect_menu);
}

// Função para abrir a modal de escolha de tamanho da fonte
function abrirModalFonte() {
  var botaoAcessibilidade = document.querySelector('#cabecalho button.btn');
  var modal = document.getElementById('modalFonte');
  var botaoPos = botaoAcessibilidade.getBoundingClientRect();

  modal.style.display = 'block';
  modal.style.top = (botaoPos.bottom + window.scrollY) + 'px';
  modal.style.left = (botaoPos.left + window.scrollX - (modal.offsetWidth / 2) + (botaoAcessibilidade.offsetWidth / 2)) + 'px';
}

// Função para fechar a modal de escolha de tamanho da fonte
function fecharModalFonte() {
  var modal = document.getElementById('modalFonte');
  modal.style.display = 'none';
}

// Função para alterar o tamanho da fonte com base no valor do controle deslizante
function alterarTamanhoFonte(valor) {
  var corpo = document.body;
  corpo.style.fontSize = valor + '%';
}

// Adiciona um listener de evento para o botão de acessibilidade
var botaoAcessibilidade = document.querySelector('#cabecalho button.btn');
botaoAcessibilidade.addEventListener('click', abrirModalFonte);