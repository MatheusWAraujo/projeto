<?php
    include ("../UTILS/session_guest.php");

    if ($_SESSION['PAPEL'] == "GUEST") {
        header('Location: ../PUBLIC/login.php');
    }

    if (!isset($_SESSION['EMAIL'])) {
        header('Location: ../PUBLIC/login.php');
    }

    if (!isset($_SESSION['VERCOMPRA'])){
        header('Location: ../CLIENT/minhas_compras.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ASSETS/fecharcompra.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/style.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/rodape.css">
    <title> Outdoor - Compra </title>
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

    <div class="content-payment">
        <div class="rectangle">
            <div class="left-side">
                <div class="sides">
                    <?php
                        if ($_SESSION['VERCOMPRA']){
                            include "../UTILS/db_connection.php";

                            $sql = "SELECT * FROM compras";
                            $result = $connection->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $current_id = $row['Id'];

                                    if ($current_id == $_SESSION['VERCOMPRA']){
                                        echo "<a class='a-text' id='quantidade'>".$row['quantidade']." produtos </a>";
                                        echo "<a class='a-text' id='preco'> Preço: ".$row['Preco']."</a>";
                                        echo "<a class='a-text' id='data'> Data de compra: ".$row['Data']." </a>";

                                        if ($row['Paga'] == true) {
                                            echo "<a class='a-text' > Foi pago? <img src='../ASSETS/imgs/correct.png'> </a>";
                                        } else {
                                            echo "<a class='a-text' > Foi pago? <img src='../ASSETS/imgs/wrong.png'> </a>";
                                        }

                                        if ($row['Entregue'] == true) {
                                            echo "<a class='a-text' > Foi entregue? <img src='../ASSETS/imgs/correct.png'> </a>";
                                        } else {
                                            echo "<a class='a-text' > Foi entregue? <img src='../ASSETS/imgs/wrong.png'> </a>";
                                        }

                                        break;
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <a href="minhas_compras.php" class="voltar2"> Voltar </a>
            </div>

            <div class="right-side">
                <div class="itens-frame">
                    <?php
                        if ($_SESSION['VERCOMPRA']){
                            include "../UTILS/db_connection.php";

                            $sql = "SELECT * FROM itemcompra";
                            $result = $connection->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    if ($row['IdCompra'] == $_SESSION['VERCOMPRA']){
                                        $idProduto = $row['IdProduto'];
                                        
                                        $sqlProdutos = "SELECT * FROM produto";
                                        $resultado = $connection->query($sqlProdutos);

                                        if ($resultado->num_rows > 0) {
                                            while ($rou = $resultado->fetch_assoc()) {
                                                if ($rou['Id'] != $idProduto){
                                                    continue;
                                                }

                                                
                                                echo "<div class='product-item'>";
                                                echo "<div class='frame-product'>";
                                                echo "<div class='product-stars'>";

                                                $restante = 5 - $rou["Estrelas"];;

                                                for ($i = 0; $i < $rou["Estrelas"]; $i++){
                                                    echo "<img src='../ASSETS/imgs/Produto/Star.png'>";
                                                };

                                                for ($i = 0; $i < $restante; $i++){
                                                    echo "<img src='../ASSETS/imgs/Produto/BlackStar.png'>";
                                                };
                                                echo "</div>";

                                                echo "<div class='product-image'>";
                                                echo "<img src='". $rou['Imagem'] . "'>";

                                                echo "</div>";
                                                echo "</div>";


                                                echo "<div class='produtoinfo'>";
                                                echo "<a class='titulo'> " . $rou["Nome"] . "</a>";
                                                echo "<a class='preco-prod'> " . $rou["Preco"] . "</a>";
                                                echo "<a class='quantity'> Quantidade: " . $row['Quantidade'] . "</a>";
                                                echo "</div>";
                                                
                                                echo "</div>";
                                            }
                                        }
                                    }
                                }
                            }

                            echo "</div>";
                            unset($_SESSION['VERCOMPRA']);
                        }

                    ?>

                    <!-- ?php
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
                    ?> -->
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
    <!--<script src="scripts/dados.js"></script> -->
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

