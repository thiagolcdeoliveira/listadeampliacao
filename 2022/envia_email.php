<?php
require_once('PHPMailer/PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/PHPMailer/src/SMTP.php');
require_once('PHPMailer/PHPMailer/src/Exception.php');
require_once "classes/Crianca.php";
require_once "classes/CrudCrianca.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 

 
function EnviaEmail($crianca)
{
    
    $mail = new PHPMailer(true);
try {
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = 'mail.araquari.sc.gov.br';
	$mail->SMTPAuth = True;
	$mail->Username = 'lista.sistema@araquari.sc.gov.br';
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
	$mail->setFrom('lista.sistema@araquari.sc.gov.br');
	$mail->addAddress('lista.mpsc@araquari.sc.gov.br');
	//$mail->addAddress('endereco2@provedor.com.br');

   // $crianca = new Crianca($crianca1);
   // echo "Criança - > ". $crianca->getNome();
    /*$crianca->setNome("Thiago")->setSobrenome("Locatelli")->setTurma("1")->setCei("2")->
    setCpf("09947875962")->setDataNasc("10/11/1997")->setNomeResponsavel("Mãe Thigao")->
    setEndereco("Rua Jose Miguel")->setCodigoGerar();*/
    $lista = "Lista de Ampliação";
    

    $mensagem = "<table>
    <tr><td>Nome e Sobrenome:</td><td>".$crianca->getNome()." ". $crianca->getSobrenome()."</td></tr>
    <tr><td>Nome da Mãe:</td><td>".$crianca->getNomeResponsavel()."</td></tr>
    <tr><td>Data Nascimento:</td><td>".$crianca->getDataNasc()."</td></tr>
    <tr><td>Endereço:</td><td>".$crianca->getEndereco()."</td></tr>
    <tr><td>CEIs:</td><td>".$crianca->getAllCeis()."</td></tr>
    <tr><td>Turma:</td><td>".$crianca->getTurma()."</td></tr>
    <tr><td>Data do Envio:</td><td>".date('d/m/Y H:i')."</td></tr>    
    ";
	$mail->isHTML(true);
	$mail->Subject = $lista." - ".$crianca->getCodigo()." - ".$crianca->getNome();
	$mail->Body = $mensagem;
	$mail->AltBody = '';
 
	if($mail->send()) {
		echo 'Email enviado com sucesso';
	} else {
		echo 'Email nao enviado';
	}
} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}
}