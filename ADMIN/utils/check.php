<?php
    if (!session_id()) {
        session_start();
    };

    if (!isset($_SESSION["VERCOMPRA_ADM"])) {
        header('Location: ../comprasloja.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['VERCOMPRA_ADM'] = $_POST['idCompra'];
        
        echo json_encode(true);
    }
?>