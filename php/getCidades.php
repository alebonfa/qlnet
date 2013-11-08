<?php
	include 'conn.php';
	$cidades = array();
	$rsCidades = mysql_query("SELECT nome, uf FROM cidades ORDER BY nome");

	if($rsCidades === FALSE) {
		die(mysql_error());
	}

	while($row = mysql_fetch_array($rsCidades, MYSQL_ASSOC)) {
		$cidades[] = $row;
	}

	echo json_encode($cidades);
?>