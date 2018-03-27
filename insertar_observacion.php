<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";
    $alumno = $_POST["alumno"];
    $profesor = $_POST["profesor"];
    $observacion = $_POST["observacion"];
    $tipo = $_POST["tipo"];

    $sql = "INSERT INTO observacion (id_profesor, id_alumno, observacion, fecha, hora, tipo_obs) 
            VALUES ($profesor, $alumno, '$observacion',CURRENT_DATE(), CURRENT_TIME(), $tipo)";

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