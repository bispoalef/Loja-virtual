<?php

session_start();
$protocolo = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=="on") ? "https" : "http");
$url = '://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'?'.$_SERVER['QUERY_STRING'];

$_SESSION['urlcompl'] = $protocolo.$url;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto 1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <header class="bg-success text-white text-center p-1">
        <p class="m-0">Toda loja em 12x e <strong>FRETE GRÁTIS</strong></p>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../Principal/principal.html"><strong>Anime Store</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../Carrinho/carrinho.html">Carrinho</a>
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

    <footer class="bg-dark text-white text-center py-3">
        &copy; 2023 Minha Loja Virtual
    </footer>

    <script>
        const arquivoJSON = '../Principal/mock.json';
        const url = new URL(window.location.href);
        const produtoID = url.searchParams.get('id');
        const produtoSelecionado = document.getElementById('produtoSelecionado');

        fetch(arquivoJSON)
            .then(response => response.json())
            .then(data => {
                const product = data.find(product => product.id == produtoID);
                if (product) {
                    produtoSelecionado.innerHTML = `
                    <div class="container-product">
                        <img class="product-image" src="${product.image}" alt="${product.name}">
                        <div class="product-info">
                            <form action="processar-dados.php" method="post">
                                <h2">${product.name}</h2>
                                <h5>Selecione a variação</h5>
                                <input type="radio" name="variacao" value="p" ${product.size === 'P' ? 'checked' : ''}>
                                <label for="size">P</label>
                                <input type="radio" name="variacao" value="m" ${product.size === 'M' ? 'checked' : ''}>
                                <label for="size">M</label>
                                <input type="radio" name="variacao" value="g" ${product.size === 'G' ? 'checked' : ''}>
                                <label for="size">G</label>
                                <h5>Preço:</h5>
                                <p>R$${product.price.toFixed(2)}</p>
                                <h5>Insira o cpf para validar a compra:</h5>
                                <input type="text" autocomplete="off" id="cpf" name="cpf" maxlength="14">
                                <button type="submit">Comprar</button>
                            </form>
                        </div>
                    </div>
                    <div class="product-description">
                        <h3>${product.descriptionTitle}</h3>
                        <p>${product.description}</p>
                    </div>`;
                } else {
                    produtoSelecionado.innerHTML = 'Produto não encontrado.';
                }
            })
            .catch(error => {
                console.error('Erro ao buscar e exibir o produto JSON:', error);
            });
    </script>
    <script src="script.js"></script>
</body>

</html>