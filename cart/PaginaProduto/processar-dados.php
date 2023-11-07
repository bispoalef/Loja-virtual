<?php
session_start();
$url = $_SESSION['urlcompl'];

$dom = new domDocument;
libxml_use_internal_errors(true);
$dom->loadHTML($url);
$XPath = new DomXPath($dom);
$tag_produto = $XPath->query('/html/body/main/div[1]/div/form/h2');
$tag_preco =  $XPath->query('/html/body/main/div[1]/div/form/p');

if($tag_produto->length > 0) {
  $node = $tag_produto->item(0);
  $produto = $node->nodeValue;
} 

if($tag_preco->length > 0) {
  $node = $tag_preco->item(0);
  $preco = $node->nodeValue;
}

$cpf = $_POST['cpf'];
$variacao = $_POST['variacao'];
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
$smtp->bind_param("sssss", $cpf, $produto, $variacao, $preco, $data_atual);

if($smtp->execute()){
  echo "Dados salvos no banco!";
}else{
  echo "Erro ".$smtp->error;
}

$smtp->close();
$conn->close();

?>