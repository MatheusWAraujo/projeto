<?php
    if (!session_id()) {
        session_start();
    };

    if (!isset($_SESSION['PAPEL'])) {
        $_SESSION['PAPEL'] = "GUEST";
    }

    if ($_SESSION['PAPEL'] != "GUEST") {
        header('Location: ../PUBLIC/home.php');
    }

    if (!isset($_SESSION['CARRINHO'])) {
        $_SESSION['CARRINHO'] = array();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("../UTILS/db_connection.php");

        $nome = $_POST['nome'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];
        $logradouro = $_POST['logradouro'];
        $numero = $_POST['casanumero'];

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $emailValid = "SELECT * FROM usuario WHERE Email = '$email'";
        $emailResult = $connection->query($emailValid);
        
        if ($emailResult) {
            if ($emailResult->num_rows > 0){
                echo json_encode(false);
                $connection->close();

                exit;
            }
        }

        $pessoas = "SELECT * FROM pessoa";
        $result = $connection->query($pessoas);

        $id = 0;

        if ($result) {
            if ($result->num_rows < 1) {
                $id = 0;
            } else {
                $total = mysqli_num_rows($result);
                $number = 0;

                while ($row = $result->fetch_assoc()) {
                    if ($number == $total - 1){
                        $id = $row["Id"] + 1;
                    };

                    $number++;
                };
            };
        }

        $sql = "INSERT INTO pessoa (Id, Nome, Estado, Cidade, Bairro,
        Logradouro, Numero) VALUES ('$id', '$nome', '$estado',
        '$cidade', '$bairro', '$logradouro', '$numero')";

        $userSQL = "INSERT INTO usuario (Id, Email, Senha, Papel) VALUES ('$id', '$email', '$senha', 'USER')";

        $connection->query($sql);
        $connection->query($userSQL);

        $_SESSION['PAPEL'] = "USER";
        $_SESSION["EMAIL"] = $email;

        $connection->close();
        echo json_encode(true);
        exit;
    }
?>