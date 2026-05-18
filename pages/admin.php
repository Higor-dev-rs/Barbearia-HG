<?php
require_once '../config/conexao.php';

try {
    $sql = "SELECT * FROM agendamentos ORDER BY data_agendamento DESC";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();

    $agendamentos = $stmt->fetchALL(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro ao Listar! " . $e->getMessage();
}

// Filtro para selecionar por período e ver os agendamentos do mesmo.
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $data_inicio = $_GET['data_inicio'] ?? '';
    $data_fim =  $_GET['data_fim'] ?? '';

    if (!empty($data_inicio) && !empty($data_fim)) {
        try {
            $sql = "SELECT * FROM agendamentos WHERE data_agendamento 
            BETWEEN :inicio AND :fim ORDER BY data_agendamento ASC ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':inicio', $data_inicio);
            $stmt->bindParam(':fim', $data_fim);
            $stmt->execute();

            $agendamentos = $stmt->fetchALL(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Erro na Busca " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Painel Administrativo - Barbearia HG</title>
    <link rel="icon" type="image/png" href="../assets/img/favicon-hg.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">

</head>
<body>
    <div class="container-admin">
        <h2>Agendamentos Realizados</h2>
        <h3>Barbearia HG</h3>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Serviço</th>
                    <th>Data/Hora</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($agendamentos) > 0): ?>
                    <!-- para percorrer o array de agendamentos que trouxe através do select e pegar cada
                    linha do db e joga dentro da variável $row -->
                    <?php foreach ($agendamentos as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars ($row['nome']); ?></td>
                            <td><?php echo htmlspecialchars ($row['email']); ?></td>
                            <td><?php echo htmlspecialchars ($row['servico']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['data_agendamento'])); ?></td>
                            <td><?php echo htmlspecialchars ($row['telefone']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">Nenhum agendamento encontrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <div class="container-filtro">
        <form class="filtro_data" action="admin.php" method="GET">
            <div class="input">
                <label for="data_inicio">Escolha a data inicial:</label>
                <input type="date" name="data_inicio" id="data_inicio">
            </div>

            <div class="input">
                <label for="data_fim">Escolha a data final:</label>
                <input type="date" name="data_fim" id="data_fim">
            </div>

            <button type="submit">Filtrar</button>
        </form>
    </div>
    
</body>
</html>