<?php

// Inclui o arquivo db_access.php e obtém a conexão com o banco de dados
$conn = require_once './db_access.php';

// Iniciar a sessão
session_start();

// Remove as variáveis de sessão
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}
if (isset($_SESSION['podi_cad_func'])) {
    unset($_SESSION['podi_cad_func']);
}
if (isset($_SESSION['podi_cad_prod'])) {
    unset($_SESSION['podi_cad_prod']);
}
if (isset($_SESSION['podi_ger_relt'])) {
    unset($_SESSION['podi_ger_relt']);
}
if (isset($_SESSION['podi_ajs_estq'])) {
    unset($_SESSION['podi_ajs_estq']);
}
if (isset($_SESSION['podi_ajs_comp'])) {
    unset($_SESSION['podi_ajs_comp']);
}
if (isset($_SESSION['podi_ajs_vend'])) {
    unset($_SESSION['podi_ajs_vend']);
}
if (isset($_SESSION['podi_ajs_ajst'])) {
    unset($_SESSION['podi_ajs_ajst']);
}
if (isset($_SESSION['podi_mud_perm'])) {
    unset($_SESSION['podi_mud_perm']);
}
if (isset($_SESSION['consult_prod'])) {
    unset($_SESSION['consult_prod']);
}
if (isset($_SESSION['podi_ajs_prod'])) {
    unset($_SESSION['podi_ajs_prod']);
}

// Indica que não há usuário conectado
if (isset($_SESSION['user_connected'])) {
    $_SESSION['user_connected'] = false;
}

// Fecha a conexão
$conn->close();

header("Location:../index.php");
exit();
