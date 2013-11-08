<?php
	include 'conn.php';
	
	$usuarios = array();
	$rsUsuarios = mysql_query("SELECT id, nome, email FROM qlusuario ORDER BY nome");

	if($rsUsuarios === FALSE) {
		die(mysql_error());
	}

	while($row = mysql_fetch_array($rsUsuarios, MYSQL_ASSOC)) {
		$usuarios[] = $row;
	}

	echo json_encode($usuarios);
?>