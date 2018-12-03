<?php 

    require_once("conexao/conecta.php");
    require("../class/PHPMailerAutoload.php");
?>
<?php
    //controle de sessão - segurança
    session_start();
    if(isset($_SESSION["user_portal"])){
        header("location:index.php");
    }

    function randString($size){
        //String com valor possíveis do resultado, os caracteres pode ser adicionado ou retirados conforme sua necessidade
        $basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        $return= "";

        for($count= 0; $size > $count; $count++){
            //Gera um caracter aleatorio
            $return.= $basic[rand(0, strlen($basic) - 1)];
        }

        return $return;
    }
    
    //Função de login
    if(isset($_POST["logar"])){
        $usuario = $_POST["email"];
        $senha = $_POST["senha"];
        
            
        $login = "SELECT * ";
        $login .= "FROM tb_usuarios ";
        $login .= "WHERE emailUsuario = '{$usuario}' and senhaUsuario = '{$senha}' ";
        
        $acesso = mysqli_query($conecta, $login);
        if(!$acesso){
            die("Falha na consulta ao banco de dados");
        }
    
        $informacao = mysqli_fetch_assoc($acesso);
        if(empty($informacao)){
            $mensagem="E-mail ou senha inválido.";
            
        }else{
            $_SESSION["user_portal"] = $informacao["idUsuario"];
            header("location:index.php");
        }
    } 

    //Função de recuperação de senha
    if(isset($_POST["recuperar"])){
        $email = $_POST["email"];
        $query = "SELECT * ";
        $query .= "FROM tb_usuarios ";
        $query .= "WHERE emailUsuario = '{$email}'";
        
        $achou = mysqli_query($conecta, $query);
        if(!$achou){
            die("Falha na consulta ao banco de dados");
        }
    
        $usuario = mysqli_fetch_assoc($achou);
        if(empty($usuario)){
            $mensagem="Usuário inexistente!";
            
        }else{
            $novaSenha = randString(10);
            $query = "UPDATE tb_usuarios ";
            $query .= "SET senhaUsuario = '{$novaSenha}' ";
            $query .= "WHERE emailUsuario = '{$email}'";
            $executar = mysqli_query($conecta, $query);

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.pmagalhaesconsultoria.com.br';
            $mail->SMTPAuth = true;
            // $mail->SMTPSecure = 'tls';
            $mail->CharSet = 'UTF-8';
            $mail->Username = 'contato@pmagalhaesconsultoria.com.br';
            $mail->Password = 'pmc*10mil10';
            $mail->Port = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('contato@pmagalhaesconsultoria.com.br');
            $mail->addReplyTo('contato@pmagalhaesconsultoria.com.br');
            $mail->addAddress($email, $usuario["nomeUsuario"]);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperação de senha';
            $mail->Body    = 'Sua nova senha temporária é '. $novaSenha .'</b>';
            $mail->AltBody = 'Acesse o sistema para alterar para uma nova do seu gosto.';

            if(!$mail->send()) {
                echo 'Não foi possível enviar a mensagem.<br>';
                echo 'Erro: ' . $mail->ErrorInfo;
            } else {
                // echo 'Mensagem enviada.';
            }
        }
    }
?>
<!doctype html>
<html class="no-js" lang="pt-BR"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>P Magalhães Consultoria | Área Administrativa</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="images/favicon.ico">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="favicon" href="images/favicon.ico">

    <link rel="stylesheet" href="assets/css/estilo.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">


    <style>
        body{
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <section class="bd-background">
        <div class="container">
            <div class="row">
                <div class="col-md-4 box-login">
                    <img src="images/logo.png" class="img-fluid logo-login" alt="">
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" name="email" style="outline:none" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite Seu E-mail" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Senha</label>
                            <input type="password" name="senha" style="outline:none" class="form-control" id="exampleInputPassword1" placeholder="Digite Sua Senha">
                        </div>                       
                        <button type="submit" name="logar" class="btn btn-primary btn-login" id="btn-login" value="login">Entrar</button>
                        <?php
                            if(isset($mensagem)){
                        ?>
                          <div class="alert alert-danger box-erro" role="alert"><?php echo $mensagem ?></div>  
                          
                        <?php
                            }
                        ?>

                    </form>
                    <button type="submit" class="btn btn-primary btn-login"  data-toggle="modal" data-target="#exampleModal" id="btn-login" value="login" >Esqueceu Sua Senha</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Recuperar senha</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="login.php">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Informe seu email:</label>
                                        <input type="email" name="email" style="outline:none" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite Seu E-mail" autofocus>
                                    </div>
                                    <button type="submit" name="recuperar" class="btn btn-primary">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
        </div>

    </section>
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    // Fechar conexao
    mysqli_close($conecta);
?>