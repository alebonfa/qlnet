
<?php
    include 'php/conn.php';
?>

<?php
    include 'elements/header.php';
?>


<?php

if(isset($_POST['done'])){

    $nome = $_POST['nome'];
    $data = $_POST['dia']."-".$_POST['mes']."-".$_POST['ano'];
    $usuario_id = $_COOKIE['id'];
    $hora = $_POST['hora'];
    $local = $_POST['local'];
    $evento_status = $_POST['evento_status'];
    $objetivo = $_POST['objetivo'];
    $contatos = $_POST['contatos'];    
    $data_log = date(now);
    
    if(empty($nome) || empty($data) || empty($objetivo)){

        $erro = "Opa, você deve preencher todos os campos";

    }else{        
        //echo("INSERT INTO qlevento('nome', 'data_log', 'usuario_id', 'local', 'objetivo', 'contatos') VALUES ('$nome', $data_log, $usuario_id, '$local', '$objetivo', '$contatos')");
        //exit;
        $sql = mysql_query("INSERT INTO qlevento(nome, data_log, usuario_id, local, objetivo, contatos) VALUES ('$nome', $data_log, $usuario_id, '$local', '$objetivo', '$contatos')") or die(mysql_error());

            if($sql){
                $erro = "Dados cadastrados com sucesso!";
                $ultimoID = mysql_insert_id();
                //echo (mysql_insert_id());
                //exit;
                //echo ("INSERT INTO qlevento_data(evento_id, data, hora) VALUES ('$ultimoID', '$data', '$hora')");
                $sqlData = mysql_query("INSERT INTO qlevento_data(evento_id, data, hora) VALUES ('$ultimoID', '$data', '$hora')") or die(mysql_error());
               //exit;
            } else{
                $erro = "Não foi possivel cadastrar os dados";
            }
    }

}

?>

<div class="container-fluid-dashboard">
    <form name="form1" action="admin.php" method="POST" style="padding-top:40px;">
        <?php
            if(isset($erro)){
                print '<div style="width:80%; background:#ff6600; color:#fff; padding: 5px 0px 5px 0px; text-align:center; margin: 0 auto;">'.$erro.'</div>';
            }
        ?>
        <table border="0" width="80%"  bgcolor="#f0f0f0" style="border:1px solid #ccc; margin:0 auto; position:relative;">
            <thead>
                <tr>
                    <th colspan="2">.:: Inserir Evento no Calendário ::.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="20%">Evento:</td>
                    <td width="auto"><input type="text" name="nome" value="" class="campo" id="nome" /></td>
                </tr>
                <tr>
                    <td>Autor:</td>
                    <td><input name="autor" type="text" class="campo" id="autor" value="<?php echo ($_COOKIE['id']);?>" /><?php echo ($_COOKIE['nome']);?></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="evento_status">
                            <option>Agendado</option>
                            <option>Realizado</option>
                            <option>Cancelado</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Data Evento:</td>
                    <td>
                        <select name="dia">
                            <?php for($i = 1; $i <= 31; $i++ ){ ?>
                                <option><?php echo($i) ?></option>
                            <?php } ?>    
                        </select>
                        <select name="mes" >
                            <?php for($j = 1; $j <= 12; $j++ ){ ?>
                                <option><?php echo($j) ?></option>
                            <?php } ?>    
                        </select>
                        <select name="ano" >
                            <?php for($k = 2009; $k <= 2020; $k++ ){ ?>
                                <option><?php echo($k) ?></option>
                            <?php } ?>    
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Hora:</td>
                    <td><input name="hora" type="text" class="campo" id="hora">(hh:mm)</td>
                </tr>
                <tr>
                    <td>Local:</td>
                    <td><input name="local" type="text" class="campo" id="local"></td>
                </tr>
                <tr>
                    <td valign="top">Objetivo:</td>
                    <td><textarea name="objetivo" rows="8" class="campo" ></textarea></td>
                </tr>
                <tr>
                    <td valign="top">Contatos:</td>
                    <td><textarea name="contatos" rows="8" class="campo" ></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Cadastrar Evento" /><input type="hidden" name="done" value="" /></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
