<?php
// Criar tabelas no banco de dados
include("conexao_banco.php");
$tables = [
    // Tabela Usuario
    "CREATE TABLE IF NOT EXISTS Usuario (
        id_usuario INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(45),
        email VARCHAR(100),
        senha VARCHAR(45),
        telefone VARCHAR(15),
        tipo_usuario VARCHAR(100),
        Participante_id_Participante INT,
        Organizador_id_Organizador INT
    )",

    // Tabela Participante
    "CREATE TABLE IF NOT EXISTS Participante (
        id_Participante INT PRIMARY KEY,
        nome VARCHAR(100),
        data_nasc DATE
    )",

    // Tabela Organizador
    "CREATE TABLE IF NOT EXISTS Organizador (
        id_Organizador INT PRIMARY KEY,
        nome VARCHAR(100),
        cnpj VARCHAR(15)
    )",

    // Tabela Categoria_Evento
    "CREATE TABLE IF NOT EXISTS Categoria_Evento (
        id_categoria INT PRIMARY KEY,
        nome VARCHAR(45),
        descricao VARCHAR(45)
    )",

    // Tabela Evento
    "CREATE TABLE IF NOT EXISTS Evento (
        id_evento INT PRIMARY KEY,
        titulo VARCHAR(45),
        descricao VARCHAR(45),
        data_inicio VARCHAR(45),
        data_fim VARCHAR(45),
        horario_inicio VARCHAR(45),
        horario_fim VARCHAR(45),
        status VARCHAR(45),
        Usuario_id_usuario INT,
        Inscricao_id_inscricao INT,
        Inscricao_Pagamento_id_pagamento INT,
        Organizador_id_Organizador INT
    )",

    // Tabela Inscricao
    "CREATE TABLE IF NOT EXISTS Inscricao (
        id_inscricao INT PRIMARY KEY,
        data_inscricao DATE,
        status_inscricao VARCHAR(100),
        Pagamento_id_pagamento INT,
        Participante_id_Participante INT
    )",

    // Tabela Pagamento
    "CREATE TABLE IF NOT EXISTS Pagamento (
        id_pagamento INT PRIMARY KEY,
        valor DECIMAL(10,2),
        data_pagamento DATETIME,
        metodo_pagamento VARCHAR(45),
        status_pagamento VARCHAR(45)
    )",

    // Tabela Feedback
    "CREATE TABLE IF NOT EXISTS Feedback (
        id_feedback INT PRIMARY KEY,
        nota VARCHAR(45),
        comentario VARCHAR(45),
        data_feedback VARCHAR(45),
        Evento_id_evento INT,
        Participante_id_Participante INT
    )",

    // Tabela Evento_has_Categoria_Evento
    "CREATE TABLE IF NOT EXISTS Evento_has_Categoria_Evento (
        Evento_id_evento INT,
        Categoria_Evento_id_categoria INT,
        PRIMARY KEY (Evento_id_evento, Categoria_Evento_id_categoria)
    )"
];

// Executando as consultas
foreach ($tables as $table) {
    if ($conn->query($table) === TRUE) {
        echo "Tabela criada com sucesso.<br>";
    } else {
        echo "Erro ao criar tabela: " . $conn->error . "<br>";
    }
}
?>
