<?php

	include("conn.php");

    $sql = 'SELECT * FROM estados ORDER BY estado_nome';
    $rs = mysql_query($sql, $conn) or die(mysql_error());
    $rows = array('ufs' => array());
    while ($row = mysql_fetch_assoc($rs)) {
    	$rows['ufs'][] = $row;
    }

	echo json_encode($rows);

?>