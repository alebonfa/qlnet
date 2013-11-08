<?php
    include "functions.php";
    include "conn.php";

    $date_of_expiry = time() - 60 ;

    setcookie('nome', 'anonymous', $date_of_expiry, '/');
    setcookie('email', 'anonymous', $date_of_expiry, '/');
    setcookie('senha', 'anonymous', $date_of_expiry, '/');
    setcookie('nivel', 'anonymous', $date_of_expiry, '/');
    
    header("location: ../index.php");

?>