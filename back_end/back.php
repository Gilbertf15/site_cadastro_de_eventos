<?php
include_once('./banco/config.php');
echo "Método de envio: " . $_SERVER['REQUEST_METHOD'] . "<br>";
print_r($_POST);
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      echo "<h4>Formulário enviado!</h4>";
      echo "Método de envio: " . $_SERVER['REQUEST_METHOD'] . "<br>";
      print_r($_POST);
      $email = $_POST['email'] ?? null;
      $nome = $_POST['nome'] ?? null;
      $senha = $_POST['senha'] ?? null;
      $telefone = $_POST['telefone'] ?? null;
      $opcao = $_POST['opcao'] ?? null;
          
      print_r($_POST);
      // $verificar_usu = "SELECT id_usuario FROM usuario WHEHE email = ?";
      $id_participante = null;
      $id_organizador = null;
      $query_ = "INSERT INTO usuario(nome,email,senha,telefone,tipo_usuario) 
      VALUES('$nome', '$email', '$senha', '$telefone', '$opcao')";
      $verificar = $conexao->prepare($query_);
      // Substituir os valores
    
      $result = mysqli_query($conexao, $verificar);
      //$verificar->bind_param("sssss", $nome, $email, $senha, $telefone, $opcao);
      $verificar->execute();
          // Substituir os parâmetros
          // Executar a consulta
      if ($verificar) {
          // Se falhar na execução, exibe o erro
        $verificar->bind_param("sssss", $nome, $email, $senha, $telefone, $opcao);
        echo "<h4>Dados cadastrados com sucesso!</h4>";
            
      } else {
          // Se a execução for bem-sucedida
        echo("<h4>Erro ao inserir os dados: </h4>");  
      }
}
  
?>
