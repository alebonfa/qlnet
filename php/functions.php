<?php

function limparString( $string )
{
	$string = trim( $string );
	$string = str_replace( "\"", "'", $string );
	$string = str_replace( "\'", "'", $string );
	$string = str_replace( "'", "''", $string );
	$string = str_replace( "--", "-", $string );
	$string = str_replace( "update ", "", $string );
	$string = str_replace( "alter ", "", $string );
	$string = str_replace( "drop ", "", $string );
	$string = str_replace( "select ", "", $string );
	return $string;
}

function send_email($info)
{	
	//format each email
	$body = format_email($info,'html');
	$body_plain_txt = format_email($info,'txt');

	//setup the mailer
	$transport = Swift_SmtpTransport::newInstance('smtp.qualittas.com.br', 587);
	$transport ->setUsername('desenvolvimento@qualittas.com.br');
	$transport ->setPassword('iq976431iq');

	$mailer  = Swift_Mailer::newInstance($transport);
	$message = Swift_Message::newInstance();
	$message ->setSubject('Bem Vindo ao Embaixador Qualittas');
	$message ->setFrom(array('desenvolvimento@qualittas.com.br' => 'Embaixador Qualittas'));
	$message ->setTo(array($info['email'] => $info['nome']));
	
	$message ->setBody($body_plain_txt);
	$message ->addPart($body, 'text/html');
			
	$result = $mailer->send($message);
	
	//echo($body);
	
	return $result;	
}

function format_email($info, $format)
{
	/*
	foreach ($info as $i => $value) {
		echo($info[$i]);
	    echo("<br/>");
	}*/
	//echo($info['nome' ]."-".$info['email' ]."-".$info['chave' ]."-".$info['senha' ]);
	//exit;
	

	//set the root
	$root = $_SERVER['DOCUMENT_ROOT'].'/qualilog/etc';

	//grab the template content
	$template = file_get_contents($root.'/signup_template_embaixador.'.$format);
			
	//replace all the tags
	$template = preg_replace('/\{USERNAME\}/', $info['nome' ], $template);
	$template = preg_replace('/\{EMAIL\}/', $info['email'], $template);
	$template = preg_replace('/\{CHAVE\}/', $info['chave'], $template);
	$template = preg_replace('/\{SENHA\}/', $info['senha'], $template);
	$template = preg_replace('/\{SITEPATH\}/','qualilog.net.br'    , $template);
		
	//return the html of the template
	return $template;
}

function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
	// Caracteres de cada tipo
	$lmin = 'abcdefghijklmnopqrstuvwxyz';
	//$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$num = '1234567890';
	//$simb = '!@#$%*-';

	// Variáveis internas
	$retorno = '';
	$caracteres = '';

	// Agrupamos todos os caracteres que poderão ser utilizados
	$caracteres .= $lmin;
	//if ($maiusculas) $caracteres .= $lmai;
	if ($numeros) $caracteres .= $num;
	//if ($simbolos) $caracteres .= $simb;

	// Calculamos o total de caracteres possíveis
	$len = strlen($caracteres);

	for ($n = 1; $n <= $tamanho; $n++) {
		// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
		$rand = mt_rand(1, $len);
		// Concatenamos um dos caracteres na variável $retorno
		$retorno .= $caracteres[$rand-1];
	}

	return $retorno;
}

?>