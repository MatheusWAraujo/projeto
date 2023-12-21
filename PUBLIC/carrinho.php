<?php
    include ("../UTILS/session_guest.php");

    if (!isset($_SESSION['CARRINHO'])) {
        $_SESSION['CARRINHO'] = array();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ASSETS/conta.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/style.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/rodape.css">
    <title> Outdoor - Carrinho </title>
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
                <a href="../CLIENT/minha_conta.php"> <img src="../ASSETS/imgs/profile/user.png"> Minha conta</a>
                <a href="../CLIENT/minhas_compras.php"> <img src="../ASSETS/imgs/profile/box.png"> Minha compras</a>
                <a href="../PUBLIC/carrinho.php"> <img src="../ASSETS/imgs/profile/cart.png"> Carrinho </a>
            </div>

            <div class="right-side">
                <a class="titler" id="card-name"> Carrinho - <?php
                    echo sizeof($_SESSION['CARRINHO']);
                 ?> </a>
                
                <div class="itens-frame">
                    <?php
                        if (sizeof($_SESSION['CARRINHO']) > 0){
                            include "../UTILS/db_connection.php";

                            $sql = "SELECT * FROM produto";
                            $result = $connection->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    
                                    if (isset($_SESSION['CARRINHO'][$row["Id"]])){
                                        $quantidade = $_SESSION['CARRINHO'][$row['Id']];

                                        echo "<div class='product-item'>";
                                        echo "<div class='frame-product'>";
                                        echo "<div class='product-stars'>";

                                        $restante = 5 - $row["Estrelas"];;

                                        for ($i = 0; $i < $row["Estrelas"]; $i++){
                                            echo "<img src='../ASSETS/imgs/Produto/Star.png'>";
                                        };

                                        for ($i = 0; $i < $restante; $i++){
                                            echo "<img src='../ASSETS/imgs/Produto/BlackStar.png'>";
                                        };
                                        echo "</div>";

                                        echo "<div class='product-image'>";

                                        echo "<img src='". $row['Imagem'] . "'>";

                                        echo "</div>";
                                        echo "</div>";

                                        echo "<div class='produtoinfo'>";
                                        echo "<a class='titulo'> " . $row["Nome"] . "</a>";
                                        echo "<a class='preco-prod'> " . $row["Preco"] . "</a>";
                                        echo "<a class='quantity'> Quantidade: " . $quantidade . "</a>";
                                        echo "</div>";
                                        
                                        echo "</div>";
                                    }
                                }
                            }
                        }
                    ?>

                    <!--<div class="product-item">
                        <div class="frame-product">
                            <div class="product-stars">
                                <img src="../ASSETS/imgs/Produto/Star.png">
                                <img src="../ASSETS/imgs/Produto/Star.png">
                                <img src="../ASSETS/imgs/Produto/Star.png">
                                <img src="../ASSETS/imgs/Produto/Star.png">
                                <img src="../ASSETS/imgs/Produto/Star.png">
                            </div>

                            <div class="product-image">
                                <img src="../UPLOADS/Lanternas/1.png">
                            </div>

                        </div>

                        <div class="produtoinfo">
                            <a class="titulo"> Lanterna SD 2.500 UD </a>
                            <a class="preco-prod"> R$ 00,00 </a>
                            <a class="quantity"> Quantidade: 0 </a>
                            <a class="trash" href="#"><img src="../ASSETS/imgs/trash.png"></a>
                        </div>
                    </div>-->
                </div>

                <a id="product-buy" class="product-buy">
                    Fechar compra
                </a>
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
        $('#product-buy').click(function() {

            var data = {name: 'd'};

            $.post("../CLIENT/utils/setter.php", data, function(response) {
                if (response){
                    window.location.href='../CLIENT/fechar_compra.php';
                } else {
                    window.location.href='../PUBLIC/login.php';
                }
            }, 'json');
        });

    </script>

    <script>
        var papel = <?php
            echo json_encode($_SESSION['PAPEL'], JSON_HEX_TAG);
        ?>;

        $("#carrinho").show();

        if (papel == "GUEST") {
            $("#userbutton").attr("href", "../PUBLIC/login.php");

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
