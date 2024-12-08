<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'eventos_db';

$conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

if ($conexao-> connect_errno){
        echo "ERROR";
    }
else{
        echo "conexão aceita";
    }

?>