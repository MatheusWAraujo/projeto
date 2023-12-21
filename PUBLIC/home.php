<?php 
    include ("../UTILS/session_guest.php");

    if (!isset($_SESSION['CARRINHO'])) {
        $_SESSION['CARRINHO'] = array();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("../UTILS/db_connection.php");

        $usrSQL = "SELECT * FROM produto";
        $result = $connection->query($usrSQL);

        if ($result) {
            if ($result->num_rows < 1) {
                $connection->close();
                exit;

            } else {
                while ($row = $result->fetch_assoc()) {
                    if ($row["Nome"] == $_POST['nome']) {
                        $_SESSION['CARRINHO'][$row['Id']] = $_SESSION['CARRINHO'][$row['Id']] + 1;
                        echo json_encode($row['Id']);
                        $connection->close();
                        exit;
                    }
                }
            }
        }

        echo json_encode($row['Id']);
        $connection->close();
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ASSETS/style.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/rodape.css">
    <title> Outdoor - Início </title>
</head>

<body>
    <header>
        <a class="logo" href="home.php"><img src="../ASSETS/imgs/Logo.png"></a>

        <div class="search-box">
            <div class="category">
                <button class="category-button"> Categorias <img class="triangule" src="../ASSETS/imgs/triangule.png"> </button>

                <ul class="categories" id="">
                    <li><a class="section-a" href="pesquisa.php?category=Roupas%20Impermeáveis">Roupas Impermeáveis</a></li>
                    <li><a class="section-a" href="pesquisa.php?category=Cutelaria">Cutelaria</a></li>
                    <li><a class="section-a" href="pesquisa.php?category=Lanternas">Lanternas</a></li>
                    <li><a class="section-a" href="pesquisa.php?category=Comidas%20Desidratadas">Comidas Desidratadas</a></li>
                    <li><a class="section-a" href="pesquisa.php?category=Barracas">Barracas</a></li>
                    <li><a class="section-a" href="pesquisa.php?category=Cordas">Cordas</a></li>
                    <li><a class="section-a" href="pesquisa.php?category=Mosquetões">Mosquetões</a></li>
                    <li><a class="section-a" href="pesquisa.php?category=Boudrie">Boudrie</a></li>
                    <li><a class="section-a" href="pesquisa.php?category=Cantil">Cantil</a></li>
                </ul>
            </div>

            <form action="pesquisa.php" method="get">
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

    <div class="container">
        <a class="categoria-name"> Destaques </a>
        <div class="filter">
            <button class="filter-button"> Filtros <img class="triangule2" src="../ASSETS/imgs/triangule2.png"> </button>

            <ul class="filters">
                <li><a class="section-a" href="pesquisa.php?search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>&category=<?php echo isset($_GET['category']) ? $_GET['category'] : ''; ?>&order=preco_asc" >Menor
                Preço</a></li>
                
                <li><a class="section-a" href="pesquisa.php?search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>&category=<?php echo isset($_GET['category']) ? $_GET['category'] : ''; ?>&order=preco_desc">Maior
                preço</a></li>
            </ul>
        </div>
        <div class="produtos-frame">
            <div class="produtos">
                <?php
                    include "../UTILS/db_connection.php";

                    $sql = "SELECT * FROM produto ORDER BY Estrelas DESC LIMIT 10";
                    $result = $connection->query($sql);
                    
                    $num = 0;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $num += 1;

                            echo "<div class='produto'>";
                            echo "<div class='estrelas'>";

                            $restante = 5;

                            for ($i = 0; $i < $row["Estrelas"]; $i++){
                                echo "<img src='../ASSETS/imgs/Produto/Star.png' />";
                            };

                            $restante -= $row["Estrelas"];

                            for ($i = 0; $i < $restante; $i++){
                                echo "<img src='../ASSETS/imgs/Produto/BlackStar.png' />";
                            };
                            
                            echo "</div>";

                            echo "<div class='produto-img'>";
                            echo "<img src='" . $row["Imagem"] . "' alt='" . $row["Nome"] . "'>";
                            echo "</div>";

                            $nome = 'product-cart-click' . $num;
                            echo "<a href='#' id='$nome' class='produto-nome'>".$row["Nome"]."</a>";
                            echo "<a class='produto-preco'>" . $row["Preco"] . "</a>";
                            echo "</div>";
                        }
                    }
                ?>
                <!--<a id="product-cart-click"> Lanterna Tática SD 2.500 </a> -->
                 <!--<div class="produto" >
                    <div class="estrelas">
                        <img src="../ASSETS/imgs/Produto/Star.png">
                        <img src="../ASSETS/imgs/Produto/Star.png">
                        <img src="../ASSETS/imgs/Produto/Star.png">
                        <img src="../ASSETS/imgs/Produto/Star.png">
                        <img src="../ASSETS/imgs/Produto/Star.png">
                    </div>
                    
                    <div class="produto-img">
                        <img src="../UPLOADS/Lanternas/1.png">
                    </div>

                    <input class="produto-nome" type="button" value="Entrar" id="loginbutton">
                    <a href="#" class="produto-nome"> Lanterna Tática UD S 2.500 </a>
                    <a class="produto-preco"> R$ 54,99</a>
                </div>-->
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
      <script src="scripts/inserir_carrinho_home.js"></script>
      <script>
        var papel = <?php
            echo json_encode($_SESSION['PAPEL'], JSON_HEX_TAG);
        ?>;

        var session = <?php echo json_encode(isset($_SESSION['LOGIN-TO-BUY']), JSON_HEX_TAG)?>; 

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

            if (session == true) {
                var data = {name: 'd'};

                window.location.href='utils/verifier.php';
            }

        } else if (papel == "ADM") {
            $("#userbutton").attr("href", "../CLIENT/minha_conta.php");
            $('#productCreator').attr('href', '../ADMIN/criar_produto.php');

            $("#userbutton").show();
            $("#logout").show();
            $("#productCreator").show();

            if (session == true) {
                var data = {name: 'd'};

                window.location.href='utils/verifier.php';
            }
        };

      </script>
</body>

</html>