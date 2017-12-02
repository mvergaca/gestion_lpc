<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";
    $consulta = $_POST['consulta'];

    $resu = $dbcon ->query($consulta);

    if($resu){
        echo";1;;";
    }
    else{
        echo";-1;;";
    }

    $resu->close();
    include "cerrar_conexion.php";
}
?>