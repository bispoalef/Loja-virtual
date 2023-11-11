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
?>