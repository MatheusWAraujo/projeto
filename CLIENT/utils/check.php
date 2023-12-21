<?php
    if (!session_id()) {
        session_start();
    };

    if (!isset($_SESSION["VERCOMPRA"])) {
        header('Location: ../minhas_compras.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['VERCOMPRA'] = $_POST['idCompra'];
        
        echo json_encode(true);
    }
?>