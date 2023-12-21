<?php
    if (!session_id()) {
        session_start();
    }
    
    if (!isset($_SESSION['CARRINHO'])) {
        header('Location: ../PUBLIC/carrinho.php');
    }

    if (sizeof($_SESSION['CARRINHO']) < 1){
        header('Location: ../PUBLIC/carrinho.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['met-pagamento'])) {
            include('../UTILS/db_connection.php');

            $email = $_SESSION['EMAIL'];

            $sql = "SELECT * FROM usuario";
            $result = $connection->query($sql);

            $id = 0;

            if ($result){
                while ($row = $result->fetch_assoc()) {
                    if ($row["Email"] == $email) {
                        $id = $row["Id"];
                        break;
                    }
                };
            };

            $data = date('Y-m-d');
            $quantidade = 0;
            $valor = 0;

            $sql = "SELECT * FROM produto";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (isset($_SESSION['CARRINHO'][$row["Id"]])){
                        $quantidade += $_SESSION['CARRINHO'][$row['Id']];
                        $quantity = $_SESSION['CARRINHO'][$row['Id']];

                        $preco = $row['Preco'];
                        $preco = str_replace('R$ ', '', $preco);
                        $preco = str_replace(',', '.', $preco);

                        $valor += ($preco * $quantity);
                    }
                }
            };

            $valor = 'R$ ' . number_format($valor, 2, ',', '.');

            $sql = "INSERT INTO compras (Data, Paga, Entregue, `id-user`, quantidade, preco) VALUES ('$data', '1', '0','$id','$quantidade', '$valor')";
            $result = $connection->query($sql);

            $sql = "SELECT * FROM produto";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (isset($_SESSION['CARRINHO'][$row["Id"]])){
                        $quantidade = $_SESSION['CARRINHO'][$row['Id']];

                        $idProd = $row['Id'];
                        $idCompra = 0;

                        $sqlCompras = "SELECT * FROM compras";
                        $resultado = $connection->query($sqlCompras);

                        if ($resultado->num_rows > 0) {
                            $total = mysqli_num_rows($resultado);
                            $number = 0;

                            while ($ro = $resultado->fetch_assoc()) {
                                if ($number == $total - 1){
                                    $idCompra = $ro['Id'];
                                };

                                $number++;
                            }
                        }

                        $itemSQL = "INSERT INTO itemcompra (Quantidade, IdProduto, IdCompra) VALUES ('$quantidade', '$idProd', '$idCompra')";
                        $connection->query($itemSQL);
                    }
                }
            }

            unset($_SESSION['CARRINHO']);
            echo "<div class='content-aproved'> <img src='../ASSETS/imgs/completed.png'> </div>";
            echo "<script> setTimeout(function() {window.location.href = '../PUBLIC/home.php';}, 2500); </script>";
            $connection->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ASSETS/style.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/rodape.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/boxpag.css">
    <title> Outdoor - Compra Finalizada </title>
</head>

<body>
</body>

</html>