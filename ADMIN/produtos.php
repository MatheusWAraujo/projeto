<?php
    if (!session_id()) {
        session_start();
    };

    if (!isset($_SESSION['PAPEL'])) {
        $_SESSION['PAPEL'] = "GUEST";
    }

    if ($_SESSION['PAPEL'] != "ADM"){
        header("Location: nao_autorizado.php");
    }
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/painel.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/style.css">
    <link rel="stylesheet" type="text/css" href="../ASSETS/rodape.css">
    <title> ADM - Produtos </title>
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
                <a href="criar_produto.php"> <img src="../ASSETS/imgs/profile/Lapis.png"> Criar produto </a>
                <a href="produtos.php"> <img src="../ASSETS/imgs/profile/boxx.png"> Produtos </a>
                <a href="comprasloja.php"> <img src="../ASSETS/imgs/profile/work.png"> Compras loja </a>
            </div>

            <div class="right-side">
                <a class="titler"> Criar produto</a>
                <div class="right-all-side">
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                            <th>Imagem</th>
                            <th>Ações</th>
                        </tr>

                        <?php
                            include ('../UTILS/db_connection.php');

                            $sql = "SELECT id, nome, categoria, preco, imagem FROM produto";

                            $result = $connection->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["nome"] . "</td>";
                                    echo "<td>" . $row["categoria"] . "</td>";
                                    echo "<td>" . $row["preco"] . "</td>";
                                    echo "<td><img src='" . $row["imagem"] . "' alt='Imagem' width='50'></td>";
                                    echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> | <a href='excluir.php?id=" . $row["id"] . "'>Excluir</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>Nenhum produto encontrado</td></tr>";
                            }
                        ?>

                    </table>
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