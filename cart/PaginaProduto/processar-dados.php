<?php
$cpf = $_POST['cpf'];

if($cpf == null){
  $cpf = null;
}

$produto = $_POST['produto'];
$variacao = $_POST['variacao'];
$preco = $_POST['preco'];
$data_atual = date('d/m/Y');

$server = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'bd_loja';

$conn = new mysqli($server, $usuario, $senha, $banco);

if($conn -> connect_error){
  echo "Error:" .$conn ->connect_error;
}

$smtp = $conn -> prepare("INSERT INTO vendas (cpf, nome_produto, variacao,preco, data) VALUES (?,?,?,?,?)");
$smtp->bind_param("issss", $cpf, $produto, $variacao, $preco, $data_atual);

if($smtp->execute()){
  echo "Dados salvos no banco!";
}else{
  echo "Erro ".$smtp->error;
}

$smtp->close();
$conn->close();

?>