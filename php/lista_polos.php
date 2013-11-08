<?php

	include("conn.php");

    $sql = 'SELECT * FROM qlsmspolos ORDER BY nome';
    $rs = mysql_query($sql, $conn) or die(mysql_error());
    $rows = array('polos' => array());
    while ($row = mysql_fetch_assoc($rs)) {
    	$rows['polos'][] = $row;
    }

	echo json_encode($rows);

?>