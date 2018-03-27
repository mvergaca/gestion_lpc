<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";
    $id_alumno = $_POST['id_alumno'];
    $id_apoderado = $_POST['id_apoderado'];
    $motivo = $_POST['motivo'];

    $sql2 = "UPDATE asistencia SET justificacion = 0 WHERE id_alumno = $id_alumno";

    $resu2 = $dbcon ->query($sql2);

    if($resu2){
        $sql = "INSERT INTO autorizacion (id_alumno, id_apoderado, motivo, fecha, hora) 
                VALUES ($id_alumno,$id_apoderado,'$motivo',CURRENT_DATE(),CURRENT_TIME())";
        $res = $dbcon->query($sql);
    }
    else{
        echo"|-1||";
    }

    $resu2->close();
    include "cerrar_conexion.php";
}
?>