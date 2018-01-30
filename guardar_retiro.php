<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $alumno = $_POST['alumno'];
    $apoderado = $_POST['apoderado'];
    $motivo = $_POST['motivo'];

    $sql = "INSERT INTO autorizacion(id_alumno, id_apoderado, motivo, fecha, hora)
            VALUES ( $alumno, $apoderado, '$motivo', CURRENT_DATE(), CURRENT_TIME())";

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