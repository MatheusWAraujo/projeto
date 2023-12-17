<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="../ASSETS/style.css" />
  <link rel="stylesheet" type="text/css" href="../ASSETS/rodape.css" />
  <title>Pesquisa</title>
</head>

<body>
  <header>
    <a class="logo"><img src="../ASSETS/imgs/Logo.png" /></a>

    <div class="search-box">
      <div class="category">
        <button class="category-button">
          Categorias
          <img class="triangule" src="../ASSETS/imgs/triangule.png" />
        </button>

        <ul class="categories" id="">
          <li><a href="pesquisa.php?category=Roupas%20Impermeáveis">Roupas Impermeáveis</a></li>
          <li><a href="pesquisa.php?category=Cutelaria">Cutelaria</a></li>
          <li><a href="pesquisa.php?category=Lanternas">Lanternas</a></li>
          <li><a href="pesquisa.php?category=Comidas%20Desidratadas">Comidas Desidratadas</a></li>
          <li><a href="pesquisa.php?category=Barracas">Barracas</a></li>
          <li><a href="pesquisa.php?category=Cordas">Cordas</a></li>
          <li><a href="pesquisa.php?category=Mosquetões">Mosquetões</a></li>
          <li><a href="pesquisa.php?category=Boudrie">Boudrie</a></li>
          <li><a href="pesquisa.php?category=Cantil">Cantil</a></li>
        </ul>
      </div>

      <form action="pesquisa.php" method="get">
        <input type="text" placeholder="Pesquisar.." name="search" class="input-search" />
        <button type="submit" class="input-submit"></button>
      </form>
    </div>

    <div class="icons">
      <a href="#" class="icon-prompt">
        <img src="../ASSETS/imgs/Icons/Lapis.png" />
      </a>

      <a href="#" class="icon-prompt">
        <img src="../ASSETS/imgs/Icons/user.png" />
      </a>

      <a href="#" class="icon-prompt">
        <img src="../ASSETS/imgs/Icons/Carrinho.png" />
      </a>

      <a href="#" class="icon-prompt">
        <img src="../ASSETS/imgs/Icons/Sair.png" />
      </a>
    </div>
  </header>

  <div class="container">
    <a class="categoria-name"> Resultados </a>
    <div class="filter">
      <button class="filter-button">
        Filtros <img class="triangule2" src="../ASSETS/imgs/triangule2.png" />
      </button>

      <ul class="filters">
        <li><a
            href="pesquisa.php?search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>&category=<?php echo isset($_GET['category']) ? $_GET['category'] : ''; ?>&order=preco_asc">Menor
            Preço</a></li>
        <li><a
            href="pesquisa.php?search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>&category=<?php echo isset($_GET['category']) ? $_GET['category'] : ''; ?>&order=preco_desc">Maior
            preço</a></li>
      </ul>
    </div>
    <div class="produtos-frame">
      <div class="produtos">
        <?php
        include "../UTILS/db_connection.php";

        // Verifica se a variável de pesquisa ou categoria está definida
        if (isset($_GET["search"]) || isset($_GET["category"])) {
          $search_term = isset($_GET["search"]) ? trim($_GET["search"]) : '';
          $category_filter = isset($_GET["category"]) ? $_GET["category"] : '';
          $order_by = isset($_GET["order"]) ? $_GET["order"] : 'preco_asc'; // Padrão: ordenar por preço crescente
        
          // Constrói a consulta SQL com base no termo de pesquisa e/ou na categoria
          $sql = "SELECT * FROM produto";

          // Adiciona o filtro de categoria, se uma categoria estiver selecionada
          if (!empty($category_filter)) {
            $sql .= " WHERE Categoria = '$category_filter'";
          }

          // Adiciona o filtro de nome, se um termo de pesquisa estiver presente
          if (!empty($search_term)) {
            // Se já houver um filtro de categoria, usa AND, caso contrário, usa WHERE
            $sql .= !empty($category_filter) ? " AND Nome LIKE '%$search_term%'" : " WHERE Nome LIKE '%$search_term%'";
          }

          // Adiciona a ordenação
          if ($order_by == 'preco_asc') {
            $sql .= " ORDER BY CAST(SUBSTRING_INDEX(REPLACE(Preco, 'R$', ''), ',', 1) AS DECIMAL(10,2)) ASC";
          } elseif ($order_by == 'preco_desc') {
            $sql .= " ORDER BY CAST(SUBSTRING_INDEX(REPLACE(Preco, 'R$', ''), ',', 1) AS DECIMAL(10,2)) DESC";
          }

          $result = $connection->query($sql);

          // Exibir os produtos encontrados
          if ($result->num_rows > 0) {
            echo '<div class="produtos">';
            while ($row = $result->fetch_assoc()) {
              echo "<div class='produto'>";
              echo "<div class='estrelas'>";
              echo "<img src='../ASSETS/imgs/Produto/Star.png' />";
              echo "<img src='../ASSETS/imgs/Produto/Star.png' />";
              echo "<img src='../ASSETS/imgs/Produto/Star.png' />";
              echo "<img src='../ASSETS/imgs/Produto/Star.png' />";
              echo "<img src='../ASSETS/imgs/Produto/Star.png' />";
              echo "</div>";

              echo "<div class='produto-img'>";
              echo "<img src='" . $row["Imagem"] . "' alt='" . $row["Nome"] . "'>";
              echo "</div>";

              echo "<a href='#' class='produto-nome'>" . $row["Nome"] . "</a>";
              echo "<a class='produto-preco'>" . $row["Preco"] . "</a>";
              echo "</div>";
            }
            echo '</div>';
          } else {
            echo "<p class='no-results'>Nenhum produto encontrado</p>";
            // Se nenhum produto for encontrado, não exiba os produtos em destaque
          }

          // ... (restante do código PHP)
        } else {
          echo "<p class='no-results'>Informe um termo de pesquisa ou selecione uma categoria</p>";
        }

        $connection->close();
        ?>
      </div>
    </div>
  </div>

  <footer>
    <div class="rodape">
      <div class="coluna">
        <div class="Titulo">Atendimento</div>
        <ul class="coluna-list">
          <li>
            <img src="../ASSETS/imgs/Rodape/Telefone.png" />
            <a>(22) 99123456</a>
          </li>
          <li>
            <img src="../ASSETS/imgs/Rodape/Email.png" />
            <a> outdoorbrazil@com.br </a>
          </li>
        </ul>
      </div>

      <div class="coluna">
        <div class="Titulo">Quem somos?</div>
        <a>
          Nós da Outdoor Camping Brasil, somos uma empresa <br />
          com objetivo de oferecer produtos para aventureiros<br />
          outdoor.</a>
      </div>

      <div class="coluna">
        <div class="Titulo">Redes Sociais</div>
        <ul class="coluna-list">
          <li>
            <img src="../ASSETS/imgs/Rodape/insta.png" />
            <a>@outdoorstore.br</a>
          </li>
          <li>
            <img src="../ASSETS/imgs/Rodape/face.png" />
            <a> outdoorcampbrasil </a>
          </li>
        </ul>
      </div>

      <div class="coluna">
        <div class="Titulo">Formas de pagamento</div>
        <ul class="pagamento-list">
          <li><img src="../ASSETS/imgs/Rodape/pix.png" /></li>
          <li><img src="../ASSETS/imgs/Rodape/nu.png" /></li>
          <li><img src="../ASSETS/imgs/Rodape/santa.png" /></li>
        </ul>
      </div>
    </div>
  </footer>
</body>

</html>