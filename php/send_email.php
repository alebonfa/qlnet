<?php

	$emailTo     = $_POST['email'];
	$emailNome   = $_POST['nome'];
	$vencimentos = $_POST['vencimentos'];

	include_once 'swift/swift_required.php';

	$body = format_email($emailNome, $vencimentos, 'html');
	$body_plain_txt = format_email($emailNome, $vencimentos, 'txt');

	$transport = Swift_SmtpTransport::newInstance('smtp.qualittas.com.br', 587);
	$transport ->setUsername('noreply@qualittas.com.br');
	$transport ->setPassword('iq976431iq');

	$mailer = Swift_Mailer::newInstance($transport);
	$message = Swift_Message::newInstance();
	$message ->setSubject('Portal QualiLog');
	$message ->setFrom(array('noreply@qualittas.com.br' => 'Portal QualiLog'));
	$message ->setTo(array($emailTo => $emailNome));
	
	// $message ->setBody($body_plain_txt);
	// $message ->addPart($body, 'text/html');
			
	$message ->setBody($body_plain_txt);
	$message ->addPart($body, 'text/html');

	$result = $mailer->send($message);

	print_r($result);
	
	return $result;


	function format_email($nome, $vencimentos, $format){

	//set the root
	$root = $_SERVER['DOCUMENT_ROOT'].'/Qualilog/etc';

	//grab the template content
	$template = file_get_contents($root.'/cobranca01_template.'.$format);
			
	//replace all the tags
	$template = preg_replace('/\{NOME\}/', $nome, $template);
	$template = preg_replace('/\{VENCIMENTOS\}/', $vencimentos, $template);
		
	//return the html of the template
	return $template;

}

?>