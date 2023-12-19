<?php
    if (!session_id()) {
        session_start();
    };

    if (!isset($_SESSION['PAPEL'])) {
        $_SESSION['PAPEL'] = "GUEST";
    }