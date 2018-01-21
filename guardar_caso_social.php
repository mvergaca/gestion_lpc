<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $asistente = $_POST["asistente"];
    $curso = $_POST["curso"];
    $alumno = $_POST["alumno"];
    $descripcion = $_POST["descripcion"];
    $imagen = $_POST["imagen"];

    $fecha = date("Y-m-d");
    $hora = null;


    if($imagen == null || $descripcion == null){
        $sql = "INSERT INTO caso_social (id_asistente, id_alumno, descripcion_caso, imagen, fecha, hora, estado) 
                VALUES ($asistente,$alumno,'$descripcion','$imagen','$fecha','$hora',1);";
    }
    else{
        $sql = "INSERT INTO caso_social (id_asistente, id_alumno, descripcion_caso, imagen, fecha, hora, estado) 
                VALUES ($asistente,$alumno,'$descripcion','$imagen','$fecha','$hora',0)";
    }

    $resu = $dbcon ->query($sql);

    if(!$resu){
        echo";-1;$sql;";
    }
    else{
        echo";1;$sql;";
    }

    $resu->close();
    include "cerrar_conexion.php";
}
?>