<!DOCTYPE html>
<html lang="pt-br">
<body>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            </ol>
            <div class="carousel-inner">
                <?php
                session_start();
                include_once('conexao.php');
                $sql = "SELECT * FROM products ORDER BY id DESC";
                $result = $connection->query($sql);
                $firstItem = true;

                while ($row = $result->fetch_assoc()) {
                    $carouselItemClass = $firstItem ? 'active' : '';
                ?>
                <div class="carousel-item <?= $carouselItemClass ?>">
                    <div class="d-flex justify-content-between">
                        <img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>" style="border-radius: 50%;" class="d-block max-width-100 max-height-100">
                        <div class="carousel-caption" style="color: #333; padding: 10px;">
                            <h3><?= $row['name'] ?></h3>
                            <p><?= $row['description'] ?></p>
                            <p>Preço: R$ <?= number_format($row['price'], 2) ?></p>
                            <a href="../PaginaProduto/detalhes.php?id=<?= $row['id'] ?>">Detalhes</a>
                        </div>
                    </div>
                </div>
                <?php
                    $firstItem = false;
                }
                ?>
            </div>
        </div>

        <ul id="product-list">
            <?php
            $result = $connection->query($sql);

            while ($row = $result->fetch_assoc()) {
            ?>
            <li>
                <h2><?= $row['name'] ?></h2>
                <p><?= $row['description'] ?></p>
                <p>Preço: R$ <?= number_format($row['price'], 2) ?></p>
                <a href="../PaginaProduto/detalhes.php?id=<?= $row['id'] ?>">Detalhes</a>
            </li>
            <?php
            }
            ?>
        </ul>
  
</body>
</html>
