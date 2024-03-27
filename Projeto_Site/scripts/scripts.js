var cor = false;

function mudar_cor() {
  // var swit = document.getElementById('colorModeSwitch');
  var text = document.querySelectorAll('.corTexto');
  var inputs = document.querySelectorAll('.form-control');
  var select = document.querySelectorAll('.form-select');
  var buttons = document.querySelectorAll('.degradeButton');

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

    // Altera as imagens quando o switch é ligado
    document.querySelector('img[alt="home"]').src = "./imgs/homeBranca.png";
    document.querySelector('img[alt="accessibility-central"]').src = "./imgs/accessibilityBranca.png";

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

    // Restaura as imagens originais quando o switch é desligado
    document.querySelector('img[alt="home"]').src = "./imgs/homePreta.png";
    document.querySelector('img[alt="accessibility-central"]').src = "./imgs/accessibilityPreto.png";
    // verificar no console
    console.log('Desligado')
  }
}

document.getElementById("colorModeSwitch").addEventListener("click", mudar_cor, false);

// Máscara do Custo
document.addEventListener('DOMContentLoaded', function() {

  let custo = document.getElementById('custoProduto');
  if (custo) {
    custo.addEventListener('input', function() {
      // Remove caracteres não numéricos do valor do campo
      this.value = this.value.replace(/\D/g, '');
      // Inicializa a variável que conterá o valor formatado
      var valorFormatado = '';
      // Obtém o valor do campo e remove espaços em branco
      var valor = this.value.trim();
      // Obtém o comprimento do valor atual do campo
      var comprimentoValor = valor.length;
      // Verifica se o valor possui mais de 2 caracteres
      if (comprimentoValor > 2) {
        // Adiciona uma vírgula após os dois primeiros dígitos
        valorFormatado = valor.substring(0, comprimentoValor - 2) + ',' + valor.substring(comprimentoValor - 2);
      } else {
        // Caso contrário, o valor formatado é o mesmo que o valor atual
        valorFormatado = valor;
      }
      // Atualiza o valor do campo com o valor formatado
      this.value = valorFormatado;
    });
  }
});


// Função para o botão de redirecionamento da página menu (index)
function redirect_menu() {
  window.location.href = "index.html";
}

// Adiciona função de redirecionamento da página menu
document.getElementById("menu").addEventListener(
  "click", redirect_menu, false
);
