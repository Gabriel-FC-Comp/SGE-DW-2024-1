
function resetCheckboxes() {
    // Seleciona todos os checkboxes dentro da lista de tarefas
    var checkboxes = document.querySelectorAll('.custom-checkbox input[type="checkbox"]');
    
    // Define o estado de cada checkbox como desmarcado
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });
}
function simpleSalvar(){
  console.log("Sauvou Lehau carra")
}
function simpleExcluir(){
  console.log("Escruiu Lehau carra")
}

document.getElementById("redfine_func_perm_button").addEventListener("click",resetCheckboxes, false);
document.getElementById("save_func_button").addEventListener("click",simpleSalvar,false)
document.getElementById("delet_func_button").addEventListener("click",simpleExcluir,false)
