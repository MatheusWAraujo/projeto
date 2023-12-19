<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST['met-pagamento'])) {
        
        $servername = "localhost";
        $username = "ROOT";
        $password = "ROOT";
        $dbname = "loja";

        $conn = new mysqli($servername, $username, $password, $dbname);

      
        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

    
        $pagamento = true;
        $data = date('Y-m-d');
        $Iduser = 1; //inclusive isso aqui
        $qtd = 4; //trocar para as informações pegas da sessão
        //eu defini o id do banco de dados como autoincrement no meu pc

        $sql = "INSERT INTO compras (Data,Paga,`Id-user`,quantidade) VALUES ('$data','$pagamento','$Iduser','$qtd')";

        if ($conn->query($sql) === TRUE) {

            echo "<h1 style='color: green; text-align: center; font-size: 2em;  margin-top:25%;'>COMPRA FINALIZADA</h1>";
            echo "<script>
        setTimeout(function() {
            window.location.href = '//localhost/loja/PUBLIC/home.php'; }, 3000);
    </script>";
        } else {
            echo "Erro ao inserir compra: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Nenhum método de pagamento selecionado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ASSETS/style.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/rodape.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/boxpag.css">
    <title> Outdoor - Compra Finalizada </title>
</head>
</html>