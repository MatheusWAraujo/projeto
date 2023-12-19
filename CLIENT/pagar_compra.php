<?php
    if (!session_id()) {
        session_start();
    };

    if (!isset($_SESSION['PAPEL'])) {
        $_SESSION['PAPEL'] = "GUEST";
    }

    //conexão do banco de dados gayzinho

    $host = 'localhost'; // endereço do servidor do banco de dados
    $dbname = 'loja'; // nome do banco de dados
    $username = 'ROOT'; // nome de usuário do banco de dados
    $password = 'ROOT'; // senha do banco de dados
    
    $conn = new mysqli($host, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    } 
    //fim da conexão 
    
        $_SESSION['CARRINHO'] = []; //trocar a lista pra porra de sessão de carrinho------
        $lista = [1,1,3,6];
        $valor = 0;
    
       
        foreach ($lista as $id) {
            $sql = "SELECT Preco FROM produto WHERE id = $id";
            $result = $conn->query($sql);
        
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $preco = $row["Preco"];
                // Remove o símbolo 'R$' e qualquer outro caractere que não seja numérico não tira essa porra meu irmão
                $precoNumerico = intval(preg_replace("/[^-0-9\.]/", "", $preco));
        
                $valor += $precoNumerico;
            } else {
                echo "Nenhum resultado encontrado para o ID: $id <br>";
            }
        }
        $conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ASSETS/style.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/rodape.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/boxpag.css">
    <title> Outdoor - Finalizando Pagamento </title>
</head>

<body>
    <header>
        <a class="logo" href="../PUBLIC/home.php"><img src="../ASSETS/imgs/Logo.png"></a>

        <div class="search-box">
            <div class="category">
                <button class="category-button"> Categorias <img class="triangule" src="../ASSETS/imgs/triangule.png"> </button>

                <ul class="categories" id="">
                    <li><a class="section-a" href="../PUBLIC/pesquisa.php?category=Roupas%20Impermeáveis">Roupas Impermeáveis</a></li>
                    <li><a class="section-a" href="../PUBLIC/pesquisa.php?category=Cutelaria">Cutelaria</a></li>
                    <li><a class="section-a" href="../PUBLIC/pesquisa.php?category=Lanternas">Lanternas</a></li>
                    <li><a class="section-a" href="../PUBLIC/pesquisa.php?category=Comidas%20Desidratadas">Comidas Desidratadas</a></li>
                    <li><a class="section-a" href="../PUBLIC/pesquisa.php?category=Barracas">Barracas</a></li>
                    <li><a class="section-a" href="../PUBLIC/pesquisa.php?category=Cordas">Cordas</a></li>
                    <li><a class="section-a" href="../PUBLIC/pesquisa.php?category=Mosquetões">Mosquetões</a></li>
                    <li><a class="section-a" href="../PUBLIC/pesquisa.php?category=Boudrie">Boudrie</a></li>
                    <li><a class="section-a" href="../PUBLIC/pesquisa.php?category=Cantil">Cantil</a></li>
                </ul>
            </div>

            <form action="../PUBLIC/pesquisa.php" method="get">
                <input type="text" placeholder="Pesquisar.." name="search" class="input-search" />
                <button type="submit" class="input-submit"></button>
            </form>
        </div>

        <div class="icons">
            <a href="#" class="icon-prompt" id="productCreator"> <img src="../ASSETS/imgs/Icons/Lapis.png"></a>

            <a href="#" class="icon-prompt" id="userbutton"> <img src="../ASSETS/imgs/Icons/user.png"> </a>

            <a href="../CLIENT/carrinho.php" class="icon-prompt" id="carrinho"> <img src="../ASSETS/imgs/Icons/Carrinho.png"></a>

            <a href="../CLIENT/logout.php" class="icon-prompt" id="logout"> <img src="../ASSETS/imgs/Icons/Sair.png"> </a>
        </div>
    </header>

    <div class="content-account">
        <div class="rectangle">
            <div class="up-side">

            <?php
            $valor = number_format($valor / 100, 2, ',', '.'); 
            echo "<a>Valor : $valor R$</a>";
            ?>
            </div>

            <div class="down-side">
                <h1>Escolha um método de pagamento:</h1>      
                <div class="content">
              <form action="processa_pagamento.php" method="POST">  
   <input type="radio" class="radio-button" name="met-pagamento"></input>
   <label for="pix">PIX</label>

   <input type="radio" class="radio-button" name="met-pagamento"></input>
   <label for="cartao">Cartão de Crédito</label>

   <input type="radio" class="radio-button" name="met-pagamento"></input>
   <label for="dinheiro">Dinheiro</label>
</div>
<button type="submit" id="buy-button">PAGAR</button>
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
    <script>
        var papel = <?php
            echo json_encode($_SESSION['PAPEL'], JSON_HEX_TAG);
        ?>;

        $("#carrinho").show();

        if (papel == "GUEST") {
            $("#userbutton").attr("href", "login.php");

            $("#userbutton").show();
            $("#logout").hide();
            $("#productCreator").hide();

        } else if (papel == "USER") {
            $("#userbutton").attr("href", "../CLIENT/minha_conta.php");
            
            $("#userbutton").show();
            $("#logout").show();
            $("#productCreator").hide();

        } else if (papel == "ADM") {
            $("#userbutton").attr("href", "../CLIENT/minha_conta.php");

            $("#userbutton").show();
            $("#logout").show();
            $("#productCreator").show();
        };


        
        document.getElementById("buy-button").addEventListener("click", function(event) {
            var radios = document.getElementsByName("met-pagamento");
            var selected = false;

            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    selected = true;
                    break;
                }
            }

            if (!selected) {
                event.preventDefault(); // Impedindo o envio do formulário
                alert("Selecione um método de pagamento!");
            }
        });
    </script>
</body>


<!--TO-DO: Perfil do usuário, pode ver histórico de compras, alterar senha e sla caralho
