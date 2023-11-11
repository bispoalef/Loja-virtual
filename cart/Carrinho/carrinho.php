<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        <h1>Carrinho de Compras</h1>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
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
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="cart_bar">
            <div class="produtos">Produtos</div>
            <div class="preçoUnitario">Preço Unitário</div>
            <div class="quantidade">Quantidade</div>
            <div class="preçoTotal">Preço</div>
        </div>

        <ul id="product-list">
            <?php
            session_start();
            include_once('../Produtos/conexao.php');
            $sql = "SELECT * FROM vendas ORDER BY id ASC";
            $result = $connection->query($sql);
            $total = 0;
            
            while ($row = $result->fetch_assoc()) {
                $preco = $row['preco'];
                $total += $preco;
            ?>
            <div class="cart_prod">
                <img src="<?= $row['imagem'] ?>" alt="<?= $row['nome_produto'] ?>" style="border-radius: 50%;"
                    class="d-block max-width-100 max-height-100">
                <div class="prod1"><?= $row['nome_produto'] ?></div>
                <div class="descr1">
                    <h2>1</h2>
                    <button onclick="updateValue(this, -1, <?= $preco ?>)">-</button>
                    <button onclick="updateValue(this, 1, <?= $preco ?>)">+</button>
                </div>
                <div class="preco">R$ <?= number_format($preco, 2) ?></div>
            </div>
            <?php
            }
            ?>
        </ul>
        <form method="POST">
            <p>Total: R$ <span id="total"><?= number_format($total, 2) ?></span></p>
            <button id="finalizar" name="finalizar">Finalizar Compra</button>
        </form>

        <script>
        function updateValue(button, change, preco) {
            var h2Element = button.parentElement.querySelector("h2");
            var value = parseInt(h2Element.innerText);
            value += change;
            if (value >= 1) {
                h2Element.innerText = value;
                updateTotal(preco, change);
            }
        }

        function updateTotal(preco, change) {
            var totalElement = document.getElementById("total");
            var total = parseFloat(totalElement.innerText.replace("R$ ", ""));
            total += preco * change;
            totalElement.innerText = "R$ " + total.toFixed(2);
        }
        </script>
        <?php
        if (isset($_POST['finalizar'])) {
            // Coloque aqui o código para finalizar a compra
        }
        ?>
    </main>


    <footer>
        &copy; 2023 Minha Loja Virtual
    </footer>
</body>

</html>