// Variável para controlar o estado de cor (true: modo escuro, false: modo claro)
var cor = false;

// Função para mudar a cor do tema
function mudar_cor() {
  // Selecionando os elementos que serão afetados pela mudança de cor
  let text = document.querySelectorAll('.corTexto');
  let inputs = document.querySelectorAll('.form-control');
  let select = document.querySelectorAll('.form-select');
  let buttons = document.querySelectorAll('.degradeButton');
  let logo = document.getElementById('logo');
  let home = document.querySelector('img[alt="home"]');
  let acessibilidade = document.querySelector('img[alt="accessibility"]');
  let buttonsMenu = document.querySelectorAll('.buttonMenu');
  let listas = document.querySelectorAll('.div_list');
  let list_components = document.querySelectorAll('.scroll_component');
  let scrollBars = document.querySelectorAll('.scroll_div');
  let permit = document.querySelector('.permit');
  let scrollHeaders = document.querySelectorAll('.scroll_header');

  // Invertendo o valor da variável cor
  cor = !cor;

  if (cor) {
    // Aplicando estilo para modo escuro
    document.body.style.background = '#222222'; // Cor de fundo preta
    text.forEach(function(item) {
      item.style.color = '#ededeb'; // Cor do texto branca
    });

    // Adicionando classes para elementos específicos no modo escuro
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
    });
    list_components.forEach(function(list_component) {
      list_component.classList.add('dark-mode');
    });
    scrollBars.forEach(function(scrollBar) {
      scrollBar.classList.add('dark-mode');
    });
    scrollHeaders.forEach(function(scrollHeader) {
      scrollHeader.classList.add('dark-mode');
    });
    if (buttonsMenu) {
      buttonsMenu.forEach(function(button) {
        button.classList.toggle('dark-mode');
      });
    }
    if (permit) {
      permit.classList.add('dark-mode');
    }

    // Alterando imagens para modo escuro
    if (acessibilidade) {
      acessibilidade.src = "./imgs/accessibilityBranca.png";
    }
    if (home) {
      home.src = "./imgs/homeBranca.png";
    }
    if (logo) {
      logo.src = "./imgs/logoBranca.png";
    }

    console.log('Modo Escuro Ligado');

  } else {
    // Aplicando estilo para modo claro
    document.body.style.background = '#ededeb'; // Cor de fundo branca
    text.forEach(function(item) {
      item.style.color = '#222222'; // Cor do texto preta
    });

    // Removendo classes do modo escuro
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
    });
    list_components.forEach(function(list_component) {
      list_component.classList.remove('dark-mode');
    });
    scrollBars.forEach(function(scrollBar) {
      scrollBar.classList.remove('dark-mode');
    });
    scrollHeaders.forEach(function(scrollHeader) {
      scrollHeader.classList.remove('dark-mode');
    });
    if (buttonsMenu) {
      buttonsMenu.forEach(function(button) {
        button.classList.remove('dark-mode');
      });
    }
    if (permit) {
      permit.classList.remove('dark-mode');
    }

    // Restaurando imagens originais
    if (acessibilidade) {
      acessibilidade.src = "./imgs/accessibilityPreta.png";
    }
    if (home) {
      home.src = "./imgs/homePreta.png";
    }
    if (logo) {
      logo.src = "./imgs/logoPreta.png";
    }

    console.log('Modo Escuro Desligado');
  }
}

// Adicionando evento de clique para o botão de mudança de cor
document.getElementById("colorModeSwitch").addEventListener(
  "click", mudar_cor, false
);

// Função para redirecionar para a página de menu (index.html)
function redirect_menu() {
  window.location.href = "index.html";
}

// Adicionando evento de clique para o logo do menu (index)
if (document.getElementById("logoMenu")) {
  document.getElementById("logoMenu").addEventListener("click", redirect_menu, false);
}
