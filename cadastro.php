<?php

$servername = 'Localhost';
$username = 'root';
$password = '';
$database = 'eventos_db';

$conn = new mysqli($servername,$username,$password,$database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$conn->select_db($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //condiçao caso o formulario fique submitado
  if(isset($_POST['submit'])){
    
      // armazenando os inputs
      $email = htmlspecialchars($_POST['email']);
      $nome = htmlspecialchars($_POST['nome']);
      $senha = htmlspecialchars($_POST['senha']);
      $telefone = htmlspecialchars($_POST['telefone']);
      $opcao = htmlspecialchars($_POST['opcao']);
      
      // query para inserir os dados
      $query_ = "INSERT INTO usuario( nome,email,senha,telefone,tipo_usuario) 
      VALUES('$nome', '$email', '$senha', '$telefone', '$opcao')";
      $verificar = $conn->prepare($query_);

      $verificar->execute();
      
      $conn->close();
     
      
     
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="estilos/cadastro.css" />
    <title>EventPlanet - Cadastro</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  </head>
  <body>
    <div class="main_cadastro">
      <div class="esquerda_cadastro">
        <h1>CADASTRE-SE<br />E entre para o nosso time</h1>
        <img src="img/planetas.png" class="esquerda_img" alt="planetas" />
      </div>
      <div class="direita_cadastro">
        <div class="card_cadastro">
          <h2>CADASTRO</h2>
          <form id="form_" action="cadastro.php" method="POST">
            <div class="text_field">
              <label>Email</label>
              <input type="Email" name="email" placeholder="email" class="inputs requi" oninput="EmailValido()"/>
              <span class="span_requi">Digite um Email valido</span>
            </div>
            <div class="text_field">
              <label>Usuário</label>
              <input name="nome" type="text" placeholder="usuário" class="inputs requi" oninput="NomeValido()"/>
              <span class="span_requi"
                >Nome deve ter no mínimo 5 caracteres</span
              >
            </div>
            <div class="text_field">
              <label >Senha</label>
              <input name="senha" type="password" placeholder="senha" class="inputs requi" oninput="senhaValida()"
              />
              <span class="span_requi"
                >Senha deve ter no mínimo 8 caracteres</span
              >
            </div>
            <div class="text_field">
              <label>Telefone</label>
              <input name="telefone" id="tele" type="tel" placeholder="(xx) xxxxx-xxxx" class="inputs requi" oninput="NumeroValido()"
              />
              <span class="span_requi"
              >Nùmero de telefone incorreto</span>

              <div class="text_field">
                <label>Tipo Acesso:</label>
              
                <select name="opcao" type="checkbox" class="inputs requi styled-select">
                  <option id="option" class="inputs requi" value="Participante">Participante</option>
                  <option id="option" class="inputs requi" value="Organizador">Organizador</option>
                </select>
                
                <span class="span_requi">Número de telefone incorreto</span>
            <p id="result_cad">cadastro realizado com sucesso</p>
            <button type="submit" name="submit" value="Enviar" class="bnt_cadastro">cadastrar</button>
            <a href="paginaInicial.html" class="btn_home">Início</a>
            <a href="login.html"><p>Já possui cadastro? faça seu login!</p></a>
          </form>

          
        </div>
       
      </div>
    </div>
 
  </body>

<script>
  const formulario = document.getElementById("form_");
const campos_input = document.querySelectorAll(".requi");
const spans = document.querySelectorAll(".span_requi");
// regex para validação de email//
const email_valid = /\S+@\S+\.\S+/;

// evento de envio de formulario para impedir o envio padrão

//condição de mensagem de alerta caso o cadastro seja realizado
if (nome != "" && email != "" && senha != "" && telefone != "") {
  document.getElementById("result_cad").style.display = "block";
  document.getElementById("result_cad").style.color = "green";
  alert("cadastro feito com sucesso");
} else {
  document.getElementById("result_cad").style.display = "none";
}

// função para caso ocorrer erro mostrar a mensagem do span
function setErrorSpan(index) {
  campos_input[index].style.border = "1px solid red";
  spans[index].style.display = "block";
}
// função para caso não tenha erro retirar a mensagem de span
function removerErrorSpan(index) {
  campos_input[index].style.border = "";
  spans[index].style.display = "none";
}
// funçao para validar o campo input nome
function NomeValido() {
  if (campos_input[1].value.length < 5) {
    setErrorSpan(1);
  } else {
    removerErrorSpan(1);
  }
  return campos_input[1].value;
}
// função para validar o campo de email a partir de um regex
function EmailValido() {
  if (!email_valid.test(campos_input[0].value)) {
    setErrorSpan(0);
  } else {
    removerErrorSpan(0);
  }
  return campos_input[0].value;
}
// funçao para validar o campo input senha
function senhaValida() {
  if (campos_input[2].value.length < 8) {
    setErrorSpan(2);
  } else {
    removerErrorSpan(2);
  }
  return campos_input[2].value;
}
// função para validar numero de telefone
function NumeroValido() {
  // utilização de uma mascara de campo com jquery
  $("#tele").mask("(00) 0000-0000");
  if (campos_input[3].value.length < 11) {
    setErrorSpan(3);
  } else {
    removerErrorSpan(3);
  }
  return campos_input[3].value;
}

</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>

</html>

