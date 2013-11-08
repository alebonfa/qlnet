<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Importação do SisQuali</title>
</head>
<body>

	<div id="progress" style="width:500px;border:1px solid #ccc;"></div>
	<div id="information" sytle="width"></div>

	<div>

	<?php

	ob_end_flush();

	$percent = 10;

	ini_set('max_execution_time', 30000);
	 
	$servidor = "mysql01.alunoqualittas.com.br";
	$usuario  = "alunoqualittas";
	$password = "iq976431iq";
	$banco_de_dados = "alunoqualittas";
	$conn = mysql_connect($servidor, $usuario, $password);
	 
	if (!$conn) die ("<h1>Falha na conexão com o Banco de Dados!</h1>");
	$db = mysql_select_db($banco_de_dados, $conn);

	//Importando Cursos
	$sql = 'DELETE FROM qlsmscursos';
	if (!mysql_query($sql, $conn)) die ("<h1>Falha na Limpeza da Tabela QLSMSCursos");

	echo "<h1>CURSOS</h1>";
	$tabelaDBF = dbase_open('sms03.dbf', 0);
	if($tabelaDBF) {
		$DBF_lenght = dbase_numrecords($tabelaDBF);
		for($i = 1; $i <= $DBF_lenght; $i++) {

			$percent = intval($i/$DBF_lenght * 100)."%";
			$script = '<script language="javascript">document.getElementById("progress").innerHTML="<div style=\"width:' . $percent. ';background-color:#ddd;\">&nbsp;</div>";';
			$script = $script . 'document.getElementById("information").innerHTML="Cursos - '.$i.' registros processados.";</script>';
			echo $script;
			flush();

			$row = dbase_get_record_with_names($tabelaDBF, $i);
			if($row) {
				$sisquali = addslashes(trim($row['SISQUALI']));
				$nome = addslashes(trim($row['NOME']));
				$sql = "INSERT INTO qlsmscursos (sisquali_id, nome) VALUES ('$sisquali', '$nome')";
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSCursos");
			}
		}
		echo "<p>QLSMSCursos Importada</p>";
		dbase_close($tabelaDBF);
	}

	//Importando Polos
	$sql = 'DELETE FROM qlsmspolos';
	if (!mysql_query($sql, $conn)) die ("<h1>Falha na Limpeza da Tabela QLSMSPolos");

	echo "<h1>POLOS</h1>";
	$tabelaDBF = dbase_open('sms02.dbf', 0);
	if($tabelaDBF) {
		$DBF_lenght = dbase_numrecords($tabelaDBF);
		for($i = 1; $i <= $DBF_lenght; $i++) {

			$percent = intval($i/$DBF_lenght * 100)."%";
			$script = '<script language="javascript">document.getElementById("progress").innerHTML="<div style=\"width:' . $percent. ';background-color:#ddd;\">&nbsp;</div>";';
			$script = $script . 'document.getElementById("information").innerHTML="Polos - '.$i.' registros processados.";</script>';
			echo $script;
			flush();

			$row = dbase_get_record_with_names($tabelaDBF, $i);
			if($row) {
				$sisquali = addslashes(trim($row['SISQUALI']));
				$nome = addslashes(trim($row['NOME']));
				$sql = "INSERT INTO qlsmspolos (sisquali_id, nome) VALUES ('$sisquali', '$nome')";
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSPolos");
			}
		}
		echo "<p>QLSMSPolos Importada</p>";
		dbase_close($tabelaDBF);
	}

	//Importando Turmas
	$sql = 'DELETE FROM qlsmsturmas';
	if (!mysql_query($sql, $conn)) die ("<h1>Falha na Limpeza da Tabela QLSMSTurmas");

	echo "<h1>Turmas</h1>";
	$tabelaDBF = dbase_open('sms01.dbf', 0);
	if($tabelaDBF) {
		$DBF_lenght = dbase_numrecords($tabelaDBF);
		for($i = 1; $i <= $DBF_lenght; $i++) {

			$percent = intval($i/$DBF_lenght * 100)."%";
			$script = '<script language="javascript">document.getElementById("progress").innerHTML="<div style=\"width:' . $percent. ';background-color:#ddd;\">&nbsp;</div>";';
			$script = $script . 'document.getElementById("information").innerHTML="Turmas - '.$i.' registros processados.";</script>';
			echo $script;
			flush();

			$row = dbase_get_record_with_names($tabelaDBF, $i);
			if($row) {
				$sisquali = $row['SISQUALI'];
				$curso = addslashes(trim($row['CURSO']));
				$polo = addslashes(trim($row['POLO']));
				$sql = "INSERT INTO qlsmsturmas (sisquali_id, curso_id, polo_id) VALUES ($sisquali, '$curso', '$polo')";
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSTurmas");
			}
		}
		echo "<p>QLSMSTurmas Importada</p>";
		dbase_close($tabelaDBF);
	}

	//Importando Temas
	$sql = 'DELETE FROM qlsmstematicas';
	if (!mysql_query($sql, $conn)) die ("<h1>Falha na Limpeza da Tabela QLSMSTematicas");

	echo "<h1>Temáticas</h1>";
	$tabelaDBF = dbase_open('sms05.dbf', 0);
	if($tabelaDBF) {
		$DBF_lenght = dbase_numrecords($tabelaDBF);
		for($i = 1; $i <= $DBF_lenght; $i++) {

			$percent = intval($i/$DBF_lenght * 100)."%";
			$script = '<script language="javascript">document.getElementById("progress").innerHTML="<div style=\"width:' . $percent. ';background-color:#ddd;\">&nbsp;</div>";';
			$script = $script . 'document.getElementById("information").innerHTML="Temáticas - '.$i.' registros processados.";</script>';
			echo $script;
			flush();

			$row = dbase_get_record_with_names($tabelaDBF, $i);
			if($row) {
				$sisquali = $row['SISQUALI'];
				$nome = addslashes(trim($row['NOME']));
				$sql = "INSERT INTO qlsmstematicas (sisquali_id, nome) VALUES ($sisquali, '$nome')";
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSTematicas");
			}
		}
		echo "<p>QLSMSTematicas Importada</p>";
		dbase_close($tabelaDBF);
	}

	//Importando Palestrantes
	$sql = 'DELETE FROM qlsmsdestinatarios';
	if (!mysql_query($sql, $conn)) die ("<h1>Falha na Limpeza da Tabela qlsmsdestinatarios");

	$sql = 'DELETE FROM qlsmspalestrantes';
	if (!mysql_query($sql, $conn)) die ("<h1>Falha na Limpeza da Tabela qlsmspalestrantes");

	echo "<h1>Palestrantes</h1>";
	$tabelaDBF = dbase_open('sms04.dbf', 0);
	if($tabelaDBF) {
		$DBF_lenght = dbase_numrecords($tabelaDBF);
		for($i = 1; $i <= $DBF_lenght; $i++) {

			$percent = intval($i/$DBF_lenght * 100)."%";
			$script = '<script language="javascript">document.getElementById("progress").innerHTML="<div style=\"width:' . $percent. ';background-color:#ddd;\">&nbsp;</div>";';
			$script = $script . 'document.getElementById("information").innerHTML="Palestrantes - '.$i.' registros processados.";</script>';
			echo $script;
			flush();

			$row = dbase_get_record_with_names($tabelaDBF, $i);
			if($row) {
				$sisquali = $row['SISQUALI'];
				$nome     = addslashes(trim($row['NOME']));
				$cidade   = addslashes(trim($row['CIDADE']));
				$uf       = addslashes(trim($row['UF']));
				$email    = addslashes(trim($row['EMAIL']));
				$telefone = addslashes(trim($row['TELEFONE']));
				$area_peq = $row['AREA_PEQ'];
				$area_grd = $row['AREA_GRD'];
				$area_slv = $row['AREA_SLV'];
				$area_sp  = $row['AREA_SP'];
				$sql = "INSERT INTO qlsmsdestinatarios (nome, cidade, uf, email, telefone) VALUES ('$nome', '$cidade', '$uf', '$email', '$telefone')";
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSDestinatarios");
				$destinatario_id = mysql_insert_id();
				$sql = "INSERT INTO qlsmspalestrantes (destinatario_id, sisquali_id, area_peq, area_grd, area_slv, area_sp) ";
				$sql = $sql . " VALUES ($destinatario_id, $sisquali, $area_peq, $area_grd, $area_slv, $area_sp)";
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSPalestrantes");
			}
		}
		echo "<p>QLSMSPalestrantes Importada</p>";
		dbase_close($tabelaDBF);
	}

	//Importando Palestrantes x Tematicas
	$sql = 'DELETE FROM qlsmspalestrante_tematica';
	if (!mysql_query($sql, $conn)) die ("<h1>Falha na Limpeza da Tabela QLSMSPalestrante_tematica");

	echo "<h1>Palestrante x Temáticas</h1>";
	$tabelaDBF = dbase_open('sms06.dbf', 0);
	if($tabelaDBF) {
		$DBF_lenght = dbase_numrecords($tabelaDBF);
		for($i = 1; $i <= $DBF_lenght; $i++) {

			$percent = intval($i/$DBF_lenght * 100)."%";
			$script = '<script language="javascript">document.getElementById("progress").innerHTML="<div style=\"width:' . $percent. ';background-color:#ddd;\">&nbsp;</div>";';
			$script = $script . 'document.getElementById("information").innerHTML="Palestrante x Temáticas - '.$i.' registros processados.";</script>';
			echo $script;
			flush();

			$row = dbase_get_record_with_names($tabelaDBF, $i);
			if($row) {
				$palestra = $row['PALESTRA'];
				$tematica = $row['TEMATICA'];
				$sql = "INSERT INTO qlsmspalestrante_tematica (palestrante_id, tematica_id) VALUES ($palestra, $tematica)";
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSPalestrante_tematica");
			}
		}
		echo "<p>QLSMSPalestrante_tematicas Importada</p>";
		dbase_close($tabelaDBF);
	}

	//Importando Módulos
	$sql = 'DELETE FROM qlsmsmodulos';
	if (!mysql_query($sql, $conn)) die ("<h1>Falha na Limpeza da Tabela QLSMSModulos");

	echo "<h1>Módulos</h1>";
	$tabelaDBF = dbase_open('sms07.dbf', 0);
	if($tabelaDBF) {
		$DBF_lenght = dbase_numrecords($tabelaDBF);
		for($i = 1; $i <= $DBF_lenght; $i++) {

			$percent = intval($i/$DBF_lenght * 100)."%";
			$script = '<script language="javascript">document.getElementById("progress").innerHTML="<div style=\"width:' . $percent. ';background-color:#ddd;\">&nbsp;</div>";';
			$script = $script . 'document.getElementById("information").innerHTML="Módulos - '.$i.' registros processados.";</script>';
			echo $script;
			flush();

			$row = dbase_get_record_with_names($tabelaDBF, $i);
			if($row) {
				$sisquali = $row['SISQUALI'];
				$turma    = $row['TURMA'];
				$palestra = $row['PALESTRA'];
				$tematica = $row['TEMATICA'];
				$data     = $row['DATA'];
				$sql = "INSERT INTO qlsmsmodulos (sisquali_id, turma_id, palestrante_id, tematica_id) VALUES ($sisquali, $turma, $palestra, $tematica)";
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSModulos");
			}
		}
		echo "<p>QLSMSModulos Importada</p>";
		dbase_close($tabelaDBF);
	}

	//Importando Colaboradores
	$sql = 'DELETE FROM qlsmscolaboradores';
	if (!mysql_query($sql, $conn)) die ("<h1>Falha na Limpeza da Tabela qlsmscolaboradores");

	echo "<h1>Colaboradores</h1>";
	$tabelaDBF = dbase_open('sms08.dbf', 0);
	if($tabelaDBF) {
		$DBF_lenght = dbase_numrecords($tabelaDBF);
		for($i = 1; $i <= $DBF_lenght; $i++) {

			$percent = intval($i/$DBF_lenght * 100)."%";
			$script = '<script language="javascript">document.getElementById("progress").innerHTML="<div style=\"width:' . $percent. ';background-color:#ddd;\">&nbsp;</div>";';
			$script = $script . 'document.getElementById("information").innerHTML="Colaboradores - '.$i.' registros processados.";</script>';
			echo $script;
			flush();

			$row = dbase_get_record_with_names($tabelaDBF, $i);
			if($row) {
				$sisquali = $row['SISQUALI'];
				$nome     = addslashes(trim($row['NOME']));
				$cidade   = addslashes(trim($row['CIDADE']));
				$uf       = addslashes(trim($row['UF']));
				$email    = addslashes(trim($row['EMAIL']));
				$telefone = addslashes(trim($row['TELEFONE']));
				$polo     = addslashes(trim($row['POLO']));
				$sql = "INSERT INTO qlsmsdestinatarios (nome, cidade, uf, email, telefone) VALUES ('$nome', '$cidade', '$uf', '$email', '$telefone')";
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSDestinatarios");
				$destinatario_id = mysql_insert_id();
				$sql = "INSERT INTO qlsmscolaboradores (destinatario_id, sisquali_id, polo_id) ";
				$sql = $sql . " VALUES ($destinatario_id, $sisquali, '$polo')";
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSColaboradores");
			}
		}
		echo "<p>QLSMSColaboradores Importada</p>";
		dbase_close($tabelaDBF);
	}

	//Importando Alunos
	$sql = 'DELETE FROM qlsmsalunos';
	if (!mysql_query($sql, $conn)) die ("<h1>Falha na Limpeza da Tabela qlsmsalunos");

	echo "<h1Alunos</h1>";
	$tabelaDBF = dbase_open('sms10.dbf', 0);
	if($tabelaDBF) {
		$DBF_lenght = dbase_numrecords($tabelaDBF);
		for($i = 1; $i <= $DBF_lenght; $i++) {

			$percent = intval($i/$DBF_lenght * 100)."%";
			$script = '<script language="javascript">document.getElementById("progress").innerHTML="<div style=\"width:' . $percent. ';background-color:#ddd;\">&nbsp;</div>";';
			$script = $script . 'document.getElementById("information").innerHTML="Alunos - '.$i.' registros processados.";</script>';
			echo $script;
			flush();

			$row = dbase_get_record_with_names($tabelaDBF, $i);
			if($row) {
				$sisquali = $row['SISQUALI'];
				$nome     = addslashes(trim($row['NOME']));
				$cidade   = addslashes(trim($row['CIDADE']));
				$uf       = addslashes(trim($row['UF']));
				$email    = addslashes(trim($row['EMAIL']));
				$telefone = addslashes(trim($row['TELEFONE']));

				$atraso   = trim($row['ATRASO']);
				$atraso = empty($atraso) ? "NULL" : substr($atraso, 0, 4) . "-" . substr($atraso, 4, 2) . "-" . substr($atraso, 6, 2);

				$sql = "INSERT INTO qlsmsdestinatarios (nome, cidade, uf, email, telefone) VALUES ('$nome', '$cidade', '$uf', '$email', '$telefone')";
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSDestinatarios");
				$destinatario_id = mysql_insert_id();
				$sql = "INSERT INTO qlsmsalunos (destinatario_id, sisquali_id, primeiro_atraso) ";
				if ($atraso==null) {
					$sql = $sql . " VALUES ($destinatario_id, $sisquali, $atraso)";
				} else {
					$sql = $sql . " VALUES ($destinatario_id, $sisquali, '$atraso')";
				}
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSAlunos");
			}
		}
		echo "<p>QLSMSAlunos Importada</p>";
		dbase_close($tabelaDBF);
	}


	//Importando Alunos x Turmas
	$sql = 'DELETE FROM qlsmsaluno_turma';
	if (!mysql_query($sql, $conn)) die ("<h1>Falha na Limpeza da Tabela QLSMSAluno_turma");

	echo "<h1>Módulos</h1>";
	$tabelaDBF = dbase_open('sms09.dbf', 0);
	if($tabelaDBF) {
		$DBF_lenght = dbase_numrecords($tabelaDBF);
		for($i = 1; $i <= $DBF_lenght; $i++) {

			$percent = intval($i/$DBF_lenght * 100)."%";
			$script = '<script language="javascript">document.getElementById("progress").innerHTML="<div style=\"width:' . $percent. ';background-color:#ddd;\">&nbsp;</div>";';
			$script = $script . 'document.getElementById("information").innerHTML="Alunos x Turmas - '.$i.' registros processados.";</script>';
			echo $script;
			flush();

			$row = dbase_get_record_with_names($tabelaDBF, $i);
			if($row) {
				$aluno    = $row['ALUNO'];
				$polo     = addslashes(trim($row['POLO']));
				$curso    = addslashes(trim($row['CURSO']));
				$situacao = addslashes(trim($row['SITUACAO']));
				echo "<p>aluno: " . $aluno . " curso: " . $curso . " polo: " . $polo . " situacao: " . $situacao . "</p>";
				$sql = "INSERT INTO qlsmsaluno_turma (aluno_id, curso_id, polo_id, situacao) VALUES ($aluno, '$curso', '$polo', '$situacao')";
				if (!mysql_query($sql, $conn)) die ("<h1>Falha na Gravação da Tabela QLSMSaluno_turma");
			}
		}
		echo "<p>QLSMSAluno_turma Importada</p>";
		dbase_close($tabelaDBF);
	}

	mysql_close($conn);

	function date_converter($_date = null) {
		$format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';
		if ($_date != null && preg_match($format, $_date, $partes)) {
			return $partes[3].'-'.$partes[2].'-'.$partes[1];
		}
		return false;
	}

	?>

	</div>
</body>
</html>

