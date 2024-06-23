function search_prod(event) {

    // Para o evento de submissão
    event.preventDefault();

    // Acessando os dados do formulário através do objeto event
    const formData = new FormData(event.target);
    const username = formData.get('username');
    const password = formData.get('password');

    // Cria um objeto de dados a serem enviados
    var data = {
        username: username,
        password: password
    };

    // Configura as opções da requisição
    var options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    };

    // Faz a requisição usando a API Fetch
    fetch('./scripts/validate_session.php', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {
            // Verifica se achou o produto
            if (data.error == undefined) {
                // Redireciona para o menu
                window.location.href = "./menu.php";
            } else {
                console.log(data.error)
            }
        })
        .catch(error => console.error('Erro: ', error));
}

document.getElementById("login_form").addEventListener("submit",function(event){search_prod(event)},false);