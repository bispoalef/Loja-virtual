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

// Processamento do formulário usando prepared statement
$nome = $_POST['nome'];
$email = $_POST['email'];
$descricao = $_POST['descricao'];

// Prepara a instrução SQL usando um prepared statement
$sql = "INSERT INTO suporte (nome, email, descricao) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

// Vincula os parâmetros e executa a instrução
$stmt->bind_param("sss", $nome, $email, $descricao);

if ($stmt->execute()) {
    echo "Suporte enviado com sucesso";
    // Adiciona o redirecionamento para principal.php após 2 segundos
    echo "<script>setTimeout(function(){ window.location.href = '../Principal/principal.php'; }, 2000);</script>";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

// Fecha a conexão e o statement
$stmt->close();
$conn->close();
?>
