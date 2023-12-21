<?php
    if (!session_id()) {
        session_start();
    };

    include('../UTILS/db_connection.php');

    if ($_SESSION['PAPEL'] != "ADM"){
        header("Location: nao_autorizado.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $categoria = $_POST['categoria'];
        $preco = $_POST['preco'];
        $estrelas = $_POST['estrelas'];

        $target_dir = "../UPLOADS/".$categoria."/";

        $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["imagem"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            $uploadOk = 0;
        }

        if ($_FILES["imagem"]["size"] > 500000) {
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {

        } else {
            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                $valor = 'R$ ' . number_format($preco, 2, ',', '.');
                $sql = "INSERT INTO produto (Nome, Preco, Imagem, Categoria, Estrelas) VALUES ('$nome','$valor','$target_file','$categoria','$estrelas')";
            
                if ($connection->query($sql) === TRUE) {
                    header("Location: criar_produto.php");
                    exit();
                }
            } 
        }
    }
?>
