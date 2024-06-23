<?php
    // Conexão com o banco de dados
    // Trocar os valores para o que vocês usaram
    $servername = "localhost"; 
    $username = "usuario";
    $password = "senha";
    $dbname = "db_sge"; 
    
    // Cria uma conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    return $conn;
