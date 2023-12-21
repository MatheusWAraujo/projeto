<?php
    include ("../UTILS/session_guest.php");
    
    if ($_SESSION['PAPEL'] != "GUEST") {
        header('Location: home.php');
    }

    if (!isset($_SESSION['CARRINHO'])) {
        $_SESSION['CARRINHO'] = array();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ASSETS/rodape.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/cadastro.css">
    <title> Outdoor - Cadastro </title>
</head>

<body>
    <div class="main-content">
        <div class="left-img">
            <img src="../ASSETS/imgs/Computador.png">
        </div>

        <div class="right-login">
            <div class="card">
                <form action="#" id="pessoa" class="form1">
                    <label class="LoginText">Cadastre-se</label>

                    <label class="text-title">Nome:</label>
                    <input class="input" placeholder="Coloque seu nome" type="text" id="nome" required>
                    <br>

                    <label class="text-title"> Estado: </label>
                    <input class="input" placeholder="Coloque seu estado" type="text" id="estado" required>
                    <br>

                    <label class="text-title"> Cidade: </label>
                    <input class="input" placeholder="Coloque sua cidade" type="text" id="cidade" required>
                    <br>

                    <label class="text-title"> Bairro: </label>
                    <input class="input" placeholder="Coloque seu bairro" type="text" id="bairro" required>
                    <br>

                    <label class="text-title"> Logradouro: </label>
                    <input class="input" placeholder="Coloque seu Logradouro" type="text" id="logradouro" required>
                    <br>

                    <label class="text-title"> Número: </label>
                    <input class="input" placeholder="Coloque o número da sua casa" type="text" id="casanumero" required>

                    <label class="erro" id="alert"> </label>

                    <br>
                    <input class="submit" type="button" value="Continuar" id="continue">
                    <label class="alert"> Já tem uma conta? <a class="link" href="login.php"><u>entrar</u></a></label>
                </form>

                <form action="recebe.php" id="usuario" class="form2">
                    <label class="LoginText"> Termine o cadastro. </label>

                    <label class="text-title"> Email: </label>
                    <input class="input" placeholder="Coloque seu email" type="text" id="email" required>
                    <br>

                    <label class="text-title">Senha:</label>
                    <input class="input" placeholder="Coloque sua senha" type="password" id="senha" required>
                    <br>

                    <label class="text-title">Confirme sua senha:</label>
                    <input class="input" placeholder="Coloque sua senha" type="password" id="senha2" required>
                    <label class="erro" id="alert2"> </label>
                    <br>
                    <input class="submit" type="button" value="Criar" id="cadastrar">
                    <label class="alert"> Já tem uma conta? <a class="link" href="login.php"><u>entrar</u></a></label>

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
      <script src="scripts/cadastro.js"></script>
</body>