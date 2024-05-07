# [SGE-DW-2024-1](https://github.com/Gabriel-FC-Comp/SGE-DW-2024-1)
Sistema de Gerenciamento de Estoque (SGE) desenvolvido como proposta de projeto para a disciplina de Desenvolvimento Web, período de 2024-1, na UTFPR - Campus Apucarana.
Endereço público Laravel: [http://gfc-cloud.ddns.net/cidades/public/index.php](http://gfc-cloud.ddns.net/cidades/public/index.php)

### Etapas completadas do Projeto 1:
a) Faça o cadastro dos dados da sua equipe no link desta atividade.
- [X] a) HTML: Crie uma página Web com um formulário que receba entradas do usuário e vá para uma outra página quando submetido.
- [X] b) HTML: Crie uma caixa de seleção dentro do formulário.
- [X] c) CSS: Faça a formatação da tabela com coloração alternada.
- [X] d) CSS: Apresente um exemplo de formatação com expressões regulares.
- [X] e) JavaScript: Apresente um exemplo que altere dinamicamente um componente da página HTML quando o clique de um botão é acionado.
- [X] f) JavaScript: Recebe valores decimais do usuário e apresente dinamicamente a soma dos valores na página HTML.
- [X] g) jQuery: Apresente um exemplo de tratamento de eventos do teclado que apresente dinamicamente a quantidade de letras digitadas em uma caixa de texto.
- [X] h) jQuery: Dada uma lista exibida na página HTML, faça a ordenação dos elementos em ordem decrescente.
- [X] i) BootStrap: Formate a sua página Web com BootStrap.
- [X] j) README: Apresente no README.md na pasta principal do seu projeto a descrição do projeto, a marcação da caixa de seleção da etapa que foi cumprida, e o endereço do repositório do seu projeto. Dica: utilize o exemplo do README.md do endereço: https://github.com/simplecloudservlet/webaula1ex1/README.md

### Etapas do Projeto 2

- [X] Crie uma base de dados no MySQL e exiba em uma página PHP que o seu site tem conexão com o banco de dados. [http://gfc-cloud.ddns.net/cidades_php/cidades.php](http://gfc-cloud.ddns.net/cidades_php/cidades.php)
- [X] No MySQL, crie as tabelas T_ESTADOS (id, nome, sigla) e T_CIDADES(id,nome,id_estado). O campo 'id_estado' em 'T_CIDADES' é chave estrangeira e referencia o campo 'id' da tabela T_ESTADOS.
- [X] Na página PHP, faça a importação dos dados do arquivo 'estados.txt' para a tabela T_ESTADOS do banco de dados MySQL.
- [X] Na página PHP, faça a importação do conteúdo do arquivo 'municipios.csv' para a tabela 'T_CIDADES'. Observe que é necessário uma consulta SQL em 'T_ESTADOS' para obter o 'id_estado' de acordo com a 'sigla' em 'municipios.csv', antes de inserir a cidade em 'T_CIDADES'.
- [X] Na página PHP, crie um formulário que permita pesquisar municípios do banco de dados.
- [ ] Na página PHP, crie um formulário que permita inserir e remover um município no banco de dados com chamada JavaScript assíncrona.
- [X] Crie 1 (uma) página com o framework Laravel com acesso ao banco de dados MySQL.
- [X] Exiba na página criada com o framework Laravel a lista de cidades do banco de dados MySQL.
- [X] Acrescente no arquivo README.md o endereço público do seu site.
- [X] Hospede todo o conteúdo do site no ambiente Oracle Cloud. (Nota: o endereço público deve estar ativo e acessível na Internet.)
