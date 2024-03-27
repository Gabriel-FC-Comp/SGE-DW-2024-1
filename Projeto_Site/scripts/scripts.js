var cor = false;

function mudar_cor() {
  // var swit = document.getElementById('colorModeSwitch');
  var text = document.querySelectorAll('.corTexto');
  var inputs = document.querySelectorAll('.form-control');
  var select = document.querySelectorAll('.form-select');
  var buttons = document.querySelectorAll('.degradeButton');
  var logo = document.getElementById('menu');
  var home = document.querySelector('img[alt="home"]');
  var acessibilidade = document.querySelector('img[alt="accessibility"]')
  var buttonsMenu = document.querySelectorAll('.buttonMenu');

  cor = !cor; // Inverte o valor atual

  if (cor) {
    // mudar a cor para preto
    document.body.style.background = 'black';
    // mudar a cor letra para branco
    for (let i = 0; i < text.length; i++) {
      text[i].style.color = '#ffffff';
    }

    // Se o switch está ativado, aplica o modo noturno
    inputs.forEach(function(input) {
      input.classList.add('dark-mode');
    });
    select.forEach(function(select) {
      select.classList.add('dark-mode');
    });
    buttons.forEach(function(button) {
      button.classList.toggle('dark-mode');
    });
    if (buttonsMenu) buttonsMenu.forEach(function(button) {
      button.classList.toggle('dark-mode');
    });

    // Altera as imagens quando o switch é ligado
    if (acessibilidade) acessibilidade.src = "../imgs/accessibilityBranca.png"
    if (home) home.src = "../imgs/homeBranca.png";
    if (logo) logo.src = "../imgs/logoBranca.png";

    // verificar no console
    console.log('Ligado')

  } else {
    // mudar a cor para branco
    document.body.style.background = '#ededeb';

    // mudar a cor letra para preto 
    for (let i = 0; i < text.length; i++) {
      text[i].style.color = '#222222';
    }

    // Se o switch está desativado, remove o modo noturno
    inputs.forEach(function(input) {
      input.classList.remove('dark-mode');
    });
    select.forEach(function(select) {
      select.classList.remove('dark-mode');
    });
    buttons.forEach(function(button) {
      button.classList.remove('dark-mode');
    });
    if (buttonsMenu) buttonsMenu.forEach(function(button) {
      button.classList.remove('dark-mode');
    });

    // Restaura as imagens originais quando o switch é desligado
    if (acessibilidade) acessibilidade.src = "../imgs/accessibilityPreta.png"
    if (home) home.src = "../imgs/homePreta.png";
    if (logo) logo.src = "../imgs/logoPreta.png";
    // verificar no console
    console.log('Desligado')
  }
}

document.getElementById("colorModeSwitch").addEventListener("click", mudar_cor, false);

// Função para o botão de redirecionamento da página menu (index)
function redirect_menu() {
  window.location.href = "index.html";
}

// Adiciona função de redirecionamento da página menu
document.getElementById("home").addEventListener(
  "click", redirect_menu, false
);




