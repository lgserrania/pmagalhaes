<?php require_once("conexao/conecta.php") ?>
<?php
    session_start();
    include "include/controle_sessao.php";
?>
<!doctype html>
<html>
   

    <body>
     
        <main>  
            <?php
                //exclui a variável de sessão
                unset($_SESSION["user_portal"]);
                    
                //destroi todas as variaveis de sessão
                session_destroy();

                header("location:login.php");
                
                
            ?>
        </main>

    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>