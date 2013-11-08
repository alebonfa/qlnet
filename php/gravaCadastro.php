<?php
	//chama o arquivo de conexão com o bd
	include("conn.php");
	include("functions.php");
	include("swift/swift_required.php");

	//echo ($_POST);

	$nome   = $_POST['nome'  ];
	$email  = $_POST['email' ];
	$acesso = $_POST['acesso'];
	$chave  = geraSenha(8, true, true, true);
	$senha  = md5($chave);
	

	$sql_usuario = mysql_query("INSERT INTO qlusuario (nome, email, pwd) values ('$nome', '$email', '$senha')") or die(mysql_error());
	$id          = mysql_insert_id();
	$sql_acesso  = mysql_query("INSERT INTO qlusuario_acesso (usuario_id, acesso_id) values ('$id', '$acesso')") or die(mysql_error());

	$info = array(
		"nome"   => $nome,
		"email"  => $email,
		"chave"  => $chave,
		"senha"  => $senha
		);
	
	send_email($info);

	echo json_encode(array(
		"success" => mysql_errno() == 0,
		"contatos" => array(
			"id"     => mysql_insert_id(),
			"nome"   => $nome,
			"email"  => $email,
			"acesso" => $acesso
		)
	));
	
?>