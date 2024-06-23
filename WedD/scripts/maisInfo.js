/*

Autores:
* Ana Carolina Ribeiro Miranda 
* Cristian Andre Sanches
* Gabriel Finger Conte
* Guilherme Henrique Soeiro Fontes
* Leonardo Fagote
* Rodrigo Badega de Oliveira

*/



$(document).ready(function() {

  // Quando o botão for clicado
  $('.buttonNovo.nome').click(function() {
    // Loop para criar várias faíscas de fogos de artifício
    for (var i = 0; i < 100; i++) {
      // Cria um novo elemento <div> com a classe .particle
      var particle = $('<div>').addClass('particle');
      // Adiciona a faísca ao contêiner de animação
      $('#animation-container').append(particle);

      // Define a posição inicial aleatória das faíscas
      var x = Math.random() * $(window).width(); // Posição horizontal aleatória na largura da janela
      var y = Math.random() * $(window).height(); // Posição vertical aleatória na altura da janela
      var color = getRandomColor(); // Função para obter uma cor aleatória
      particle.css({
        left: x, // Define a posição horizontal da faísca
        top: y, // Define a posição vertical da faísca
        backgroundColor: color, // Define a cor de fundo aleatória da faísca
        width: Math.random() * 8 + 4, // Define a largura aleatória da faísca entre 4px e 12px
        height: Math.random() * 8 + 4 // Define a altura aleatória da faísca entre 4px e 12px
      });

      // Animação da faísca, movendo-a para cima e em direções aleatórias
      particle.animate({
        top: 0, // Move a faísca para o topo da tela
        left: x + Math.random() * 500 - 250, // Move a faísca para uma direção horizontal aleatória
        opacity: 0 // Define a opacidade da faísca para 0, tornando-a invisível
      }, Math.random() * 3000 + 1000, 'linear', function() {
        $(this).remove(); // Remove a faísca após a animação ser concluída
      });
    }
  });
});

function getRandomColor() {
  // Paleta de cores (Verde, Azul, Amarelo, Vermelho, Rosa, Roxo))
  var colors = ['#4CAF50', '#2196F3', '#FFC107', 'FF0000', '#E91E63', '#9C27B0'];
  // Escolhe um índice aleatório da paleta
  var randomIndex = Math.floor(Math.random() * colors.length);
  // Retorna a cor correspondente ao índice aleatório
  return colors[randomIndex];
}

