
<?php
// Inicie a sessão
session_start();

$server = "localhost";
$username = "root";
$password = "";
$db = "loja";

$connection = new mysqli($server, $username, $password, $db);

if (!isset($_SESSION['PAPEL']) || $_SESSION['PAPEL'] !== "ADM") {
    die("Acesso negado. Você não tem permissão para visualizar esta página.");
}

if ($connection->connect_error) {
    die("Error: " . $connection->connect_error);
}

if (isset($_POST['id_compra']) && isset($_POST['entregue'])) {
    $id_compra = $_POST['id_compra'];
    $entregue = $_POST['entregue'];

    $query = "UPDATE compras SET Entregue = '$entregue' WHERE Id = $id_compra";
    $result = $connection->query($query);

    if (!$result) {
        die("Erro ao atualizar a entrega: " . $connection->error);
    }
}

if (isset($_POST['id_compra']) && isset($_POST['paga'])) {
    $id_compra = $_POST['id_compra'];
    $paga = $_POST['paga'];

    $query = "UPDATE compras SET Paga = '$paga' WHERE Id = $id_compra";
    $result = $connection->query($query);

    if (!$result) {
        die("Erro ao atualizar o pagamento: " . $connection->error);
    }
}

$query = "SELECT * FROM compras";
$result = $connection->query($query);

if (!$result) {
    die("Erro ao consultar a tabela: " . $connection->error);
}
// abaixo desse bagui vai vim o html ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Compras</title>
</head>
<body>
    <h2>Tabela de Compras</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Data</th>
            <th>Paga</th>
            <th>Entregue</th>
            <th>Ações</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['Id']}</td>";
            echo "<td>{$row['Produto']}</td>";
            echo "<td>{$row['Data']}</td>";
            echo "<td>" . ($row['Paga'] == 1 ? 'Paga' : 'Não Paga') . "</td>";
            echo "<td>" . ($row['Entregue'] == 1 ? 'Entregue' : 'Não Entregue') . "</td>";
            echo "<td>
                    <form method='post'>
                        <input type='hidden' name='id_compra' value='{$row['Id']}'>
                        <input type='hidden' name='entregue' value='" . ($row['Entregue'] == 1 ? 0 : 1) . "'>
                        <button type='submit'>Alterar Entrega</button>
                    </form>
                    <form method='post'>
                        <input type='hidden' name='id_compra' value='{$row['Id']}'>
                        <input type='hidden' name='paga' value='" . ($row['Paga'] == 1 ? 0 : 1) . "'>
                        <button type='submit'>Alterar Pagamento</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$connection->close();
?>
