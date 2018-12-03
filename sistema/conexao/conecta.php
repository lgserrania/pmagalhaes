<?php
    //open conection
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "pmagalhaes";
    $conecta = mysqli_connect($servidor,$usuario,$senha,$banco);
    //test conection
   
    if(mysqli_connect_errno()){
        die("Falha ao conectar com o banco de dados!".mysqli_connect_errno());
    }
?>