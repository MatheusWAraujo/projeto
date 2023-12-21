<?php
    if (!session_id()) {
        session_start();
    };
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {       
        if ($_SESSION['PAPEL'] == 'GUEST') {
            $_SESSION['LOGIN-TO-BUY'] = 'TRUE';

            echo json_encode(false);
            exit;
        }

        echo json_encode(true);
        exit;
    }
?>
