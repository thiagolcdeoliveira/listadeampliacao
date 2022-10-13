<?php
require_once('PHPMailer/PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/PHPMailer/src/SMTP.php');
require_once('PHPMailer/PHPMailer/src/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
$mail = new PHPMailer(true);
 
try {
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = True;
	$mail->Username = 'ti@araquari.sc.gov.br';
	$mail->Password = '';
	$mail->Port = 25;
    $mail->SMTPSecure = 'tls';
    $mail->CharSet = 'utf-8';  
    $mail->SMTPSecure = false;
   // $mail->SMTPAutoTLS = false;
    
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => True
        )
    );
	$mail->setFrom('ti@araquari.sc.gov.br');
	$mail->addAddress('thiagolocatellicdeoliveira@gmail.com.br');
	//$mail->addAddress('endereco2@provedor.com.br');
 
	$mail->isHTML(true);
	$mail->Subject = 'Teste de email via gmail Canal TI';
	$mail->Body = 'Chegou o email teste do <strong>Canal TI</strong>';
	$mail->AltBody = 'Chegou o email teste do Canal TI';
 
	if($mail->send()) {
		echo 'Email enviado com sucesso';
	} else {
		echo 'Email nao enviado';
	}
} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}