<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "Loja";

    $connection = new mysqli($server, $username, $password, $db);

    if ($connection->connect_error) {
        die("Error: " . $conn->connect_error);
    };
    
