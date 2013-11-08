<?php
  include 'php/conn.php';
  include 'elements/header.php';

if(isset($_POST['done'])){
  
  $id       = $_POST['id']; 
  $nome     = $_POST['nome'];
  $data     = $_POST['data'];
  $hora     = $_POST['hora'];	 
  $local    = $_POST['local'];   
  $objetivo = $_POST['objetivo'];
  $contatos = $_POST['contatos'];
  
  if(empty($nome) || empty($data) || empty($objetivo)){
    $erro = "Opa, vocÃª deve preencher todos os campos";
  }else{
    $sql1 = mysql_query("UPDATE qlevento SET nome='$nome', objetivo='$objetivo', contatos='$contatos', local='$local' WHERE id='$id'")or die(mysql_error());
    $sql2 = mysql_query("UPDATE qlevento_data SET data='$data', hora='$hora' WHERE evento_id='$id'")or die(mysql_error());
    
    $linha = mysql_affected_rows();
      if($linha == 1){
        $erro = "Dados alterados com sucesso!";
      }else{
        $erro = "Não foi possivel alterar os dados";
      }
    }
  }

  $id = $_GET['id'];
  //
  $sql      = mysql_query("SELECT * FROM qlevento AS qle INNER JOIN qlevento_data AS qled ON qle.id = qled.evento_id WHERE qle.id = '$id'");
  $nome     = @mysql_result($sql, 0, "qle.nome");
  $data     = @mysql_result($sql, 0, "qled.data");
  $hora     = @mysql_result($sql, 0, "qled.hora");
  $autor    = @mysql_result($sql, 0, "qle.autor");
  $local    = @mysql_result($sql, 0, "qle.local");
  $objetivo = @mysql_result($sql, 0, "qle.objetivo");
  $contatos = @mysql_result($sql, 0, "qle.contatos");
?>



<form name="form1" action="atualagenda.php" method="POST" style="padding-top:40px;">

<?php

if(isset($erro)){

    print '<div style="width:80%; background:#ff6600; color:#fff; padding: 5px 0px 5px 0px; text-align:center; margin: 0 auto;">'.$erro.'</div>';

}

?>

<table border="0" width="80%"  bgcolor="#f0f0f0" style="border:1px solid #ccc; margin:0 auto; position:relative;">

<thead>

<tr>

<th colspan="2">.:: Atualizar Agenda ::.</th>

</tr>

</thead>

<tbody>

<tr>

<td width="14%">Evento:</td>

<td width="86%"><input type="text" name="nome" value="<?php echo $nome; ?>" class="campo" /></td>

</tr>

<tr>

<td>Data:</td>

<td><input type="text" name="data" value="<?php echo $data; ?>"  class="campo"/>

dd-mm-aaaa</td>

</tr>

<tr>

<td>Hora:</td>

<td>

   <input type="text" name="hora" value="<?php echo $hora; ?>"  class="campo"/>

   hh:mm</td>

</tr>

<tr>

  <td>Local:</td>

  <td><input name="local" type="text" class="campo" id="local" value="<?php echo $local; ?>"></td>

</tr>

<tr>

<td valign="top">Objetivo:</td>

<td><textarea name="objetivo" rows="8" cols="20" class="campo"><?php echo $objetivo; ?></textarea></td>

</tr>

<tr>

<td valign="top">Contatos:</td>

<td><textarea name="contatos" rows="8" cols="20" class="campo"><?php echo $contatos; ?></textarea></td>

</tr>

<tr>

<td></td>

<td><input type="submit" value="Atualizar Agenda" />

  <input type="button" name="button" id="button" onclick="javascript:location.href='listagenda.php';" value="Cancelar" />

  <input type="hidden" name="done" value="" /><input name="id" type="hidden" value="<?php echo $id; ?>" /></td>

</tr>

</tbody>

</table>

</form>