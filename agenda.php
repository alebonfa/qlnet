
<?php
    include 'php/conn.php';
    include 'elements/header.php';
    set_time_limit(600);
?>


<div class="container-fluid-dashboard">


    <a href="admin.php">Criar Evento</a> | <a href="listagenda.php">Listar Eventos</a>

<hr>

<?php


@mysql_select_db($db);//selecione o banco de dados

if(empty($_GET['data'])){//navegaçao entre os meses

    $dia = date('d');

    $month =ltrim(date('m'),"0");

    $ano = date('Y');

}else{

    $data = explode('/',$_GET['data']);//nova data

    $dia = $data[0];

    $month = $data[1];

    $ano = $data[2];

}

if($month==1){//mês anterior se janeiro mudar valor

    $mes_ant = 12;

    $ano_ant = $ano - 1;

}else{

    $mes_ant = $month - 1;

    $ano_ant = $ano;

}
if($month==12){//proximo mês se dezembro tem que mudar

    $mes_prox = 1;

    $ano_prox = $ano + 1;

}else{

    $mes_prox = $month + 1;

    $ano_prox = $ano;

}



$hoje = date('j');//função importante pego o dia corrente

switch($month.$n){/*notem duas variaveis para o switch para identificar dia e limitar numero de dias*/

    case 1: $mes = "JANEIRO";

            $n = 31;

    break;

    case 2: $mes = "FEVEREIRO";// todo ano bixesto fev tem 29 dias

            $bi = $ano % 4;//anos multiplos de 4 são bixestos

            if($bi == 0){

                $n = 29;

            }else{

                $n = 28;

            }

    break;

    case 3: $mes = "MARÇO";

            $n = 31;

    break;

    case 4: $mes = "ABRIL";

            $n = 30;

    break;

    case 5: $mes = "MAIO";

            $n = 31;

    break;

    case 6: $mes = "JUNHO";

            $n = 30;

    break;

    case 7: $mes = "JULHO";

            $n = 31;

    break;

    case 8: $mes = "AGOSTO";

            $n = 31;

    break;

    case 9: $mes = "SETEMBRO";

            $n = 30;

    break;

    case 10: $mes = "OUTUBRO";

            $n = 31;

    break;

    case 11: $mes = "NOVEMBRO";

            $n = 30;

    break;

    case 12: $mes = "DEZEMBRO";

            $n = 31;

    break;

}



$pdianu = mktime(0,0,0,$month,1,$ano);//primeiros dias do mes

$dialet = date('D', $pdianu);//escolhe pelo dia da semana

switch($dialet){//verifica que dia cai

    case "Sun": $branco = 0; break;

    case "Mon": $branco = 1; break;

    case "Tue": $branco = 2; break;

    case "Wed": $branco = 3; break;

    case "Thu": $branco = 4; break;

    case "Fri": $branco = 5; break;

    case "Sat": $branco = 6; break;

}            



    print '<table class="tabela" style="width:100%" >';//construção do calendario

    print '<tr>';

    print '<td class="mes"><a href="?data='.$dia.'/'.$mes_ant.'/'.$ano_ant.'" title="Mês anterior">  &laquo; </a></td>';/*mês anterior*/

    print '<td class="mes" colspan="5">'.$mes.'/'.$ano.'</td>';/*mes atual e ano*/

    print '<td class="mes"><a href="?data='.$dia.'/'.$mes_prox.'/'.$ano_prox.'" title="Próximo mês">  &raquo; </a></td>';/*Proximo mês*/

    print '</tr><tr>';

    print '<td class="sem">D</td>';//printar os dias da semana

    print '<td class="sem">S</td>';

    print '<td class="sem">T</td>';

    print '<td class="sem">Q</td>';

    print '<td class="sem">Q</td>';

    print '<td class="sem">S</td>';

    print '<td class="sem">S</td>';

    print '</tr><tr>';

    $dt = 1;

    if($branco > 0){

        for($x = 0; $x < $branco; $x++){

             print '<td>&nbsp;</td>';/*preenche os espaços em branco*/

            $dt++;

        }

    }

    

    for($i = 1; $i <= $n; $i++ ){/*agora vamos no banco de dados verificar os evendos*/
        $dtevento = $i."-".$month."-".$ano;

        $sqlag = mysql_query("SELECT * FROM qlevento AS qle INNER JOIN qlevento_data AS qled ON qle.id = qled.evento_id WHERE qled.data = '$dtevento' ") or die(mysql_error());
        //echo "SELECT * FROM qlevento AS qle INNER JOIN qlevento_data AS qled ON qle.id = qled.evento_id WHERE qled.data = '$dtevento'";
            
            $num   = mysql_num_rows($sqlag);/*quantos eventos tem para o mes*/
            $idev  = @mysql_result($sqlag, 0, "qled.data");
            $eve   = @mysql_result($sqlag, 0, "qle.status");              
            $nome  = @mysql_result($sqlag, 0, "qle.nome"); 

            if($num > 0){/*prevalece qualquer dia especial do calendario, por isso está em primeiro*/
                if ($eve == Cancelado){
                    print '<td class="evt_cancelado">';
                }else if($eve == Agendado){
                    print '<td class="evt_agendado">';
                }
                    print '<a href="?d='.$idev.'&data='.$dia.'/'.$month.'/'.$ano.'" title="'.$eve.'">'.$i.'<br>'.$nome.'</a>';
                    print '</td>';
                    $dt++;/*incrementa os dias da semana*/
                    $qt++;/*quantos eventos tem no mes*/
                }elseif($i == $hoje){/*imprime os dia corrente*/
                    print '<td class="hj">';
                    print $i;
                    print '</td>';
                    $dt++;
            }elseif($dt == 1){/*imprime os domingos*/
                print '<td class="dom">';
                print $i;
                print '</td>';
                $dt++;
            }else{/*imprime os dias normais*/
                print '<td class="td">';    
                print $i;
                print '</td>';
                $dt++;
            }

        if($dt > 7){/*faz a quebra no sabado*/

        print '</tr><tr>';

        $dt = 1;

        }

    }

    print '</tr>';

    print '</table>';

        if($qt > 0){/*se tiver evento no mês imprime quantos tem */

          print "Temos ".$qt." evento(s) em ".strtolower($mes)."<br>";/*mudar para caixa baixa as letras do mes*/

        }

if(isset($_GET['d'])){/*link dos dias de eventos*/

    $idev = $_GET['d'];

    $sqlev = mysql_query("SELECT * FROM qlevento AS qle INNER JOIN qlevento_data AS qled ON qle.id = qled.evento_id WHERE qled.data = '$idev' ORDER BY hora ASC") or die(mysql_error());

    $numev = mysql_num_rows($sqlev);

    for($j = 0; $j < $numev; $j++){/*caso no mesmo dia tenha mais eventos continua imprimindo */

    $eve = @mysql_result($sqlev, $j, "qle.nome");/*pegando os valores do banco referente ao evento*/

    $dev = @mysql_result($sqlev, $j, "qled.data");

    $dsev = @mysql_result($sqlev, $j, "qle.objetivo");

    $auev = @mysql_result($sqlev, $j, "qle.usuario_id");

    $lev = @mysql_result($sqlev, $j, "local");

    $psev = @mysql_result($sqlev, $j, "qled.data_log");

    $nowev = date('d/m/Y - H:i', strtotime($psev));/*transforma a data para data padrão brazil*/

    $hev = @mysql_result($sqlev, $j, "qled.hora");

print '<table width="300" cellspacing="0" cellpadding="0">';/*monta a tabela de eventos*/

print '<tr><td class="show">'.$dev.' - '.$eve.'</td></tr>';

print '<tr><td class="linha"><b>Hora: </b>'.$hev.'hs</td></tr>';

print '<tr><td class="linha"><b>Local: </b>'.$lev.'</td></tr>';

print '<tr><td class="linha"><b>Descrição: </b>'.nl2br($dsev).'</td></tr>';/*mantem o quebra da linha para dascriçao do evento*/

print '<tr><td class="linha"><b>Postado: </b><small>'.$nowev.'hs por '.$auev.'</small></td></tr>';

print '</table>';

    }

}



?>


</div>



    
    
<?php
    include 'elements/footer.php'; 
?>
