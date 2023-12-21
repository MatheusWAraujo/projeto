<?php
    include ("../UTILS/session_guest.php");

    if ($_SESSION['PAPEL'] != "GUEST") {
        header('Location: home.php');
    }

    if (!isset($_SESSION['CARRINHO'])) {
        $_SESSION['CARRINHO'] = array();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("../UTILS/db_connection.php");

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usrSQL = "SELECT * FROM usuario";
        $result = $connection->query($usrSQL);

        if ($result) {
            if ($result->num_rows < 1) {
                $connection->close();
                echo json_encode(false);
                exit;

            } else {
                while ($row = $result->fetch_assoc()) {
                    if ($row["Email"] == $email && $row["Senha"] == $senha) {
                        $_SESSION['PAPEL'] = $row["Papel"];
                        $_SESSION["EMAIL"] = $row["Email"];

                        $connection->close();
                        echo json_encode(true);
                        exit;
                    }
                }
            };
        }
        
        echo json_encode(false);
        $connection->close();
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ASSETS/rodape.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/login.css">
    <title> Outdoor - Login </title>
</head>

<body>
    <div class="main-content">
        <div class="left-img">
            <img src="../ASSETS/imgs/Computador.png">
        </div>

        <div class="right-login">
            <div class="card">
                <form method="post" class="form">
                    <label class="LoginText">Login</label>

                    <label class="text-title" for="email">Email:</label>
                    <input class="input" placeholder="Coloque seu email" type="email" id="email" name="email" required>
                    <br>
                    <label class="text-title" for="senha">Senha:</label>
                    <input class="input" placeholder="Coloque sua senha" type="password" id="senha" name="senha" required>

                    <label class="erro" id="alert"></label>

                    <br>
                    <input class="submit" type="button" value="Entrar" id="loginbutton">
                    <label class="alert"> Não tem uma conta? <a class="link" href="cadastro.php"><u>criar uma.</u></a></label>
                    <label class="alert"> <a class="link" href="home.php"> <img src="../ASSETS/imgs/house.png"> </a></label>
                </form>
            </div>
            
        </div>
    </div>
    
    <footer>
        <div class="rodape">
            <div class="coluna">
                <div class="Titulo"> Atendimento </div>
                <ul class="coluna-list">
                    <li> <img src="../ASSETS/imgs/Rodape/Telefone.png"> <a>(22) 99123456</a> </li>
                    <li> <img src="../ASSETS/imgs/Rodape/Email.png"> <a> outdoorbrazil@com.br </a> </li>
                </ul>
            </div>

            <div class="coluna">
                <div class="Titulo"> Quem somos? </div>
                <a> Nós da Outdoor Camping Brasil, somos uma
                    empresa <br> com objetivo de oferecer produtos
                    para aventureiros<br> outdoor.</a>
            </div>

            <div class="coluna">
                <div class="Titulo"> Redes Sociais </div>
                <ul class="coluna-list">
                    <li> <img src="../ASSETS/imgs/Rodape/insta.png"> <a>@outdoorstore.br</a> </li>
                    <li> <img src="../ASSETS/imgs/Rodape/face.png"> <a> outdoorcampbrasil </a> </li>
                </ul>
            </div>

            <div class="coluna">
                <div class="Titulo"> Formas de pagamento </div>
                <ul class="pagamento-list">
                    <li> <img src="../ASSETS/imgs/Rodape/pix.png"> </li>
                    <li> <img src="../ASSETS/imgs/Rodape/nu.png"></li>
                    <li> <img src="../ASSETS/imgs/Rodape/santa.png"></li>
                </ul>
            </div>
        </div>
      </footer>

      <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
      <script src="scripts/login.js"></script>
</body>
