<?php
$servername = 'Localhost';
$username = 'root';
$password = '';
$database = 'eventos_db';

$conn = new mysqli($servername,$username,$password,$database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //condiçao caso o formulario fique submitado
  if(isset($_POST['submit'])){
  //armazenando os inputs
    $nome = htmlspecialchars($_POST['participante']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $data_nascimento = htmlspecialchars($_POST['nascimento']);

     // query para inserir os dados
    $query_parti = "INSERT INTO participante(nome,data_nasc) 
      VALUES('$nome', '$data_nascimento')";
    $verificar = $conn->prepare($query_parti);
    $verificar->execute();
    $conn->close();
  }

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="estilos/participante.css" />
    <title>EventPlanet - Participante</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  </head>
  <body>
    <div class="main_login">
      <div class="esquerda_login">
        <h1>BEM-VINDO PARTICIPANTE!<br />Faça o login em nossa <strong>PLATAFORMA</strong></h1>
        <img src="img/planetas.png" class="esquerda_img" alt="planetas" />
      </div>
      <div class="direita_login">
        <div class="card_login">
          <h2>LOGIN PARTICIPANTE </h2>
          <form id="form_"  action="participante.php" method="POST">
            <div class="text_field">
              <label for="usuario">Usuário</label>
              <input
                type="text"
                name="participante"
                placeholder="usuário"
                class="input requi_part"
                required
                oninput="NomeValido()"
              />
              <span class="span_part">Nome deve ter no mínimo 8 caracteres</span>
            </div>
            <div class="text_field">
              <label for="cpf">CPF</label>
              <input
                id="cpf"
                type="text"
                name="cpf"
                placeholder="CPF"
                class="input requi_part"
                required
                oninput="CpfValido()"
              />
              <span class="span_part">Cpf deve ter no mínimo 11 caracteres</span>
              <div class="text_field">
                <label for="cpf">Data de nascimento</label>
                <input
                  id="cpf"
                  type="date"
                  name="nascimento"
                  placeholder="data nascimento"
                  class="input requi_part"
                  required               
                />
              </div>
              <p class="forgot_password">
                <a href="recuperar_senha.html">
                  Esqueceu a senha? <strong class="highlight_blue">Recupere agora!</strong>
                </a>
              </p>    
            <button type="submit" name="submit" class="bnt_part">Acessar</button>
          </form>
          <a href="paginaInicial.html" class="btn_home">Início</a>
        </div>
      </div>
    </div>
  </body>
<script src="./scripts/participante.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
</html>
