<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $nueva = $_POST['nueva'];
    $antigua = $_POST['antigua'];

    $sql = "UPDATE usuario SET pass_usr = MD5('$nueva')
            WHERE rut_usr = '$_SESSION[rut_usr]' AND pass_usr = MD5('$antigua')";

    $res = $dbcon->query($sql);

    if($res){
        echo";1;$sql;";
    }
    else{
        echo";-1;;";
    }

    $res->close();
    include "cerrar_conexion.php";
}
?>