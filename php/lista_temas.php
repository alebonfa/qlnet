<?php

	include("conn.php");

    $sql = 'SELECT * FROM qlsmstematicas ORDER BY nome';
    $rs = mysql_query($sql, $conn) or die(mysql_error());
    $rows = array('temas' => array());
    while ($row = mysql_fetch_assoc($rs)) {
    	$rows['temas'][] = $row;
    }

	echo json_encode($rows);

?>