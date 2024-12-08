<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dados do Banco</title>
</head>
<body>
    <h1>Exibindo Dados em uma Área Específica</h1>

    <!-- Contêiner específico onde os dados serão exibidos -->
    <div id="dados-container">

        <?php
        $query_busca = "SELECT id,titulo,descrição,data_inicio,horario_inicio,statu FROM evento";
        $result = $conn->query($query_busca);
        if ($result->num_rows > 0) {
            // Iterar pelos resultados e criar elementos HTML dinamicamente
            while($row = $result->fetch_assoc()) {
                echo "<p><strong>" . htmlspecialchars($row['titulo']) . "</strong>: " . htmlspecialchars($row['descricao']) . htmlspecialchars($row['data_inicio']) . htmlspecialchars($row['horario_inicio']) . htmlspecialchars($row['statu']) ."</p>";
            }
        } else {
            echo "<p>Nenhum resultado encontrado.</p>";
        }
        // Fechar conexão
        $conn->close();
        ?>
    </div>
</body>
</html>

<div>
            <p>Nome: . htmlspecialchars($row['nome']) </p>
            <p>
                <span>Data:</span>
                <strong>. htmlspecialchars($row['data_inicio'])</strong>
            </p>
            <p>
                <span>Status:</span>
                <strong>. htmlspecialchars($row['data_inicio'])</strong>
            </p>
            <div class="ls-txt-right">
                <a href="#" class="btn">Saiba mais</a>
        </div>
    `;