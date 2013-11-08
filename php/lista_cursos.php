<?php

	include("conn.php");

    $sql = 'SELECT * FROM qlsmscursos ORDER BY nome';
    $rs = mysql_query($sql, $conn) or die(mysql_error());
    $rows = array('cursos' => array());
    while ($row = mysql_fetch_assoc($rs)) {
    	$rows['cursos'][] = $row;
    }

	echo json_encode($rows);

?>