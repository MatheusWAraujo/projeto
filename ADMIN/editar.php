<?php
    include '../UTILS/db_connection.php';

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

    // Consultar dados do produto específico
    $sql = "SELECT id, nome, categoria, preco, imagem FROM produto WHERE id=$id";
    $result = $connection->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nome = $row['nome'];
        $categoria = $row['categoria'];
        $preco = $row['preco'];
        $imagem = $row['imagem'];
    } else {
        echo "Produto não encontrado";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $categoria = $_POST['categoria'];
        $preco = $_POST['preco'];

        // Processar upload de nova imagem, se fornecida
        if ($_FILES["imagem"]["size"] > 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Verificar se o arquivo é uma imagem real ou uma imagem falsa
            $check = getimagesize($_FILES["imagem"]["tmp_name"]);
            if ($check !== false) {
                echo "O arquivo é uma imagem - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "O arquivo não é uma imagem.";
                $uploadOk = 0;
            }

            // Verificar se o arquivo já existe
            if (file_exists($target_file)) {
                echo "Desculpe, o arquivo já existe.";
                $uploadOk = 0;
            }

            // Verificar o tamanho do arquivo
            if ($_FILES["imagem"]["size"] > 500000) {
                echo "Desculpe, seu arquivo é muito grande.";
                $uploadOk = 0;
            }

            // Permitir apenas alguns formatos de arquivo
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
                $uploadOk = 0;
            }

            // Verificar se $uploadOk é setado como 0 por um erro
            if ($uploadOk == 0) {
                echo "Desculpe, seu arquivo não foi enviado.";
            } else {
                // Se tudo estiver correto, tenta enviar o novo arquivo
                if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                    echo "O novo arquivo " . htmlspecialchars(basename($_FILES["imagem"]["name"])) . " foi enviado com sucesso.";
                    $imagem = $target_file;
                } else {
                    echo "Desculpe, ocorreu um erro ao enviar o novo arquivo.";
                }
            }
        }

        // Atualizar dados na tabela
        $valor = 'R$ ' . number_format($preco, 2, ',', '.');
        $sql = "UPDATE produto SET nome='$nome', categoria='$categoria', preco='$valor', imagem='$imagem' WHERE id=$id";
        
        if ($connection->query($sql) === TRUE) {
            header("Location: produtos.php");
            exit();
        } else {
            echo "Erro ao atualizar produto: " . $connection->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADM - Editar</title>
</head>

<body>
    <h2>Editar Produto</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$id");?>" enctype="multipart/form-data">
        Nome: <input type="text" name="nome" value="<?php echo $nome; ?>" required><br>
        Categoria: <input type="text" name="categoria" value="<?php echo $categoria; ?>" required><br>
        Preço: <input type="number" name="preco" step="0.01" value="<?php echo $preco; ?>" required><br>
        Imagem Atual: <img src="<?php echo $imagem; ?>" alt="Imagem Atual" width="100"><br>
        Nova Imagem: <input type="file" name="imagem" id="imagem" accept="image/*"><br>
        <input type="submit" value="Atualizar">
    </form>

    <br>
    <a href="produtos.php">Voltar para a Lista de Produtos</a>

</body>
</html>

<?php
// Fechar conexão
$conn->close();
?>
