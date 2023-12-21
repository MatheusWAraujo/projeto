<?php
    include ('../UTILS/db_connection.php');

    if (!session_id()) {
        session_start();
    };

    if (!isset($_SESSION['PAPEL'])) {
        $_SESSION['PAPEL'] = "GUEST";
    }

    if ($_SESSION['PAPEL'] != "ADM"){
        header("Location: nao_autorizado.php");
    }
    
    $id = $_GET['id'];

    $sql_select = "SELECT imagem FROM produto WHERE id=$id";
    $result_select = $connection->query($sql_select);

    if ($result_select->num_rows == 1) {
        $row_select = $result_select->fetch_assoc();
        $imagem = $row_select['imagem'];

    } else {
        echo "Produto não encontrado";
        exit();
    }

    $sql = "DELETE FROM produto WHERE id=$id";

    if ($connection->query($sql) === TRUE) {
        if (file_exists($imagem)) {
            unlink($imagem);
        }
        header("Location: produtos.php");
        exit();
    }

    $connection->close();
?>
