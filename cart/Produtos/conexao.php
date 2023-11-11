<?php
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'bd_loja';
    
    $connection = new mysqli($server,$user,$password,$database);

     if($connection->connect_error)
     {
         echo "Erro";
     }
     else
     {
         echo "Conexão com banco de dados efetuada com sucesso";
     }

?>