<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rastreamento</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-success text-white text-center p-1 largura">
        <p class="m-0">Toda loja em 12x e <strong>FRETE GRÁTIS</strong></p>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark largura">
        <div class="container-fluid">
            <a class="navbar-brand" href="../Principal/principal.php"><strong>Anime Store</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../Carrinho/carrinho.php">Carrinho</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Sobre/sobre.html">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Rastreamento/rastreamento.php">Rastreamento</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <form action="rastreamento.php">
        <label for="cpf">Digite seu CPF: </label>
        <input type="number" name="cpf" required />
        <input type="submit" value="Rastrear" />
    </form>

    <?php 
    if (isset($_GET["cpf"])) {
        $host = "localhost";
        $db   = "bd_loja";
        $user = "root";
        $pass = "";
        $con = mysqli_connect($host, $user, $pass, $db) or trigger_error(mysqli_error($con), E_USER_ERROR);
        mysqli_select_db($con, $db);
        $cpf = $_GET["cpf"];
        $query = sprintf("SELECT * FROM vendas where cpf ='$cpf'");
        $dados = mysqli_query($con, $query) or die(mysqli_error($con));

        foreach ($dados as $linha) {
            echo "<div class='pedido-info'>";
            echo "<img src='$linha[imagem]' alt='Imagem do Pedido' />";
            echo "<p><strong>Id do pedido:</strong> $linha[id]</p>";
            echo "<p><strong>CPF:</strong> $linha[cpf]</p>";
            echo "<p><strong>Nome do Produto:</strong> $linha[nome_produto]</p>";
            echo "<p><strong>Variação:</strong> $linha[variacao]</p>";
            echo "<p><strong>Preço:</strong> $linha[preco]</p>";
            echo "<p><strong>Data da Compra:</strong> $linha[data]</p>";
            echo "</div>";
        }

        mysqli_free_result($dados);
        mysqli_close($con);
    }
    ?>
   

    <footer class="bg-dark text-white text-center py-3 largura">
        <div class="container-fluid">
            &copy; 2023 Anime Store
        </div>
    </footer>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
