<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";
    $clase = $_POST["ref"];
    $sql = "DELETE FROM clase WHERE id_clase = $clase";
    $resu = $dbcon ->query($sql);

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