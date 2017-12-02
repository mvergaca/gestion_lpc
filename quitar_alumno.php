<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $alumno = $_POST["alumno"];
    $anio = $_POST["anio"];


    $sql = "DELETE FROM lista WHERE id_alumno = $alumno AND anio = $anio";
    $res = $dbcon -> query($sql);

    if(!$res){
        echo";-1;;";
    }else{
        echo";1;;";
    }

    $res->close();
    include "cerrar_conexion.php";
}
?>