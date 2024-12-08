<?php
$servername = 'Localhost';
$username = 'root';
$password = '';
$database = 'eventos_db';
// conexão com o banco
$conn = new mysqli($servername,$username,$password,$database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


$conn->select_db($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // condiçao caso o formulario fique submitado
  if(isset($_POST['submit'])){
    //armazenando os inputs
    $nome = htmlspecialchars($_POST['usuario']);
    $cnpj = htmlspecialchars($_POST['cnpj']);

    // query para inserir os dados
    $query_organizador = "INSERT INTO organizador(nome,cnpj) 
    VALUES('$nome', '$cnpj')";
    $verificar_organizador = $conn->prepare($query_organizador);

    $verificar_organizador->execute();

    $verificar_organizador->close();
    // direcionando o organizador para o a pagina perfil
    if($nome != "" && $cnpj != ""){
      header("Location: MeuPerfil.html");

    }

  }

}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="estilos/organizador.css" />
    <title>EventPlanet - Organizador</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  </head>
  <body>
    <div class="main_login">
      <div class="esquerda_login">
        <h1>
          BEM-VINDO ORGANIZADOR!<br />Faça o login em nossa
          <strong>PLATAFORMA</strong>
        </h1>
        <img src="img/planetas.png" class="esquerda_img" alt="planetas" />
      </div>
      <div class="direita_login">
        <div class="card_login">
          <h2>LOGIN ORGANIZADOR</h2>
          <form id="form_" action="organizador.php" method="POST">
            <div class="text_field">
              <label for="usuario">Usuário</label>
              <input
                type="text"
                name="usuario"
                placeholder="usuário"
                class="input requi_org"
                required
                oninput="NomeValido()"
              />
              <span class="span_org">Nome deve ter no mínimo 8 caracteres</span>
            </div>
            <div class="text_field">
              <label for="senha">CNPJ</label>
              <input
                id="cnpj"
                type="text"
                name="cnpj"
                placeholder="CNPJ"
                class="input requi_org"
                required
                oninput="CnpjValido()"
              />
              <span class="span_org">Cnpj deve ter no mínimo 8 caracteres</span>
            </div>
            <p class="forgot_password">
              <a href="recuperar_senha.html">
                Esqueceu a senha?
                <strong class="highlight_blue">Recupere agora!</strong>
              </a>
            </p>
            <button type="submit" name="submit" class="bnt_org">Acessar</button>
          </form>
          <a href="paginaInicial.html" class="btn_home">Início</a>
        </div>
      </div>
    </div>
  </body>
<script src="./scripts/organizador.js"> </script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
</html>
