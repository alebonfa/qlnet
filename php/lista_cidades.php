<?php

	include("conn.php");

    $sql = 'SELECT l.localidade_id, l.estado_id, e.estado_sigla, l.localidade_nome ';
    $sql = $sql . 'FROM localidades l, estados e ';
    $sql = $sql . 'WHERE l.estado_id = e.estado_id ';
    $sql = $sql . 'ORDER BY l.localidade_nome';
    $rs = mysql_query($sql, $conn) or die(mysql_error());
    $rows = array('cidades' => array());
    while ($row = mysql_fetch_assoc($rs)) {
    	$rows['cidades'][] = $row;
    }

	echo json_encode($rows);

?>