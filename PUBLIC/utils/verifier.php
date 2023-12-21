<?php
    if (!session_id()) {
        session_start();
    };

    if ($_SESSION['LOGIN-TO-BUY'] == 'TRUE') {
        unset($_SESSION['LOGIN-TO-BUY']);
        header('Location: ../../CLIENT/fechar_compra.php');
    }
?>