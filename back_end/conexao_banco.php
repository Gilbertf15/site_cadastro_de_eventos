<?php

$servername = 'Localhost';
$username = 'root';
$password = '';
$database = 'eventos_db';


$conn = new mysqli($servername,$username,$password);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
echo "Conexão bem-sucedida";


$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
    echo "Banco de dados criado com sucesso.";
} else {
    echo "Erro ao criar banco de dados: " . $conn->error;
}


$conn->select_db($database);
?>
