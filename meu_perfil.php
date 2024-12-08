<?php
$servername = 'Localhost';
$username = 'root';
$password = '';
$database = 'eventos_db';
    
$conn = new mysqli($servername,$username,$password,$database);

$conn->select_db($database);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // condição quando o formulario estiver submetido
    if(isset($_POST['submit'])){
      // armazenando os inputs digitados pelo usuario
      $nome = htmlspecialchars($_POST['nome']);
      $nome_local = htmlspecialchars($_POST['local_evento']);
      $data_ini = htmlspecialchars($_POST['data_ini']);
      $data_fim = htmlspecialchars($_POST['data_fim']);
      $hora_ini = htmlspecialchars($_POST['hora_ini']);
      $hora_fim = htmlspecialchars($_POST['hora_fim']);
      $status_evento = htmlspecialchars($_POST['status']);
      // verificando se existe um evento com o mesmo nome para fazer o insert
      $query_busca_evento = "SELECT titulo FROM evento WHERE titulo = ?";
      $resultado_busca = $conn->prepare($query_busca_evento);
      $resultado_busca->bind_param("s" , $nome);
      $resultado_busca->execute();
      //armazenando o resultado
      $resultado_consulta = $resultado_busca->get_result();
      if($resultado_consulta->num_rows >  0){
        echo"<script>alert(evento ja existente)</script>";
      }
      else{
        // armazenando no banco
        $query_evento = "INSERT INTO evento(titulo,data_inicio,data_fim,horario_inicio,horario_fim,statu) 
        VALUES('$nome', '$data_ini', '$data_fim', '$hora_ini', '$hora_fim', '$status_evento')";
        $verificar_evento = $conn->prepare($query_evento);
        $verificar_evento->execute();
      }
    }
    $nomes = array_map('trim', $_POST['nome_excluir']);
    // condiçao para excluir determinado evento
    
    if(!empty($_POST['nome_excluir'])){
        
        // criar lista de nomes e formataçao da query
        //$nomes = "'".implode("','", $_POST['nome_excluir'])."'";
       // $nomes_lista = implode(',', $nomes);
        // consulta para excluir
        //$consulta_excluir = "DELETE FROM eventos_db.evento WHERE titulo IN ($nomes_lista)";
        //$conn->query($consulta_excluir);
        // formatando os dados da query
        $placeholders = implode(',', array_fill(0, count($nomes), '?'));

        // Consulta para fazer a verificaçao
        $consulta_excluir = "DELETE FROM evento WHERE titulo IN ($placeholders)";
        $stmt = $conn->prepare($consulta_excluir);

        // Vincular oos titulos dos eventos dinamicamente
        $types = str_repeat('s', count($nomes)); // 's' para cada título
        $stmt->bind_param($types, ...$nomes);
        $stmt->execute();

    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventPlanet - Gestão de Eventos Intergalácticos</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
   <!-- Header -->
   <header class="header">
    <a href="#h" class="logo">Event <span>Planet</span></a>

    <nav class="navbar">
      <a href="paginaInicial.html">Home</a>
      <a href="#">Clientes</a>
      <a href="#">Calendario</a>
      <a href="#">Configuração</a>
    </nav>
    <!-- Barra de Pesquisa-->
    <form class="search-bar" action="#" method="get">
      <input type="text" placeholder="Buscar..." name="search" />
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>

    <!-- Meu perfil -->
    <nav class="navbar" id="perfil"><a href="meuPerfil.html">meu perfil</a></nav>
    </header>

    <section>
        <h2><i class="fa-solid fa-chart-pie"></i> Dashboard</h2>

        <div class="box-info">
            <div class="box-info-single arrecadado">
                <div class="info-text">
                    <p>Valor Arrecadado</p>
                    <p>R$ 100.000</p>
                </div>
                <i class="fa-solid fa-money-check-dollar"></i>
            </div>

            <div class="box-info-single eventos">
                <div class="info-text">
                    <p>Eventos Realizados</p>
                    <p>20</p>
                </div>
                <i class="fa-solid fa-check"></i>
            </div>

            <div class="box-info-single publico">
                <div class="info-text">
                    <p>Público Alcançado</p>
                    <p>5.000</p>
                </div>
                <i class="fa-solid fa-people-group"></i>
            </div>
            
            <div class="box-info-single avaliacao">
                <div class="info-text">
                    <p>Avaliação Pós-Evento (Média)</p>
                    <p>9,5</p>
                </div>
                <i class="fa-solid fa-star"></i>
            </div>
        </div>

    </section>
            
    <!-- Contato -->
    <section class="contact">
        <h2><i class="fa-regular fa-pen-to-square"></i> Meus Eventos</h2>

        <form id="form_evento" action="meu_perfil.php" method="POST">
          <div class="input-box">
            <h3>Nome do Evento</h3>
            <input  id="nome" name="nome" class="input requi_evento" type="text" placeholder="Nome do Evento" oninput="NomeValido()" />
            </br>
            <span class="span_evento">nome tem que ser maior que 5 caracteres</span>
            </br>
            </br>
            <h3>Local do Evento</h3>
            <input class="input requi_evento" name="local_evento" id="local_evento" type="text" placeholder="local do Evento" oninput="LocalValido()" />
            <span class="span_evento">nome do local que ser maior que 5 caracteres</span>
            </br>
            </br>
            <h3>Data do Evento</h3>
            <input  class="input requi_evento" name="data_ini" id="data_ini" type="text" placeholder="Data de inicio"  oninput="DataValida()"/>
            <input  class="input requi_evento" name="data_fim" id="data_fim" type="text" placeholder="Data de término" oninput=" DataValida()"/>
            </br>
            </br>
            <span class="span_evento">Data de inicio tem que ser menor q a data de termino</span>
            <h3>Horario do Evento</h3>
            <input id="hora_ini" name="hora_ini" type="text" placeholder="Horario de inicio"  class="input requi_evento" oninput="MascaraHora()" />
            <input id="hora_fim" name="hora_fim" type="text" placeholder="Horario de término"  class="input requi_evento" oninput="MascaraHora()"/>
            <h3>Status do Evento</h3>
            </br>
            <select
                  id="status"
                  type="checkbox"
                  name="status"
                  class="input requi styled-select"
                  oninput="">
                  <option id="option" class="input requi_evento" value="Venda Disponivel">Venda Disponivel</option>
                  <option id="option" class="input requi_evento" value="Esgotado">Esgotado</option>
                  <option id="option" class="input requi_evento" value="venda insuficiente">Vendas Insuficientes</option>
            </select>
          </div>
        </br>
          <h3>Descrição</h3>
          <textarea name="" cols="30" rows="5" placeholder="Descrição..."></textarea>
          <button type="submit" name="submit" id="adicionar_event" value="Adicionar" class="btn">ADICIONAR</button>
          
        </form>
        <h2><i class="fa-solid fa-table-list"></i> Tabela de Eventos</h2>
        <form action="" method="POST">
            <table class="table">
                <div>
                    <thead>
                        <tr>
                            <th>Nome Evento</th>
                            <th>Status</th>
                            <th>Selecione</th>
                        </tr>
                    </thead>
                </div>
                <tbody>
                    <?php
                    //$delete = "DELETE FROM evento WHERE =  ?";
                    //$delete_result = $conn->query($delete);
                    // adicinando os eventos registrados na tabela excluir
                    $query_busca = "SELECT titulo,statu FROM evento";
                    $result_ = $conn->query($query_busca);
                    
                    if ($result_ && $result_->num_rows > 0) {
                        // Iterar pelos resultados e criar elementos HTML dinamicamente
                        while($row = $result_->fetch_assoc()) {
                            //construção dos elementos
                           
                            echo"<tr>
                                <td>" . htmlspecialchars($row['titulo']) . 
                                "</td>".
                                "<td>". htmlspecialchars($row['statu']) .
                                "</td>".
                                '<td><input name="nome_excluir[]" type="checkbox"></td>'.
                            "</tr>";
                        
                    }
                    
                    }
                
                    ?>
                </tbody>
            </table>
            <input type="submit" name="excluir_registro" value="Excluir Selecionados" class="btn" id="excluir"/>
        </form>        
    </section>
    
    <section class="container" id="events">

            <h2><i class="fa-solid fa-circle-info"></i> Informações</h2>
            
            <hr class="line">
            <div class="texte1">
            <div id="dados-container">

                    <?php
                    // consulta para buscra todos os dados ta tabela evento
                    $query_busca = "SELECT titulo,descricao,data_inicio,horario_inicio,statu FROM evento";
                    $result = $conn->query($query_busca);
                    
                    if ($result->num_rows > 0) {
                        // Iterar pelos resultados e criar elementos HTML dinamicamente
                        while($row = $result->fetch_assoc()) {
                            // contruçao dos elementos
                            echo "<p>
                                <strong>Evento:" . htmlspecialchars($row['titulo']) .
                                "<br>".
                                "</strong>Descrição:" . htmlspecialchars($row['descricao']) .
                                "<br>". 
                                "</strong>Data:".htmlspecialchars($row['data_inicio']) . 
                                "<br>".
                                "</strong>Horario:" .htmlspecialchars($row['horario_inicio']) . 
                                "<br>".
                                "</strong>Inicio:" .htmlspecialchars($row['statu']) .
                                ' <div class="ls-txt-right">
                                <a href="#" class="btn">Saiba mais</a>
                            </div>'.
                            '<hr class="line">'.
                            "</p>";
            
                        }
                    } else {
                        echo "<p>Nenhum resultado encontrado.</p>";
                    }
                   
                    $conn->close();
                    ?>
        
                </div>
            </div>
           
    </section>
    
    <footer class="footer">
        <p class="copyright">
          Siga-nos nas redes sociais para acompanhar nossos eventos e dicas de gestão!
        </p>
        <div class="social">
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-youtube"></i></a>
          <a href="#"><i class="fa-brands fa-facebook"></i></a>
        </div>
        <p class="copyright">© 2024 Odysseia Estrelar | Todos os direitos reservados.</p>
    </footer>
</body>
<script src="./scripts/adicionar_evento.js"></script>
<script src="./scripts/perfil_evento.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
</html>