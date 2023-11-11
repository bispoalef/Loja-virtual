<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto 1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <script src="script.js"></script>
    <header class="bg-success text-white text-center p-1">
        <p class="m-0">Toda loja em 12x e <strong>FRETE GRÁTIS</strong></p>
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
                        <a class a="nav-link" href="../Carrinho/carrinho.html">Carrinho</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Sobre/sobre.html">Sobre</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
       
        <div id="produtoSelecionado"></div>
    </main>
    
    <?php
    $produtoID = isset($_GET['id']) ? $_GET['id'] : null;
    $produtoSelecionado = '<div id="produtoSelecionado"></div>';

    session_start();
                include_once('../Produtos/conexao.php');
                $sql = "SELECT * FROM products WHERE id = $produtoID ";
                $result = $connection->query($sql);
                $firstItem = true;

    $product = null;
    if ($produtoID !== null) {
        foreach ($result as $item) {
            if ($item['id'] == $produtoID) {
                $product = $item;
                break;
            }
        }
    }

    if ($product) {
        $produtoSelecionado .= '
            <div class="container-product">
                <img class="product-image" src="' . $product['image'] . '" alt="' . $product['name'] . '">
                <div class="product-info">
                    <form id="form" action="processar-dados.php" method="post">
                        <h2>' . $product['name'] . '</h2>
                        <input type="hidden" value="' . $product['name'] . '" name="produto" />
                        <h5>Selecione a variação</h5>
                        <input type="radio" name="variacao" value="p" ' . ($product['size'] === 'P' ? 'checked' : '') . '>
                        <label for="size">P</label>
                        <input type="radio" name="variacao" value="m" ' . ($product['size'] === 'M' ? 'checked' : '') . '>
                        <label for="size">M</label>
                        <input type="radio" name="variacao" value="g" ' . ($product['size'] === 'G' ? 'checked' : '') . '>
                        <label for="size">G</label>
                        <h5>Preço:</h5>
                        <p>R$' . number_format($product['price'], 2) . '</p>
                        <input type="hidden" value="' . number_format($product['price'], 2) . '" name="preco" />
                        <h5>Insira o CPF para validar a compra:</h5>
                        <input type="text" placeholder="Digite apenas números..." autocomplete="off" id="cpf" name="cpf" maxlength="11" required>
                        <button type="submit">Comprar</button>
                    </form>
                </div>
            </div>
            <div class="product-description">
                <h3>' . $product['descriptionTitle'] . '</h3>
                <p>' . $product['description'] . '</p>
            </div>';
    } else {
        $produtoSelecionado .= 'Produto não encontrado.';
    }

    echo $produtoSelecionado;
    ?>
    
</body>
<footer class="bg-dark text-white text-center py-3">
        &copy; 2023 Minha Loja Virtual
    </footer>
</html>
