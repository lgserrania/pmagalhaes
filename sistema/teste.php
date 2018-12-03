<?php
    require_once("conexao/conecta.php");

    $query = "SELECT * FROM tb_post as p INNER JOIN tb_categoria as c ON p.categoriaPost = c.idCategoria";
    $lista_posts = mysqli_query($conecta,$query);
    if($lista_posts){
        foreach($lista_posts as $post){
            echo $post["nomeCategoria"] . "<br>";
        }
    }
?>
