<?php
//testar
// class URI {

//   /**
//    * $protocolo
//    * @var string | $protocolo
//    * @access private
//    */
//   static private $protocolo;
//   /**
//    * $host
//    * @var string | $host
//    * @access private
//    */
//   static private $host;
//   /**
//    * $scriptName
//    * @var string | $scriptName
//    * @access private
//    */
//   static private $scriptName;
//   /**
//    * $finalBase
//    * @var string | $finalBase
//    * @access private
//    */
//   static private $finalBase;
  
//   /**
//    * protected function Protocolo()
//    * ----------------------------------------------
//    *            Obtém o protocolo da url
//    * ----------------------------------------------
//    * @return string | Ex: http://... - https://...
//    * @access protected
//    */
//   protected function Protocolo()
//   {
//       /**
//        * Faz a verificação se for
//        * diferente de https
//        */
//       if(strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === false)
//       {
//           self::$protocolo = 'http://'; //Atribui o valor http
//       }
//       else
//       {
//           self::$protocolo = 'https://'; //Atribui o valor https
//       }
//       /**
//        * Retorna o protocolo em formato string
//        * @var string
//        */
//       return self::$protocolo;
//   }
//   /**
//    * protected function Host()
//    * ----------------------------------------------
//    *            Obtém o host principal
//    * ----------------------------------------------
//    * @return string | Ex: www.example.com.br
//    * @access protected
//    */
//   protected function Host()
//   {
//       self::$host = $_SERVER['HTTP_HOST']; //Atribui o valor www.example.com.br
//       /**
//        * Retorna o host em formato string
//        * @var string
//        */
//       return self::$host;
//   }
//   /**
//    * protected function scriptName()
//    * ----------------------------------------------
//    * Obtém o script name do host após a primeira barra
//    * ----------------------------------------------
//    * @return string | Ex: .../dir/index.php
//    * @access protected
//    */
//   protected function scriptName()
//   {
//       /**
//        * $scr
//        * Atribui o valor do SCRIPT_NAME em uma
//        * variável $scr e utiliza-se a função dirname()
//        * para remover qualquer nome de arquivo .html, .php, etc...
//        * @var string
//        */
//       $scr = dirname($_SERVER['SCRIPT_NAME']);
//       /**
//        * Faz a contagem de barras que contém a url principal
//        * o objetivo aqui é pegar o nível de pasta onde hospeda-se o diretório
//        * caso ele exista.
//        */
//       if(!empty($scr) || substr_count($scr, '/') > 1)
//       {
//           self::$scriptName = $scr . '/'; //atribui o valor do diretório com uma "/" na sequência
//       }
//       else
//       {
//           self::$scriptName = ''; //atribui um valor vazio
//       }
//       /**
//        * Retorna o scriptName em formato string
//        * @var string
//        */
//       return self::$scriptName;
//   }
//   /**
//    * public function base()
//    * ----------------------------------------------
//    *          Monta a url base e retorna
//    * ----------------------------------------------
//    * @return [type] [description]
//    * @access public
//    */
//   public function base()
//   {
//       //Concatena os valores
//       self::$finalBase = self::Protocolo() . self::Host() . self::scriptName();
//       /**
//        * Retorna toda a url construida em formato string
//        * @var string
//        */
//       return self::$finalBase;
//   }
//   }

// $uri = URI::base(); 

// echo $uri;



// $protocolo = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=="on") ? "https" : "http");
// $url = '://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'?'.$_SERVER['QUERY_STRING'];

// echo $protocolo.$url; 

$url = file_get_contents('http://localhost/Loja-virtual/cart/PaginaProduto/index.html');

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