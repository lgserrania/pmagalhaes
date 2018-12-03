<?php

    //consulta ao banco de dados - usuarios
    $saudacao = "SELECT idUsuario, nomeUsuario, emailUsuario ";
    $saudacao .= "FROM tb_usuarios ";
    $saudacao_login = mysqli_query($conecta,$saudacao);
    if(!$saudacao_login){
        die("Falha na conexão com o banco!!");
    }else{
        $user = mysqli_fetch_assoc($saudacao_login);
        $nome = $user["nomeUsuario"];
        
    } 
    //contagem no banco
    $soma_usuario = "SELECT * FROM tb_usuarios";
    $query = mysqli_query($conecta, $soma_usuario) or die(mysqli_error());
    $total = mysqli_num_rows($query); // retorna o número de linhas da ultima query

    $soma_categoria = "SELECT * FROM tb_categoria";
    $query_categoria = mysqli_query($conecta, $soma_categoria) or die(mysqli_error());
    $total_categoria = mysqli_num_rows($query_categoria);
 
    $query_artigos = "SELECT * FROM tb_post";
    $artigos = mysqli_query($conecta, $query_artigos) or die(mysqli_error());
    $total_artigos = mysqli_num_rows($artigos);
    

?>
    
<?php
    //definindo fuso horário
    date_default_timezone_set('America/Sao_Paulo');
    //pegando a hora local
    date_default_timezone_set('America/Sao_Paulo');
    setlocale(LC_TIME, "pt_BR", "pt_BR.utf-8", "portuguese");
    $agora = getdate();
    $ano = $agora["year"];
    $mes = $agora["mon"];
    $diaMes = $agora["mday"];

    $dia = strftime("%A");


    $hora = $agora["hours"]. ":". $agora["minutes"]. ":". $agora["seconds"];

    //data local 
    

?>
<!doctype html>
<html class="no-js" lang="pt-BR"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
</head>

<body>
    
  
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="row">
                                        <div class="col">
                                            <p class="text-right">Bem-Vindo <?php echo utf8_encode($nome) ?>
                                            <br>Hoje é <?php echo utf8_encode($dia) ?>
                                            </p>                                     

                                        </div>
                                    </div>                                     
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-browser"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?php echo $total_artigos ?></span></div>
                                            <div class="stat-heading">Artigos Publicados</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?php echo $total ?></span></div>
                                            <div class="stat-heading">Usuários Cadastrados</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-browser"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count"><?php echo $total_categoria ?></span></div>
                                            <div class="stat-heading">Categorias Cadastradas</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>              
     

    
</body>
</html>

