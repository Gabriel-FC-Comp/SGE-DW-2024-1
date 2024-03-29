var cor = false;

function mudar_cor() {
  // var swit = document.getElementById('colorModeSwitch');
  let text = document.querySelectorAll('.corTexto');
  let inputs = document.querySelectorAll('.form-control');
  let select = document.querySelectorAll('.form-select');
  let buttons = document.querySelectorAll('.degradeButton');
  let logo = document.getElementById('logo');
  let home = document.querySelector('img[alt="home"]');
  let acessibilidade = document.querySelector('img[alt="accessibility"]')
  let buttonsMenu = document.querySelectorAll('.buttonMenu');
  let listas = document.querySelectorAll('.div_list');
  let list_components = document.querySelectorAll('.scroll_component');
  let scrollBars = document.querySelectorAll('.scroll_div');
  let permit = document.querySelector('.permit');
  let scrollHeaders = document.querySelectorAll('.scroll_header');
  
  cor = !cor; // Inverte o valor atual

  if (cor) {
    // Mudar a cor para preto
    document.body.style.background = '#222222';

    // Mudar a cor letra para branco
    for (let i = 0; i < text.length; i++) {
      text[i].style.color = '#ededeb';
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
    listas.forEach(function(lista) {
      lista.classList.add('dark-mode');
    })
    list_components.forEach(function(list_component) {
      list_component.classList.add('dark-mode');
    })
    scrollBars.forEach(function(scrollBar) {
      scrollBar.classList.add('dark-mode');
    })
    scrollHeaders.forEach(function(scrollHeader) {
      scrollHeader.classList.add('dark-mode');
    })
    if (buttonsMenu) buttonsMenu.forEach(function(button) {
      button.classList.toggle('dark-mode');
    });
    if (permit) permit.classList.add('dark-mode');

    // Altera as imagens quando o switch é ligado
    if (acessibilidade) acessibilidade.src = "../imgs/accessibilityBranca.png"
    if (home) home.src = "../imgs/homeBranca.png";
    if (logo) logo.src = "../imgs/logoBranca.png";

    // Verificar no console
    console.log('Ligado');

  } else {
    // Mudar a cor para branco
    document.body.style.background = '#ededeb';

    // Mudar a cor letra para preto 
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

    listas.forEach(function(lista) {
      lista.classList.remove('dark-mode');
    })
    list_components.forEach(function(list_component) {
      list_component.classList.remove('dark-mode');
    })
    scrollBars.forEach(function(scrollBar) {
      scrollBar.classList.remove('dark-mode');
    })
    scrollHeaders.forEach(function(scrollHeader) {
      scrollHeader.classList.remove('dark-mode');
    })
    if (buttonsMenu) buttonsMenu.forEach(function(button) {
      button.classList.remove('dark-mode');
    });

    if (permit) permit.classList.remove('dark-mode');

    // Restaura as imagens originais quando o switch é desligado
    if (acessibilidade) acessibilidade.src = "../imgs/accessibilityPreta.png"
    if (home) home.src = "../imgs/homePreta.png";
    if (logo) logo.src = "../imgs/logoPreta.png";
    // Verificar no console
    console.log('Desligado')
  }
}

document.getElementById("colorModeSwitch").addEventListener(
  "click", mudar_cor, false
);

// Função para o botão de redirecionamento da página menu (index)
function redirect_menu() {
  window.location.href = "index.html";
}

// Adiciona função de redirecionamento da página menu
if (document.getElementById("logoMenu")) {
  document.getElementById("logoMenu").addEventListener("click", redirect_menu, false);
}


