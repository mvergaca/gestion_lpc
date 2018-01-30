<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $detalle = $_POST['detalle'];
    $alumno = $_POST['alumno'];
    $ins = $_POST['ins'];

    $sql = "INSERT INTO citacion(id_alumno, id_inspector, fecha, hora, motivo)
            VALUES ($alumno,$ins,'$fecha','$hora','$detalle')";
    $res = $dbcon->query($sql);

    if($res){
        echo";1;;";
    }
    else{
        echo";-1;;";
    }

    include "cerrar_conexion.php";
}
?>