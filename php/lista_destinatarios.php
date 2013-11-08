<?php

	$tipo_destinatario = $_GET['tipo_destinatario'];
	$data_inicio       = substr($_GET['data_inicio'],0,10);
	$data_fim          = substr($_GET['data_fim'],0,10);
	$polo              = $_GET['polo'];
	$curso             = $_GET['curso'];

	include("conn.php");

    $sql = 'SELECT d.* ';

	switch ($tipo_destinatario) {
		case 1:
	    	$sql = $sql . ', a.atrasos as vencimentos ';
    		break;
    	
    	default:
	    	$sql = $sql . ', null as vencimentos ';
    		break;
    }

    $sql = $sql . 'FROM qlsmsdestinatarios AS d ';

	switch ($tipo_destinatario) {
		case 1:
		    $sql = $sql . ', qlsmsalunos AS a ';
		    if ( (!empty($polo)) || (!empty($curso)) ) {
		    	$sql = $sql . ', qlsmsaluno_turma AS at ';
		    };
			break;
		case 2:
		    $sql = $sql . ', qlsmspalestrantes AS a ';
			break;
		case 3:
		    $sql = $sql . ', qlsmscolaboradores AS a ';
			break;
	}

    $sql = $sql . 'WHERE d.id = a.destinatario_id ';

    if ($tipo_destinatario = 1) {
	    if ( !empty($polo) || !empty($curso) ) {
	    	$sql = $sql . 'AND a.sisquali_id = at.aluno_id ';
	    	if (!empty($polo)) {
	    		$sql = $sql . 'AND at.polo_id = "' . $polo . '" ';
	    	}
	    	if (!empty($curso)) {
	    		$sql = $sql . 'AND at.curso_id = "' . $curso . '" ';
	    	}
	    };

	    if (!empty($data_inicio) && !empty($data_fim))  {
			$sql = $sql . 'AND a.primeiro_atraso >= "' . $data_inicio . '" ';
			$sql = $sql . 'AND a.primeiro_atraso <= "' . $data_fim . '" ';
	    } else if (!empty($data_inicio) && empty($data_fim)) {
			$sql = $sql . 'AND a.primeiro_atraso >= "' . $data_inicio . '" ';
	    } else if (empty($data_inicio) && !empty($data_fim)) {
			$sql = $sql . 'AND a.primeiro_atraso > "0000-00-00" ';
			$sql = $sql . 'AND a.primeiro_atraso <= "' . $data_fim . '" ';
	    };


    };

    $sql = $sql . 'ORDER BY d.nome ';

    $rs = mysql_query($sql, $conn) or die(mysql_error());
    $rows = array('destinatarios' => array());
    while ($row = mysql_fetch_assoc($rs)) {
    	$rows['destinatarios'][] = $row;
    }

	echo json_encode($rows);

?>