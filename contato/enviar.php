<?php
 
// Inclui o arquivo class.phpmailer.php localizado na pasta class
require_once("../class/class.phpmailer.php");
require_once("../class/PHPMailerAutoload.php");

//Recebe as informações do formúlário
$nome = $_POST['nome'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$mensagem = $_POST['mensagem'];

//Variável para mostrar as informações no corpo do e-mail.
$corpo = "<strong>Nome:</strong> $nome<br>
		  <strong>E-mail: </strong> $email<br>
		  <strong>Telefone: </strong> $tel<br>
		  <strong>Mensagem:<br>-----<br></strong>$mensagem";

 
// Inicia a classe PHPMailer
$mail = new PHPMailer(true);
 
// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
 
try {
     $mail->Host = 'smtp.pmagalhaesconsultoria.com.br'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
     $mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
	 $mail->CharSet = 'UTF-8';
     $mail->Port       = 587; //  Usar 587 porta SMTP
     $mail->Username = 'contato@pmagalhaesconsultoria.com.br'; // Usuário do servidor SMTP (endereço de email)
     $mail->Password = 'pmc*10mil10'; // Senha do servidor SMTP (senha do email usado)
 
     //Define o remetente
     // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
     $mail->SetFrom('contato@pmagalhaesconsultoria.com.br', 'Contato P Magalhães Consultoria'); //Seu e-mail
     $mail->AddReplyTo('contato@pmagalhaesconsultoria.com.br', 'Contato Via Site - wwww.pmagalhaesconsultoria.com.br'); //Seu e-mail
     $mail->Subject = $nome;//Assunto do e-mail
 
 
     //Define os destinatário(s)
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     $mail->AddAddress('contato@pmagalhaesconsultoria.com.br', 'Contato Via Site - wwww.pmagalhaesconsultoria.com.br');
 
     //Campos abaixo são opcionais 
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
     //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
     //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo
 
 
     //Define o corpo do email
     $mail->MsgHTML($corpo); 
 
     ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
     //$mail->MsgHTML(file_get_contents('arquivo.html'));
 
     $mail->Send();
     //echo "<script type=\"text/javascript\">alert(\"Mensagem enviada com sucesso.\"); history.go(-1);</script>\n";
 
    //caso apresente algum erro é apresentado abaixo com essa exceção.
    }catch (phpmailerException $e) {
      echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
	
	

	
}
header("Location:index.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>