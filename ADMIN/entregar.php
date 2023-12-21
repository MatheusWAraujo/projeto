<?php
if (!session_id()) {
    session_start();
}

include("../UTILS/db_connection.php");

if ($_SESSION['PAPEL'] != "ADM") {
    header("Location: nao_autorizado.php");
    exit;
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id_user'];

        $query = "SELECT * FROM compras";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['Id'] == $id){
                    $s = "UPDATE compras SET Entregue=1 WHERE Id='$id'";
                    $rs = $connection->query($s);

                    if ($rs) {
                        header('Location: comprasloja.php');
                    }
                }
            }
        }
    }
?>