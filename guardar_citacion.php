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
        $sql2 = "SELECT * FROM citacion 
                  where id_alumno = $alumno and fecha = '$fecha'
                  order by id_citacion desc limit 1";
        $res2 = $dbcon->query($sql2);
        while($datos2 = mysqli_fetch_array($res2)){
            $id = $datos2['id_citacion'];
        }

        echo";1;$id;";
    }
    else{
        echo";-1;;";
    }

    include "cerrar_conexion.php";
}
?>