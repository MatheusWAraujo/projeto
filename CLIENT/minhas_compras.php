<?php
    include("../UTILS/session_guest.php");

    if ($_SESSION['PAPEL'] == "GUEST") {
        header('Location: ../PUBLIC/login.php');
    }

    if (!isset($_SESSION['EMAIL'])) {
        header('Location: ../PUBLIC/login.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ASSETS/minhascompra.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/conta.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/style.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/rodape.css">
    <title> Outdoor - Minhas compras </title>
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

            <a href="../PUBLIC/carrinho.php" class="icon-prompt" id="carrinho"> <img src="../ASSETS/imgs/Icons/Carrinho.png"></a>

            <a href="../CLIENT/logout.php" class="icon-prompt" id="logout"> <img src="../ASSETS/imgs/Icons/Sair.png"> </a>
        </div>
    </header>

    <div class="content-account">
        <div class="rectangle">
            <div class="left-side">
                <a href="minha_conta.php"> <img src="../ASSETS/imgs/profile/user.png"> Minha conta</a>
                <a href="minhas_compras.php"> <img src="../ASSETS/imgs/profile/box.png"> Minha compras</a>
                <a href="../PUBLIC/carrinho.php"> <img src="../ASSETS/imgs/profile/cart.png"> Carrinho </a>
            </div>

            <div class="right-side">
                <a class="titler"> Minhas compras</a>
                <div class="compras-itens">
                    <?php
                        include "../UTILS/db_connection.php";

                        $numeros = 0;
                        $txts = 0;

                        $email = $_SESSION['EMAIL'];
                        $id = 0;
                        $sql = "SELECT * FROM usuario";
                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($row['Email'] == $email){
                                    $id = $row['Id'];
                                    break;
                                }
                            }
                        }

                        $sql = "SELECT * FROM compras";
                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($row['id-user'] != $id){
                                    continue;
                                }
                                $numeros++;
                                $txts++;
                                
                                echo "<div class='compra'>";
                                echo "<a class='compra-text' id='texto".$txts."'> Compra de ". $row['quantidade'] ." produtos - ". $row['Data'] ." - ID=".$row['Id']."</a>";
                                echo "<a class='preco-text'> ".$row['Preco']."</a>";
                                echo "<a class='ver' id='ver". $numeros ."'> Abrir </a>";
                                echo "</div>";
                            }
                        }
                    ?>
                    <!--
                        <div class="compra">
                        <a class="compra-text"> Compra de 10 produtos - 21/10/2023</a>
                        <a class="preco-text"> R$ 590,00 </a>
                        <a class="ver" id="ver"> Abrir </a>
                    </div>
                    -->
                </div>
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
        $(document).ready(function() {
            for (var i = 1; i <= 100; i++){
                let id = '#ver' + i;

                let frase = $('#texto' + i).text();
                let Nome = $(id).text();

                $(id).click(function(){
                    let idCompra = 0;

                    matches = frase.match(/ID=(\d+)/);

                    if (matches){
                        idCompra = matches[1];
                    }

                    let Data = {idCompra: idCompra};

                    $.post("utils/check.php", Data, function(response) {
                        if (response == true){
                            window.location.href="compra.php";
                        }
                    }, 'json');
                })
            }  
        })
    </script>

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
            $('#productCreator').attr('href', '../ADMIN/criar_produto.php');
            
            $("#userbutton").show();
            $("#logout").show();
            $("#productCreator").show();
        };

    </script>
</body>


<!--TO-DO: Perfil do usuário, pode ver histórico de compras, alterar senha e sla caralho