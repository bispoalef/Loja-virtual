<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_loja";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta SQL para listar usuários
$sql = "SELECT id, nome, email, descricao FROM suporte";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibe os usuários em uma tabela
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>descricao</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['nome']}</td><td>{$row['email']}</td><td>{$row['descricao']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum usuário cadastrado.";
}

$conn->close();
?>
