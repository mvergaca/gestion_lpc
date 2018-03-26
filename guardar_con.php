<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $rut = $_POST["rut"];
    $contra = $_POST["contra"];

    $sql = "UPDATE usuario SET pass_usr = MD5('$contra') WHERE rut_usr = '$rut'";
    $res = $dbcon -> query($sql);

    if(!$res){
        echo";-1;;";
    }else{
        echo";1;;";
        $sql2 = "UPDATE recupera SET estado = 0 WHERE rut_usr = '$rut'";
        $res2 = $dbcon -> query($sql2);
    }

    $res->close();
    include "cerrar_conexion.php";
}
?>