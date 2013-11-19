<?php

	$emailTo     = $_POST['email'];
	$emailNome   = $_POST['nome'];

	include_once 'swift/swift_required.php';

	$body = format_email($emailNome, 'html');
	$body_plain_txt = format_email($emailNome, 'txt');

	$transport = Swift_SmtpTransport::newInstance('smtp.qualittas.com.br', 587);
	$transport ->setUsername('financeirocr3@qualittas.com.br');
	$transport ->setPassword('iq976431iq');

	$mailer = Swift_Mailer::newInstance($transport);
	$message = Swift_Message::newInstance();
	$message ->setSubject('Qualittas - Cobrança');
	$message ->setFrom(array('financeirocr3@qualittas.com.br' => 'Qualittas - Depto. Financeiro'));
	$message ->setTo(array($emailTo => $emailNome));
	
	// $message ->setBody($body_plain_txt);
	// $message ->addPart($body, 'text/html');
			
	$message ->setBody($body_plain_txt);
	$message ->addPart($body, 'text/html');

	$result = $mailer->send($message);

	print_r($result);
	
	return $result;


	function format_email($nome, $format){

	//set the root
	$root = $_SERVER['DOCUMENT_ROOT'].'/qualilog/etc';

	//grab the template content
	$template = file_get_contents($root.'/cobranca02_template.'.$format);
			
	//replace all the tags
	$template = preg_replace('/\{NOME\}/', $nome, $template);
		
	//return the html of the template
	return $template;

}

?>