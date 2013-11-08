<?php
    include "functions.php";
    include "conn.php";

    echo($_GET[$acao]);
    
    if($acao==logar){
        
        $email    = limparString($_POST["txtEmail"]);
        $pwd      = limparString($_POST["txtPassword"]);
        $password = md5($pwd);
             
        $sql = "SELECT qlu.email AS email, qlu.nome AS nome, qlu.id AS id, qlu.pwd AS pwd, qlu_a.acesso_id AS nivel FROM qlusuario AS qlu INNER JOIN qlusuario_acesso AS qlu_a ON qlu.id = qlu_a.usuario_id WHERE email = '$email' AND pwd = '$password' ";
        //echo $sql;

        $result = mysql_query($sql,$conn);
        $total = mysql_num_rows($result);
        echo ($total);

        while ($row = mysql_fetch_array($result)) {
            $id      = $row["id"];
            $nome    = $row["nome"];
            $usuario = $row["email"];
            $senha   = $row["pwd"];
            $nivel   = $row["nivel"];
            //
            //echo($usuario." - ".$senha." - ".$nivel);
        }

        if($total > '0'){
            $number_of_days = 30 ;
            $date_of_expiry = time() + 60 * 60 * 24 * $number_of_days ;

            setcookie('id', $id, $date_of_expiry, '/');
            setcookie('nome', $nome, $date_of_expiry, '/');
            setcookie('email', $usuario, $date_of_expiry, '/');
            setcookie('senha', $senha, $date_of_expiry, '/');
            setcookie('nivel', $nivel, $date_of_expiry, '/');

                  
            
            //$usuarioCookie = $_COOKIE['usuario'];
            //echo ($usuarioCookie);
            //print_r($_COOKIE);
            //exit;
            //
            
            header("location: ../index.php?logado=ok");
        }else{
            header("location: ../index.php?logado=erro");
        }
    }
?>